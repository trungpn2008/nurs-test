<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('customer')->name('customer.')->group(function() {
    Route::post('/login', 'CustomerController@login')->name('login');
    Route::post('/register', 'CustomerController@register')->name('register');
    Route::middleware(['auth.client'])->group( function() {
        Route::post('/update-profile/{id?}', 'CustomerController@updateProfile')->name('update-profile');
    });
});
