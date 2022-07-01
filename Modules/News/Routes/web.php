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

Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function() {
    Route::prefix('news')->name('news.')->group(function() {
        Route::get('/', 'NewsController@index')->name('index');
        Route::get('/add', 'NewsController@create')->name('add');
        Route::post('/add', 'NewsController@store');
        Route::get('/edit/{id?}', 'NewsController@edit')->name('edit');
        Route::post('/edit/{id?}', 'NewsController@update');
        Route::get('/show/{id?}', 'NewsController@show')->name('show');
        Route::get('/delete/{id?}', 'NewsController@destroy')->name('delete');
    });
});

