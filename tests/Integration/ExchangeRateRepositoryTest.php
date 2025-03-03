<?php

namespace Tests\Integration;

use App\Modules\Exchange\Infrastructure\Repositories\ExchangeRateRepository;
use App\Modules\Exchange\Infrastructure\Adapters\ExchangeRateAPIAdapter;
use App\Modules\Exchange\Infrastructure\Adapters\FallbackStorageAdapter;
use App\Modules\Exchange\Infrastructure\Cache\ExchangeRateCache;
use App\Modules\Exchange\Infrastructure\Monitoring\ExchangeMonitoring;
use App\Modules\Exchange\Domain\Entities\ExchangeRate;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Support\Facades\Redis;

class ExchangeRateRepositoryTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Redis::flushall();
    }
    
    public function testGetExchangeRateReturnsCachedRateIfAvailable()
    {
        $cache = $this->createMock(ExchangeRateCache::class);
        $cache->method('get')->willReturn(0.954471);
        $cache->expects($this->never())->method('set');
        
        $apiAdapter   = $this->createMock(ExchangeRateAPIAdapter::class);
        $fallbackAdapter = $this->createMock(FallbackStorageAdapter::class);
        $monitoring   = $this->createMock(ExchangeMonitoring::class);
        
        $repository = new ExchangeRateRepository($apiAdapter, $fallbackAdapter, $cache, $monitoring);
        
        $exchangeRate = $repository->getExchangeRate();
        
        $this->assertInstanceOf(ExchangeRate::class, $exchangeRate);
        $this->assertEquals(0.954471, $exchangeRate->getPrice()->value());
    }
}
