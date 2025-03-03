<?php

namespace App\Modules\Exchange\Infrastructure\Cache;

use Illuminate\Support\Facades\Redis;

class ExchangeRateCache
{
    const CACHE_KEY = 'exchange_rate';
    private int $ttl;

    public function __construct(int $ttl = 600)
    {
        $this->ttl = $ttl;
    }

    /**
     * Gets the cached exchange rate, if available.
     */
    public function get(): ?float
    {
        $value = Redis::get(self::CACHE_KEY);
        return $value !== null ? (float) $value : null;
    }

    /**
     * Sets the exchange rate in the cache.
     */
    public function set(float $rate): void
    {
        Redis::setex(self::CACHE_KEY, $this->ttl, $rate);
    }

    /**
     * Refresh cache.
     */
    public function refresh(): void
    {
        if (Redis::exists(self::CACHE_KEY)) {
            $rate = $this->get();
            if ($rate !== null) {
                $this->set($rate);
            }
        }
    }
}
