<?php

namespace App\Modules\Exchange\Application\Actions;

use App\Modules\Exchange\Application\DTOs\ExchangeRateDTO;
use App\Modules\Exchange\Domain\Contracts\ExchangeRateServiceInterface;
use Illuminate\Http\JsonResponse;

class GetExchangeRateAction
{
    private ExchangeRateServiceInterface $exchangeRateService;

    public function __construct(ExchangeRateServiceInterface $exchangeRateService)
    {
        $this->exchangeRateService = $exchangeRateService;
    }

    /**AC
     * Fetches the latest exchange rate and returns it as JSON.
     *
     * @return JsonResponse
     */
    public function execute(): JsonResponse
    {
        $exchangeRate = $this->exchangeRateService->getExchangeRate();
        $dto = new ExchangeRateDTO($exchangeRate->getPrice());

        return response()->json($dto->toArray());
    }
}
