<?php

namespace App\Modules\Exchange\Application\Services;

use App\Modules\Exchange\Domain\Entities\ExchangeRate;
use App\Modules\Exchange\Domain\Contracts\ExchangeRateRepositoryInterface;
use App\Modules\Exchange\Domain\Contracts\ExchangeRateServiceInterface;
use App\Modules\Exchange\Domain\Exceptions\ExchangeDomainException;

class ExchangeRateService implements ExchangeRateServiceInterface
{
    private ExchangeRateRepositoryInterface $exchangeRateRepository;

    public function __construct(ExchangeRateRepositoryInterface $exchangeRateRepository)
    {
        $this->exchangeRateRepository = $exchangeRateRepository;
    }

    /**
     * Retrieves the current exchange rate from the repository.
     *
     * @return ExchangeRate
     * @throws ExchangeDomainException
     */
    public function getExchangeRate(): ExchangeRate
    {
        try {
            return $this->exchangeRateRepository->getExchangeRate();
        } catch (\Exception $exc) {
            throw new ExchangeDomainException("Error fetching exchange rate", 0, $exc);
        }
    }
}
