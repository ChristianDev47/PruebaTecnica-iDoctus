<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Modules\Exchange\Domain\ValueObjects\ExchangeRateValue;
use InvalidArgumentException;

class ExchangeRateValueTest extends TestCase
{
    public function testEqualsReturnsTrueForSameValue()
    {
        $rate1 = new ExchangeRateValue(0.954471);
        $rate2 = new ExchangeRateValue(0.954471);
        $this->assertTrue($rate1->equals($rate2));
    }
    
    public function testExceptionForZeroOrNegativeRate()
    {
        $this->expectException(InvalidArgumentException::class);
        new ExchangeRateValue(0);
    }
}
