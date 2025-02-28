<?php

namespace App\Common\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RequestLogger
{
    /**
     * Log request info if debugging is on.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!config('app.debug')) {
            return $next($request); 
        }

        try {
            Log::info('Request received', [
                'url'     => $request->fullUrl(),
                'method'  => $request->method(),
                'ip'      => $request->ip(),
                'payload' => $request->all(),
            ]);
            
        } catch (\Exception $exc) {
            Log::error('Logging failed: ' . $exc->getMessage());
        }

        return $next($request);
    }
}
