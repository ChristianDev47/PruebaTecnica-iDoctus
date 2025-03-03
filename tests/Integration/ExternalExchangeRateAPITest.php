<?php

namespace Tests\Integration;

use App\Modules\Exchange\Infrastructure\Adapters\ExchangeRateAPIAdapter;
use Illuminate\Foundation\Testing\TestCase;

class ExternalExchangeRateAPITest extends TestCase
{
    public function testExternalApiReturnsRate()
    {
        $this->markTestSkipped('External API test skipped by default.');

        $adapter = new ExchangeRateAPIAdapter();
        $rate = $adapter->fetchRate();
        $this->assertIsFloat($rate);
        $this->assertGreaterThan(0, $rate);
    }
}
