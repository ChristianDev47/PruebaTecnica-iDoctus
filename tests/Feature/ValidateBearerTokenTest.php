<?php

namespace Tests\Feature;

use App\Common\Middleware\ValidateBearerToken;
use Illuminate\Foundation\Testing\TestCase;

class ValidateBearerTokenTest extends TestCase
{
    public function testRequestWithoutAuthorizationHeaderFails()
    {
        $response = $this->get('/api/exchange');
        $response->assertStatus(401);
        $response->assertJson(['error' => 'Unauthorized']);
    }
    
    public function testRequestWithInvalidTokenFails()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer {invalid'
        ])->get('/api/exchange');

        $response->assertStatus(401);
        $response->assertJson(['error' => 'Invalid token format']);
    }
    
    public function testRequestWithValidTokenPassesMiddleware()
    {
        $this->app['router']->get('/test-middleware', function() {
            return response()->json(['success' => true]);
        })->middleware(ValidateBearerToken::class);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer {}'
        ])->get('/test-middleware');

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
    }
}
