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

/*Route::prefix('blueprinttype')->group(function() {
    Route::get('/', 'BlueprintTypeController@index');
});*/
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function() {
    Route::prefix('blueprint-type')->name('blueprinttype.')->group(function() {
        Route::get('/', 'BlueprintTypeController@index')->name('index');
        Route::get('/add', 'BlueprintTypeController@create')->name('add');
        Route::post('/add', 'BlueprintTypeController@store');
        Route::get('/edit/{id?}', 'BlueprintTypeController@edit')->name('edit');
        Route::post('/edit/{id?}', 'BlueprintTypeController@update');
        Route::get('/show/{id?}', 'BlueprintTypeController@show')->name('show');
        Route::get('/delete/{id?}', 'BlueprintTypeController@destroy')->name('delete');
        Route::get('/ajax-get', 'BlueprintTypeController@getBlueprintType')->name('ajax-get');
    });
});
