<?php

namespace Tests\Acceptance\Api;

use Illuminate\Foundation\Testing\TestCase;

class ExchangeRateApiTest extends TestCase
{
    public function testExchangeRateApiEndpoint()
    {
  
        $response = $this->withHeaders([
            'Authorization' => 'Bearer {}',
        ])->get('/exchange');

        $response->assertStatus(200);
        $response->assertJsonStructure(['price']);
    }
}
