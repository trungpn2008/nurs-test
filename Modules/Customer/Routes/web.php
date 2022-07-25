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
    Route::prefix('choose-profile-category')->name('choose-profile-category.')->group(function() {
        Route::get('/', 'ChooseProfileCategoryController@index')->name('index');
        Route::get('/add', 'ChooseProfileCategoryController@create')->name('add');
        Route::post('/add', 'ChooseProfileCategoryController@store');
        Route::get('/edit/{id?}', 'ChooseProfileCategoryController@edit')->name('edit');
        Route::post('/edit/{id?}', 'ChooseProfileCategoryController@update');
        Route::get('/show/{id?}', 'ChooseProfileCategoryController@show')->name('show');
        Route::get('/delete/{id?}', 'ChooseProfileCategoryController@destroy')->name('delete');
        Route::get('/ajax-get-list-choose-profile-category', 'ChooseProfileCategoryController@getChooseProfileCategory')->name('ajax-get-list-choose-profile-category');
    });
    Route::prefix('list-profile-option')->name('list-profile-option.')->group(function() {
        Route::get('/', 'ListProfileOptionController@index')->name('index');
        Route::get('/add', 'ListProfileOptionController@create')->name('add');
        Route::post('/add', 'ListProfileOptionController@store');
        Route::get('/edit/{id?}', 'ListProfileOptionController@edit')->name('edit');
        Route::post('/edit/{id?}', 'ListProfileOptionController@update');
        Route::get('/show/{id?}', 'ListProfileOptionController@show')->name('show');
        Route::get('/delete/{id?}', 'ListProfileOptionController@destroy')->name('delete');
        Route::get('/ajax-get-list-choose-profile-category', 'ListProfileOptionController@listChooseProfileCategory')->name('ajax-get-list-choose-profile-category');
    });
    Route::prefix('customer')->name('customer.')->group(function() {
        Route::get('/', 'CustomerController@index')->name('index');
        Route::get('/show/{id?}', 'CustomerController@show')->name('show');
    });
});
