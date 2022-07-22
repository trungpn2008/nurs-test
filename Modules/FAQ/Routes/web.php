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
    Route::prefix('faqs')->name('faqs.')->group(function() {
        Route::get('/', 'FAQController@index')->name('index');
        Route::get('/add', 'FAQController@create')->name('add');
        Route::post('/add', 'FAQController@store');
        Route::get('/edit/{id?}', 'FAQController@edit')->name('edit');
        Route::post('/edit/{id?}', 'FAQController@update');
        Route::get('/show/{id?}', 'FAQController@show')->name('show');
        Route::get('/delete/{id?}', 'FAQController@destroy')->name('delete');
        Route::get('/ajax-get-category-faq', 'FAQController@getFaqCategory')->name('ajax-get-category-faq');
    });
    Route::prefix('faqcates')->name('faqcates.')->group(function() {
        Route::get('/', 'FAQCategoryController@index')->name('index');
        Route::get('/add', 'FAQCategoryController@create')->name('add');
        Route::post('/add', 'FAQCategoryController@store');
        Route::get('/edit/{id?}', 'FAQCategoryController@edit')->name('edit');
        Route::post('/edit/{id?}', 'FAQCategoryController@update');
        Route::get('/show/{id?}', 'FAQCategoryController@show')->name('show');
        Route::get('/delete/{id?}', 'FAQCategoryController@destroy')->name('delete');
        Route::get('/ajax-get-category-faq', 'FAQCategoryController@getFaqCategory')->name('ajax-get-category-faq');
    });
});
