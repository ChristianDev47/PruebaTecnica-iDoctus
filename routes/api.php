<?php

use Illuminate\Support\Facades\Route;
use L5Swagger\Http\Controllers\SwaggerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Registers all API routes.
|
*/

// Include Exchange module routes
require base_path('app/Modules/Exchange/Presentation/Routes/exchange.php');

// API Documentation endpoint
// Example: http://127.0.0.1:8000/api/documentation
// Route::get('/documentation', [SwaggerController::class, 'api'])->name('l5-swagger.api');