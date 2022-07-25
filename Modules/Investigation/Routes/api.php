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

Route::prefix('investigation')->name('investigation.')->group(function() {
    Route::post('/add', 'InvestigationController@addInvestigation')->name('investigation');
});
Route::prefix('investigation-type')->name('investigation-type.')->group(function() {
    Route::get('/list', 'InvestigationTypeController@listInvestigationType')->name('investigation-type');
});
