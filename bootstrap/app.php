<?php

use App\Modules\Exchange\Presentation\Http\Middleware\ThrottleRequests;
use App\Common\Middleware\RequestLogger;
use App\Common\Middleware\SecurityMiddleware;
use App\Common\Middleware\ValidateBearerToken;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(RequestLogger::class);
        $middleware->append(SecurityMiddleware::class);

        $middleware->alias(['auth.bearer' => ValidateBearerToken::class]);
        $middleware->alias(['throttle.exchange' => ThrottleRequests::class]);

        $middleware->appendToGroup('exchange', [
            ValidateBearerToken::class,
            ThrottleRequests::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        });
    })->create();
