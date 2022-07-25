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
    Route::prefix('investigation-type')->name('investigation-type.')->group(function() {
        Route::get('/', 'InvestigationTypeController@index')->name('index');
        Route::get('/add', 'InvestigationTypeController@create')->name('add');
        Route::post('/add', 'InvestigationTypeController@store');
        Route::get('/edit/{id?}', 'InvestigationTypeController@edit')->name('edit');
        Route::post('/edit/{id?}', 'InvestigationTypeController@update');
        Route::get('/show/{id?}', 'InvestigationTypeController@show')->name('show');
        Route::get('/delete/{id?}', 'InvestigationTypeController@destroy')->name('delete');
        Route::get('/ajax-get-investigation-type', 'InvestigationTypeController@getInvestigationType')->name('ajax-get-investigation-type');
    });
});
