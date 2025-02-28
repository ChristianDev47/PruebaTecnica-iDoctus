<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Exchange\Presentation\Http\Controllers\Api\v1\ExchangeController;


// Exchange rate API endpoint
// http://127.0.0.1:8000/api/exchange
Route::get('/exchange', [ExchangeController::class, 'getExchange'])->middleware('exchange');
