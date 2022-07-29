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
Route::prefix('qa-cate')->name('qa-cate.')->group(function() {
    Route::get('/list', 'QACateController@listQaCate')->name('listing');
});
Route::prefix('qa')->name('qa.')->group(function() {
    Route::middleware(['auth.client'])->group( function() {
        Route::get('/list', 'QAController@listQA')->name('list');
        Route::post('/add', 'QAController@AddQa')->name('add');
    });
});
Route::prefix('qa-type')->name('qa-type.')->group(function() {
    Route::get('/list', 'QATypeController@listQaType')->name('listing');
});
