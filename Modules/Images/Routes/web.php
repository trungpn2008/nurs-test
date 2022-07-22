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

/*Route::prefix('images')->group(function() {
    Route::get('/', 'ImagesController@index');
});*/
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function() {
    Route::prefix('images')->name('images.')->group(function() {
        Route::get('/', 'ImagesController@index')->name('index');
        Route::get('/add', 'ImagesController@create')->name('add');
        Route::post('/add', 'ImagesController@store');
        Route::get('/edit/{id?}', 'ImagesController@edit')->name('edit');
        Route::post('/edit/{id?}', 'ImagesController@update');
        Route::get('/show/{id?}', 'ImagesController@show')->name('show');
        Route::get('/delete/{id?}', 'ImagesController@destroy')->name('delete');
        Route::get('/ajax-get-box-images', 'ImagesController@getBoxImages')->name('ajax-get-box-images');
    });
    Route::prefix('partner')->name('partner.')->group(function() {
        Route::get('/', 'PartnerController@index')->name('index');
        Route::get('/add', 'PartnerController@create')->name('add');
        Route::post('/add', 'PartnerController@store');
        Route::get('/edit/{id?}', 'PartnerController@edit')->name('edit');
        Route::post('/edit/{id?}', 'PartnerController@update');
        Route::get('/show/{id?}', 'PartnerController@show')->name('show');
        Route::get('/delete/{id?}', 'PartnerController@destroy')->name('delete');
    });
});
