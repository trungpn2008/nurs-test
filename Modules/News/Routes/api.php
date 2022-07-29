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

//Route::prefix('api')->name('api.')->group(function() {
    Route::prefix('news')->name('news.')->group(function() {
        Route::get('/list', 'NewsController@listArticle')->name('listing');
        Route::get('/list-news-column', 'NewsController@listNewAndColumn')->name('list-news-column');
        Route::get('/detail', 'NewsController@listDetail')->name('detail');
        Route::get('/list-popular', 'NewsController@listPopular')->name('popular');
    });
//});
