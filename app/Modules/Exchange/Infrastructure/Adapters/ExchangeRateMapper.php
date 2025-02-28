<?php

namespace App\Modules\Exchange\Infrastructure\Adapters;

use App\Modules\Exchange\Domain\Entities\ExchangeRate;
use App\Modules\Exchange\Domain\ValueObjects\ExchangeRateValue;

class ExchangeRateMapper
{
    /**
     * Maps a numeric rate to an ExchangeRate entity
     */
    public static function map(float $rate): ExchangeRate
    {
        return new ExchangeRate(new ExchangeRateValue($rate));
    }
}
