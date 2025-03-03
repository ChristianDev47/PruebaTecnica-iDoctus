<?php

namespace App\Common\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Common\Helpers\BracketValidator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class ValidateBearerToken
{
    /**
     * Checks if the request has a valid Bearer token.
     * 
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $authHeader = $request->header('Authorization');

        if (!Str::startsWith($authHeader, 'Bearer ')) {
            return response()->json(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }

        $token = Str::after($authHeader, 'Bearer ');

        if (!BracketValidator::isValid($token)) {
            return response()->json(['error' => 'Invalid token format'], Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
