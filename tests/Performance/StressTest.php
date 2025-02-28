<?php

namespace Tests\Performance;

use Illuminate\Foundation\Testing\TestCase;

class StressTest extends TestCase
{
    public function testStressUnderHighLoad()
    {
        $start = microtime(true);
        $numRequests = 1000;
        for ($i = 0; $i < $numRequests; $i++) {
            $response = $this->withHeaders(['Authorization' => 'Bearer {}'])->get('/exchange');
            $response->assertStatus(200);
        }
        $duration = microtime(true) - $start;
        $this->assertLessThan(20, $duration, "Stress test took too long: {$duration} seconds");
    }
}
