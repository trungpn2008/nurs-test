<?php

use Illuminate\Http\Request;

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

Route::prefix('images-type')->name('images-type.')->group(function() {
    Route::get('/', 'BlueprintTypeController@listType')->name('listing');
    Route::get('/detail', 'BlueprintTypeController@listDetail')->name('detail');
});
