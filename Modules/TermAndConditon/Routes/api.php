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

Route::prefix('term-and-condition')->name('term-and-condition.')->group(function() {
    Route::post('/add', 'TermAndConditonController@addInvestigation')->name('investigation');
});
Route::prefix('term-and-condition-category')->name('term-and-condition-category.')->group(function() {
    Route::get('/list', 'TermAndConditonCategoryController@listTernConditionCategory')->name('term-and-condition-category');
    Route::get('/detail/{id?}', 'TermAndConditonCategoryController@detailTernConditionCategory')->name('detail-term-and-condition-category');
});
