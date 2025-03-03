<?php

namespace Tests\Feature;

use App\Modules\Exchange\Application\Jobs\UpdateExchangeRateCacheJob;
use App\Modules\Exchange\Infrastructure\Adapters\FallbackStorageAdapter;
use App\Modules\Exchange\Infrastructure\Cache\ExchangeRateCache;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Support\Facades\Redis;

class UpdateExchangeRateCacheJobTest extends TestCase
{
    public function testJobUpdatesFallbackRate()
    {
        $cache = new ExchangeRateCache();
        $adapter = new FallbackStorageAdapter($cache);

        Redis::flushall();

        $job = new UpdateExchangeRateCacheJob(0.954471, 60);
        $job->handle($adapter);

        $this->assertEquals(0.954471, $cache->get());
    }
}
