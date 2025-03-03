<?php

namespace App\Common\Security;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class RateLimiter
{
    /**
     * Check if user has hit the request limit.
     *
     * @param Request $request
     * @param int $maxAttempts
     * @param int $decaySeconds    
     * @return bool
     */
    public static function tooManyAttempts(Request $request, int $maxAttempts = 60, int $decaySeconds = 60): bool
    {
        $key = self::resolveRequestSignature($request);
        $attempts = Redis::incr($key);
        if ($attempts === 1) {
            Redis::expire($key, $decaySeconds);
        }

        return $attempts > $maxAttempts;
    }

    /**
     *  Generates a unique key to track requests from a specific user.
     *
     * @param Request $request
     * @return string
     */
    protected static function resolveRequestSignature(Request $request): string
    {
        return 'rate_limiter:' . md5($request->ip() . '|' . $request->path());
    }
}
