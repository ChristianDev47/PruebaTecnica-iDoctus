<?php

namespace Tests\Acceptation;

use Illuminate\Foundation\Testing\TestCase;

class FuzzTest extends TestCase
{
    public function testFuzzingBearerToken()
    {
        $fuzzInputs = [
            str_repeat('{', 50),
            str_repeat('}', 50),
            bin2hex(random_bytes(20)),
            '<script>alert(1)</script>',
            str_shuffle('{}{}[]()')
        ];
        
        foreach ($fuzzInputs as $input) {
            $response = $this->withHeaders([
                'Authorization' => 'Bearer ' . $input,
            ])->get('/api/exchange');
            
            $this->assertEquals(401, $response->getStatusCode());
        }
    }
}
