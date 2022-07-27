<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('faqs')->name('faqs.')->group(function() {
    Route::get('/list', 'FAQController@listFaq')->name('listing');
});

Route::prefix('faq-category')->name('faq-category.')->group(function() {
    Route::get('/list', 'FAQCategoryController@listFaqCategory')->name('listing');
    Route::get('/detail/{id?}', 'FAQCategoryController@detailFaqCategory')->name('detail');
});
