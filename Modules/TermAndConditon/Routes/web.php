<?php

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
    Route::prefix('term-and-condition')->name('term-and-condition.')->group(function() {
        Route::get('/', 'TermAndConditonController@index')->name('index');
        Route::get('/add', 'TermAndConditonController@create')->name('add');
        Route::post('/add', 'TermAndConditonController@store');
        Route::get('/edit/{id?}', 'TermAndConditonController@edit')->name('edit');
        Route::post('/edit/{id?}', 'TermAndConditonController@update');
        Route::get('/show/{id?}', 'TermAndConditonController@show')->name('show');
        Route::get('/delete/{id?}', 'TermAndConditonController@destroy')->name('delete');
        Route::get('/ajax-get-category-term-condition', 'TermAndConditonController@getTernAndConditionCategory')->name('ajax-get-category-term-condition');
    });
    Route::prefix('term-and-condition-category')->name('term-and-condition-category.')->group(function() {
        Route::get('/', 'TermAndConditonCategoryController@index')->name('index');
        Route::get('/add', 'TermAndConditonCategoryController@create')->name('add');
        Route::post('/add', 'TermAndConditonCategoryController@store');
        Route::get('/edit/{id?}', 'TermAndConditonCategoryController@edit')->name('edit');
        Route::post('/edit/{id?}', 'TermAndConditonCategoryController@update');
        Route::get('/show/{id?}', 'TermAndConditonCategoryController@show')->name('show');
        Route::get('/delete/{id?}', 'TermAndConditonCategoryController@destroy')->name('delete');
        Route::get('/ajax-get-category-faq', 'TermAndConditonCategoryController@getFaqCategory')->name('ajax-get-category-faq');
    });
});
