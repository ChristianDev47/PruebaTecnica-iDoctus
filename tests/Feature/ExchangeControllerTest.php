<?php

namespace Tests\Feature;

use App\Modules\Exchange\Domain\Entities\ExchangeRate;
use App\Modules\Exchange\Domain\ValueObjects\ExchangeRateValue;
use App\Modules\Exchange\Domain\Contracts\ExchangeRateServiceInterface;
use Illuminate\Foundation\Testing\TestCase;

class ExchangeControllerTest extends TestCase
{
    public function testExchangeControllerReturnsJsonResponse()
    {
        $fakeRate = new ExchangeRate(new ExchangeRateValue(0.954471));
        $serviceMock = $this->createMock(ExchangeRateServiceInterface::class);
        $serviceMock->method('getExchangeRate')->willReturn($fakeRate);

        $this->app->instance(ExchangeRateServiceInterface::class, $serviceMock);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer {}',
        ])->get('/api/exchange');

        $response->assertStatus(200);
        $response->assertJson(['price' => 0.954471]);
    }
}
