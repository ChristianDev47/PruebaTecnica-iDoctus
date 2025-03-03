<?php

namespace Tests\Unit;

use Illuminate\Http\Request;
use App\Common\Security\RateLimiter;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Support\Facades\Redis;

class RateLimiterTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Redis::flushall();
    }

    public function testTooManyAttemptsReturnsFalseBeforeLimit()
    {
        $request = Request::create('/test', 'GET', [], [], [], ['REMOTE_ADDR' => '127.0.0.1']);
        $result = RateLimiter::tooManyAttempts($request, 3, 60);
        $this->assertFalse($result);
    }

    public function testTooManyAttemptsReturnsTrueAfterLimit()
    {
        $request = Request::create('/test', 'GET', [], [], [], ['REMOTE_ADDR' => '127.0.0.1']);
        for ($i = 0; $i < 3; $i++) {
            RateLimiter::tooManyAttempts($request, 3, 60);
        }
        $result = RateLimiter::tooManyAttempts($request, 3, 60);
        $this->assertTrue($result);
    }
}
