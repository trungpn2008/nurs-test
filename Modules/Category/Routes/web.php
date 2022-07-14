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
    Route::prefix('category')->name('category.')->group(function() {
        Route::get('/', 'CategoryController@index')->name('index');
        Route::get('/add', 'CategoryController@create')->name('add');
        Route::post('/add', 'CategoryController@store');
        Route::get('/edit/{id?}', 'CategoryController@edit')->name('edit');
        Route::post('/edit/{id?}', 'CategoryController@update');
        Route::get('/show/{id?}', 'CategoryController@show')->name('show');
        Route::get('/delete/{id?}', 'CategoryController@destroy')->name('delete');
        Route::get('/ajax-get-category', 'CategoryController@getCategory')->name('ajax-get-category');
        Route::get('/ajax-get-form', 'CategoryController@getForm')->name('ajax-get-form');
        Route::get('/ajax-box', 'CategoryController@getBox')->name('ajax-box');
    });
});
