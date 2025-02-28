<?php

namespace App\Modules\Exchange\Infrastructure\Repositories;

use App\Modules\Exchange\Domain\Entities\ExchangeRate;
use App\Modules\Exchange\Domain\Contracts\ExchangeRateRepositoryInterface;
use App\Modules\Exchange\Infrastructure\Adapters\ExchangeRateAPIAdapter;
use App\Modules\Exchange\Infrastructure\Adapters\FallbackStorageAdapter;
use App\Modules\Exchange\Infrastructure\Adapters\ExchangeRateMapper;
use App\Modules\Exchange\Infrastructure\Cache\ExchangeRateCache;
use App\Modules\Exchange\Infrastructure\Monitoring\ExchangeMonitoring;
use App\Modules\Exchange\Application\Jobs\UpdateExchangeRateCacheJob;
use Illuminate\Support\Facades\Redis;
use Exception;

class ExchangeRateRepository implements ExchangeRateRepositoryInterface
{
    private ExchangeRateAPIAdapter $apiAdapter;
    private FallbackStorageAdapter $fallbackAdapter;
    private ExchangeRateCache $cache;
    private ExchangeMonitoring $monitoring;

    public function __construct(
        ExchangeRateAPIAdapter $apiAdapter,
        FallbackStorageAdapter $fallbackAdapter,
        ExchangeRateCache $cache,
        ExchangeMonitoring $monitoring
    ) {
        $this->apiAdapter = $apiAdapter;
        $this->fallbackAdapter = $fallbackAdapter;
        $this->cache = $cache;
        $this->monitoring = $monitoring;
    }

    /**
     * Gets the current exchange rate.
     *
     * - First, tries to return a cached rate.
     * - If not available, attempts to fetch a fresh rate from the API.
     * - If that fails, falls back to the last known cached rate.
     */
    public function getExchangeRate(): ExchangeRate
    {

        // If we have a cached rate, use it
        if (($cachedRate = $this->cache->get()) !== null) {
            $this->cache->refresh();
            return ExchangeRateMapper::map($cachedRate);
        }

        $lockKey = 'exchange_rate_lock';
        $lockTTL = 10;
        $lockAcquired = Redis::set($lockKey, 1, 'NX', 'EX', $lockTTL);

        if ($lockAcquired) {
            try {
                // Fetch from API
                $rate = $this->monitoring->monitorResponseTime(
                    fn() => $this->apiAdapter->fetchRate()
                );
                UpdateExchangeRateCacheJob::dispatch($rate);
            } catch (Exception $exc) {
                // If API fails, use the fallback rate
                $rate = $this->fallbackAdapter->getFallbackRate();
            } finally {
                Redis::del($lockKey);
            }
        } else {
            $waited = 0;
            $interval = 50;
            while ($waited < 200) {
                usleep($interval * 1000); 
                $waited += $interval;
                if (($cachedRate = $this->cache->get()) !== null) {
                    return ExchangeRateMapper::map($cachedRate);
                }
            }
            $rate = $this->fallbackAdapter->getFallbackRate();
        }
        // Cache the latest rate before returning
        $this->cache->set($rate);
        return ExchangeRateMapper::map($rate);
    }
}
