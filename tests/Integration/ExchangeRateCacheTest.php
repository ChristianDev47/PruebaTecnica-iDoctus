<?php

namespace Tests\Integration;

use App\Modules\Exchange\Infrastructure\Cache\ExchangeRateCache;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Support\Facades\Redis;

class ExchangeRateCacheTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Redis::flushall();
    }
    
    public function testSetAndGetCache()
    {
        $cache = new ExchangeRateCache();
        $cache->set(0.954471, 1);
        $this->assertEquals(0.954471, $cache->get());
    }
}
