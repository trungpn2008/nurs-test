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

/*Route::prefix('alias')->group(function() {
    Route::get('/', 'AliasController@index');
});*/
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function() {
    Route::prefix('alias')->name('alias.')->group(function() {
        Route::get('/', 'AliasController@index')->name('index');
        Route::get('/add', 'AliasController@create')->name('add');
        Route::post('/add', 'AliasController@store');
        Route::get('/edit/{id?}', 'AliasController@edit')->name('edit');
        Route::post('/edit/{id?}', 'AliasController@update');
        Route::get('/show/{id?}', 'AliasController@show')->name('show');
        Route::get('/delete/{id?}', 'AliasController@destroy')->name('delete');
    });
});
