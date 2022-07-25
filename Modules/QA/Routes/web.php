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
    Route::prefix('qa')->name('qa.')->group(function() {
        Route::get('/', 'QAController@index')->name('index');
        Route::get('/add', 'QAController@create')->name('add');
        Route::post('/add', 'QAController@store');
        Route::get('/edit/{id?}', 'QAController@edit')->name('edit');
        Route::post('/edit/{id?}', 'QAController@update');
        Route::get('/show/{id?}', 'QAController@show')->name('show');
        Route::get('/delete/{id?}', 'QAController@destroy')->name('delete');
    });
    Route::prefix('qa-type')->name('qa-type.')->group(function() {
        Route::get('/', 'QATypeController@index')->name('index');
        Route::get('/add', 'QATypeController@create')->name('add');
        Route::post('/add', 'QATypeController@store');
        Route::get('/edit/{id?}', 'QATypeController@edit')->name('edit');
        Route::post('/edit/{id?}', 'QATypeController@update');
        Route::get('/show/{id?}', 'QATypeController@show')->name('show');
        Route::get('/delete/{id?}', 'QATypeController@destroy')->name('delete');
        Route::get('/ajax-qa-type', 'QACateController@getQaType')->name('ajax-qa-type');
    });
    Route::prefix('qa-cate')->name('qa-cate.')->group(function() {
        Route::get('/', 'QACateController@index')->name('index');
        Route::get('/add', 'QACateController@create')->name('add');
        Route::post('/add', 'QACateController@store');
        Route::get('/edit/{id?}', 'QACateController@edit')->name('edit');
        Route::post('/edit/{id?}', 'QACateController@update');
        Route::get('/show/{id?}', 'QACateController@show')->name('show');
        Route::get('/delete/{id?}', 'QACateController@destroy')->name('delete');
        Route::get('/ajax-qa-cate', 'QACateController@getQaCate')->name('ajax-qa-cate');
    });
    Route::prefix('qa-answer')->name('qa-answer.')->group(function() {
        Route::get('/', 'QAAnswerController@index')->name('index');
        Route::get('/add', 'QAAnswerController@create')->name('add');
        Route::post('/add', 'QAAnswerController@store');
        Route::get('/edit/{id?}', 'QAAnswerController@edit')->name('edit');
        Route::post('/edit/{id?}', 'QAAnswerController@update');
        Route::get('/show/{id?}', 'QAAnswerController@show')->name('show');
        Route::get('/delete/{id?}', 'QAAnswerController@destroy')->name('delete');
    });
});
