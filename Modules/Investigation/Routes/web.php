<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function() {
    Route::prefix('investigation')->name('investigation.')->group(function() {
        Route::get('/', 'InvestigationController@index')->name('index');
        Route::get('/show/{id?}', 'InvestigationController@show')->name('show');
    });

});
