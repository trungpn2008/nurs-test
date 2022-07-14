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

/*Route::prefix('categorytype')->group(function() {
    Route::get('/', 'CategoryTypeController@index');
});*/
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function() {
    Route::prefix('categorytype')->name('categorytype.')->group(function() {
        Route::get('/', 'CategoryTypeController@index')->name('index');
        Route::get('/add', 'CategoryTypeController@create')->name('add');
        Route::post('/add', 'CategoryTypeController@store');
        Route::get('/edit/{id?}', 'CategoryTypeController@edit')->name('edit');
        Route::post('/edit/{id?}', 'CategoryTypeController@update');
        Route::get('/show/{id?}', 'CategoryTypeController@show')->name('show');
        Route::get('/delete/{id?}', 'CategoryTypeController@destroy')->name('delete');
        Route::get('/ajax-get-category-type', 'CategoryTypeController@getCategoryType')->name('ajax-get-category-type');
    });
});
