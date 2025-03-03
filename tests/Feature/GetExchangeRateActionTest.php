<?php

namespace Tests\Feature;

use App\Modules\Exchange\Application\Actions\GetExchangeRateAction;
use App\Modules\Exchange\Domain\Entities\ExchangeRate;
use App\Modules\Exchange\Domain\ValueObjects\ExchangeRateValue;
use App\Modules\Exchange\Domain\Contracts\ExchangeRateServiceInterface;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Http\JsonResponse;

class GetExchangeRateActionTest extends TestCase
{
    public function testExecuteReturnsJsonResponse()
    {
        $fakeRate = new ExchangeRate(new ExchangeRateValue(0.954471));
        $serviceMock = $this->createMock(ExchangeRateServiceInterface::class);
        $serviceMock->method('getExchangeRate')->willReturn($fakeRate);
        
        $action = new GetExchangeRateAction($serviceMock);
        $response = $action->execute();
        
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(['price' => 0.954471], $response->getData(true));
    }
}
