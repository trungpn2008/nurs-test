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

/*Route::prefix('applies')->group(function() {
    Route::get('/', 'AppliesController@index');
});*/
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function() {
    Route::prefix('applies')->name('applies.')->group(function() {
        Route::get('/', 'AppliesController@index')->name('index');
        Route::get('/add', 'AppliesController@create')->name('add');
        Route::post('/add', 'AppliesController@store');
        Route::get('/edit/{id?}', 'AppliesController@edit')->name('edit');
        Route::post('/edit/{id?}', 'AppliesController@update');
        Route::get('/show/{id?}', 'AppliesController@show')->name('show');
        Route::get('/delete/{id?}', 'AppliesController@destroy')->name('delete');
    });
});
