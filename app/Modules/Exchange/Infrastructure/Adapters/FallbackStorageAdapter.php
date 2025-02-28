<?php

namespace App\Modules\Exchange\Infrastructure\Adapters;

use App\Modules\Exchange\Infrastructure\Cache\ExchangeRateCache;
use Illuminate\Support\Facades\Log;
use RuntimeException;

class FallbackStorageAdapter
{
    private ExchangeRateCache $cache;

    public function __construct(ExchangeRateCache $cache)
    {
        $this->cache = $cache;
    }

    /**
     * Retrieves the last known exchange rate from the fallback cache.
     *
     * @return float
     * @throws RuntimeException
     */
    public function getFallbackRate(): float
    {
        $fallbackRate = $this->cache->get();

        if ($fallbackRate === null) {
            Log::error('No valid fallback rate found in cache.');
            throw new RuntimeException("Fallback rate unavailable");
        }

        Log::warning("Using fallback exchange rate: {$fallbackRate}");
        return (float) $fallbackRate;
    }

    /**
     * Updates the fallback rate in the cache.
     * 
     * @param float $rate
     * @param int $ttl
     * @return void
     */
    public function updateFallbackRate(float $rate, int $ttl = 86400): void
    {
        $currentRate = $this->cache->get();
        if ($currentRate !== null && $currentRate === $rate) {
            $this->cache->set($rate, $ttl);
            Log::info("Refreshed TTL for exchange rate: {$rate}");
        } else {
            $this->cache->set($rate, $ttl);
            Log::info("Updated fallback exchange rate: {$rate}");
        }
    }
}
