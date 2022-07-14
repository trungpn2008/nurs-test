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

/*Route::prefix('projects')->group(function() {
    Route::get('/', 'ProjectsController@index');
});*/
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function() {
    Route::prefix('projects')->name('projects.')->group(function() {
        Route::get('/', 'ProjectsController@index')->name('index');
        Route::get('/add', 'ProjectsController@create')->name('add');
        Route::post('/add', 'ProjectsController@store');
        Route::get('/edit/{id?}', 'ProjectsController@edit')->name('edit');
        Route::post('/edit/{id?}', 'ProjectsController@update');
        Route::get('/show/{id?}', 'ProjectsController@show')->name('show');
        Route::get('/delete/{id?}', 'ProjectsController@destroy')->name('delete');
        Route::get('/ajax-get-box', 'ProjectsController@getBox')->name('ajax-get-box');
        Route::get('/ajax-get-projects', 'ProjectsController@getProjects')->name('ajax-get-projects');
    });
});
