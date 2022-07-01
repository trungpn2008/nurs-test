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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::prefix('admin')->name('admin.')->group(function (){
    Route::post('action', 'Controller@action')->name('action');
    Route::namespace('Backend')->middleware('auth:admin')->group(base_path('routes/backend.php'));
});
Route::name('frontend.')->group(function (){
    Route::namespace('Frontend')->group(base_path('routes/frontend.php'));
});
Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
    ->name('ckfinder_connector');

Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
    ->name('ckfinder_browser');
