<?php

namespace Tests\Feature;

use Illuminate\Http\Request;
use App\Modules\Exchange\Presentation\Http\Middleware\ThrottleRequests;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redis;

class ThrottleRequestsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Redis::flushall();
    }

    public function testAllowsRequestUnderLimit()
    {
        $middleware = new ThrottleRequests();
        $request = Request::create('/api/exchange', 'GET', [], [], [], ['REMOTE_ADDR' => '127.0.0.1']);
        $next = function ($req) {
            return response()->json(['success' => true]);
        };

        $response = $middleware->handle($request, $next);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($response->getContent());
    }

    public function testBlocksRequestOverLimit()
    {
        $middleware = new ThrottleRequests();
        $request = Request::create('/api/exchange', 'GET', [], [], [], ['REMOTE_ADDR' => '127.0.0.1']);
        $next = function ($req) {
            return response()->json(['success' => true]);
        };

        for ($i = 0; $i < 60; $i++) {
            $middleware->handle($request, $next);
        }

        $response = $middleware->handle($request, $next);
        $this->assertEquals(Response::HTTP_TOO_MANY_REQUESTS, $response->getStatusCode());
        $this->assertJson($response->getContent());
        $this->assertStringContainsString('Too many requests', $response->getContent());
    }
}
