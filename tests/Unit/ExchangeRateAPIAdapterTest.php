<?php

namespace Tests\Unit;

use App\Modules\Exchange\Infrastructure\Adapters\ExchangeRateAPIAdapter;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use Exception;
use Illuminate\Foundation\Testing\TestCase;

class ExchangeRateAPIAdapterTest extends TestCase
{
    public function testFetchRateReturnsRate()
    {
        $body = json_encode([
            'exchange_rates' => [
                config('services.exchange_rate.to') => 0.954471,
            ],
        ]);
        $mock = new MockHandler([
            new Response(200, [], $body),
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $adapter = new ExchangeRateAPIAdapter();
        
        $reflected = new \ReflectionClass($adapter);
        $prop = $reflected->getProperty('httpClient');
        $prop->setAccessible(true);
        $prop->setValue($adapter, $client);

        $rate = $adapter->fetchRate();
        $this->assertEquals(0.954471, $rate);
    }
    
    public function testFetchRateThrowsExceptionOnBadStatus()
    {
        $mock = new MockHandler([
            new Response(500, [], 'Internal Server Error'),
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $adapter = new ExchangeRateAPIAdapter();
        $reflected = new \ReflectionClass($adapter);
        $prop = $reflected->getProperty('httpClient');
        $prop->setAccessible(true);
        $prop->setValue($adapter, $client);

        $this->expectException(Exception::class);
        $adapter->fetchRate();
    }
}
