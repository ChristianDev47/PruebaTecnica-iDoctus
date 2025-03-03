<?php

namespace App\Modules\Exchange\Domain\Contracts;

use App\Modules\Exchange\Domain\Entities\ExchangeRate;

interface ExchangeRateRepositoryInterface
{
    /**
     * Retrieves the current exchange rate from wherever.
     *
     * @return ExchangeRate
     * @throws \Exception
     */
    public function getExchangeRate(): ExchangeRate;
}
