<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Defines the web routes for the application.
|
*/

// Default welcome page
// Example: http://127.0.0.1:8000/
// Route::get('/', function () {
//     return view('welcome');
// });

// Redirect to API route
Route::get('/', function () {
    return redirect('api/documentation#/Exchange');
});
