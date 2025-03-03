<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Modules\Exchange\Domain\Entities\ExchangeRate;
use App\Modules\Exchange\Domain\ValueObjects\ExchangeRateValue;

class ExchangeRateTest extends TestCase
{
    public function testGetPriceReturnsExchangeRateValue()
    {
        $value = new ExchangeRateValue(0.954471);
        $exchangeRate = new ExchangeRate($value);
        
        $this->assertInstanceOf(ExchangeRateValue::class, $exchangeRate->getPrice());
        $this->assertEquals(0.954471, $exchangeRate->getPrice()->value());
    }
}
