<?php

namespace App\Modules\Exchange\Application\DTOs;

use App\Modules\Exchange\Domain\ValueObjects\ExchangeRateValue;

class ExchangeRateDTO
{
    private ExchangeRateValue $exchangeRate;

    public function __construct(ExchangeRateValue $exchangeRate)
    {
        $this->exchangeRate = $exchangeRate;
    }

    /**
     * Returns the DTO as an array.
     * @return array
     */
    public function toArray(): array
    {
        return [
            'price' => $this->exchangeRate->value(), 
        ];
    }
}
