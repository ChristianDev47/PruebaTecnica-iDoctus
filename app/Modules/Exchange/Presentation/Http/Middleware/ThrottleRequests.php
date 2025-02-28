<?php

namespace App\Modules\Exchange\Presentation\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Common\Security\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

class ThrottleRequests
{
    /**
     * Blocks requests if the user exceeds their allowed limit.
     * 
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (RateLimiter::tooManyAttempts($request)) {
            return response()->json(['error' => 'Too many requests'], Response::HTTP_TOO_MANY_REQUESTS);
        }
        return $next($request);
    }
}
