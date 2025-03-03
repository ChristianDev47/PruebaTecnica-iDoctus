<?php

namespace Tests\Performance;

use Illuminate\Foundation\Testing\TestCase;

class LoadTest extends TestCase
{
    public function testLoadUnderSimulatedConcurrency()
    {
        $start = microtime(true);
        $numRequests = 10;
        for ($i = 0; $i < $numRequests; $i++) {
            $response = $this->withHeaders(['Authorization' => 'Bearer {}'])->get('/api/exchange');
            $response->assertStatus(200);
        }
        $duration = microtime(true) - $start;
        $this->assertLessThan(10, $duration, "Load test took too long: {$duration} seconds");
    }
}
