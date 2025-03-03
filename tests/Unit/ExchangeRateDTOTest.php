<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Modules\Exchange\Application\DTOs\ExchangeRateDTO;
use App\Modules\Exchange\Domain\ValueObjects\ExchangeRateValue;

class ExchangeRateDTOTest extends TestCase
{
    public function test_to_array_returns_correct_structure()
    {
        $exchangeRateValue = new ExchangeRateValue(100.50);
        $dto = new ExchangeRateDTO($exchangeRateValue);

        $expectedArray = ['price' => 100.50];

        $this->assertEquals($expectedArray, $dto->toArray());
    }
}
