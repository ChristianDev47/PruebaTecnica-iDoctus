<?php

namespace App\Modules\Exchange\Domain\Entities;

use App\Modules\Exchange\Domain\ValueObjects\ExchangeRateValue;

class ExchangeRate
{
    private ExchangeRateValue $price;

    public function __construct(ExchangeRateValue $price)
    {
        $this->price = $price;
    }

    /**
     * Returns the current exchange rate value.
     *
     * @return ExchangeRateValue
     */
    public function getPrice(): ExchangeRateValue
    {
        return $this->price;
    }
}
