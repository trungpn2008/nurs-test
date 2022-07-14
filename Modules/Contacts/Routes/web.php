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

/*Route::prefix('contacts')->group(function() {
    Route::get('/', 'ContactsController@index');
});*/
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function() {
    Route::prefix('contacts')->name('contacts.')->group(function() {
        Route::get('/', 'ContactsController@index')->name('index');
        Route::get('/add', 'ContactsController@create')->name('add');
        Route::post('/add', 'ContactsController@store');
        Route::get('/edit/{id?}', 'ContactsController@edit')->name('edit');
        Route::post('/edit/{id?}', 'ContactsController@update');
        Route::get('/show/{id?}', 'ContactsController@show')->name('show');
        Route::get('/delete/{id?}', 'ContactsController@destroy')->name('delete');
    });
});
