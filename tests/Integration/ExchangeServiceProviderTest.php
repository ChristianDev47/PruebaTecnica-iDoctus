<?php

namespace Tests\Integration;

use App\Modules\Exchange\Domain\Contracts\ExchangeRateRepositoryInterface;
use App\Modules\Exchange\Domain\Contracts\ExchangeRateServiceInterface;
use App\Modules\Exchange\Infrastructure\Repositories\ExchangeRateRepository;
use App\Modules\Exchange\Application\Services\ExchangeRateService;
use Illuminate\Foundation\Testing\TestCase;

class ExchangeServiceProviderTest extends TestCase
{
    public function testExchangeServiceProviderBindings()
    {
        $repository = $this->app->make(ExchangeRateRepositoryInterface::class);
        $service = $this->app->make(ExchangeRateServiceInterface::class);

        $this->assertInstanceOf(ExchangeRateRepository::class, $repository);
        $this->assertInstanceOf(ExchangeRateService::class, $service);
    }
}
