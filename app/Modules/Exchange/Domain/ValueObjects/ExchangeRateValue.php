<?php

namespace App\Modules\Exchange\Domain\ValueObjects;

use InvalidArgumentException;

final class ExchangeRateValue
{
    private float $rate;

    public function __construct(float $rate)
    {
        if ($rate <= 0) {
            throw new InvalidArgumentException("Exchange rate must be greater than 0.");
        }
        $this->rate = round($rate, 6);
    }

    /**
     * Returns the raw exchange rate.
     *
     * @return float
     */
    public function value(): float
    {
        return $this->rate;
    }

    /**
     * Compares this rate with another exchange rate.
     *
     * @param ExchangeRateValue $otherExchangeRate
     * @return bool
     */
    public function equals(ExchangeRateValue $otherExchangeRate): bool
    {
        return $this->rate === $otherExchangeRate->value();
    }
}
