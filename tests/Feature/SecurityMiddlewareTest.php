<?php

namespace Tests\Feature;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Common\Middleware\SecurityMiddleware;
use Illuminate\Foundation\Testing\TestCase;

class SecurityMiddlewareTest extends TestCase
{
    public function test_security_headers_are_added()
    {
        $middleware = new SecurityMiddleware();

        $request = Request::create('/test', 'GET');
        $response = new Response();

        $handledResponse = $middleware->handle($request, function () use ($response) {
            return $response;
        });

        $this->assertEquals('nosniff', $handledResponse->headers->get('X-Content-Type-Options'));
        $this->assertEquals('DENY', $handledResponse->headers->get('X-Frame-Options'));
        $this->assertEquals('1; mode=block', $handledResponse->headers->get('X-XSS-Protection'));
    }
}
