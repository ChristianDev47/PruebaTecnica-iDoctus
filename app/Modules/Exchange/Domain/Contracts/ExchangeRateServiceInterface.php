<?php

namespace App\Modules\Exchange\Domain\Contracts;

use App\Modules\Exchange\Domain\Entities\ExchangeRate;

interface ExchangeRateServiceInterface
{
    /**
     * Retrieves the latest exchange rate from the repository.
     *
     * @return ExchangeRate
     */
    public function getExchangeRate(): ExchangeRate;
}
