<?php

namespace App\Modules\Exchange\Application\Jobs;

use App\Modules\Exchange\Infrastructure\Adapters\FallbackStorageAdapter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateExchangeRateCacheJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private float $rate;
    private int $ttl;

    public function __construct(float $rate, int $ttl = 86400)
    {
        $this->rate = $rate;
        $this->ttl = $ttl;
    }

    /**
     * Updates the fallback cache with the provided exchange rate.
     *
     * @param FallbackStorageAdapter $fallbackStorageAdapter
     * @return void
     */
    public function handle(FallbackStorageAdapter $fallbackStorageAdapter)
    {
        $fallbackStorageAdapter->updateFallbackRate($this->rate, $this->ttl);
    }
}
