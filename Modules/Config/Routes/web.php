<?php
use Illuminate\Support\Facades\Route;
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

/*Route::prefix('config')->group(function() {
    Route::get('/', 'ConfigController@index');
});*/
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function() {
    Route::prefix('config')->name('config.')->group(function() {
        Route::get('/', 'ConfigController@index')->name('index');
        Route::get('/add', 'ConfigController@create')->name('add');
        Route::post('/add', 'ConfigController@store');
        Route::get('/edit/{id?}', 'ConfigController@edit')->name('edit');
        Route::post('/edit/{id?}', 'ConfigController@update');
        Route::get('/show/{id?}', 'ConfigController@show')->name('show');
        Route::get('/delete/{id?}', 'ConfigController@destroy')->name('delete');
        Route::get('/ajax-get-box-config', 'ConfigController@getBoxConfig')->name('ajax-get-box-config');
        Route::get('/{type?}', 'ConfigController@editConfig')->name('editHome');
        Route::post('/update/{type?}', 'ConfigController@updateConfig')->name('updateHome');
    });
});
