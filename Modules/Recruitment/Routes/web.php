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

/*Route::prefix('recruitment')->group(function() {
    Route::get('/', 'RecruitmentController@index');
});*/
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function() {
    Route::prefix('recruitment')->name('recruitment.')->group(function() {
        Route::get('/', 'RecruitmentController@index')->name('index');
        Route::get('/add', 'RecruitmentController@create')->name('add');
        Route::post('/add', 'RecruitmentController@store');
        Route::get('/edit/{id?}', 'RecruitmentController@edit')->name('edit');
        Route::post('/edit/{id?}', 'RecruitmentController@update');
        Route::get('/show/{id?}', 'RecruitmentController@show')->name('show');
        Route::get('/delete/{id?}', 'RecruitmentController@destroy')->name('delete');
    });
});

//Route::get('{slug?}', '\App\Http\Controllers\Frontend\CategoryController@index')->name('frontend.category');
//Route::get('{cate?}/{slug?}', '\App\Http\Controllers\Frontend\ProjectController@index')->name('frontend.project');
