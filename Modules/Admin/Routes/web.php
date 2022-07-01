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
Route::prefix('admin')->group(function() {
    Route::get('/login', 'AdminController@index')->name('login');
    Route::post('/login', 'AdminController@login');
    Route::get('/logout', 'AdminController@logout')->name('logout');
});
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function() {
    Route::prefix('roles')->name('roles.')->group(function() {
        Route::get('/', 'RoleController@index')->name('index');
        Route::get('/add', 'RoleController@create')->name('add');
        Route::post('/add', 'RoleController@store');
        Route::get('/edit/{id?}', 'RoleController@edit')->name('edit');
        Route::post('/edit/{id?}', 'RoleController@update');
        Route::get('/show/{id?}', 'RoleController@show')->name('show');
        Route::get('/delete/{id?}', 'RoleController@destroy')->name('delete');
        Route::get('/ajax-get-users', 'RoleController@getUsers')->name('ajax-get-users');
        Route::post('/ajax-add-role-user', 'RoleController@ajaxAddRoleUser')->name('ajax-add-role-user');
        Route::get('/ajax-form-role-user-permission', 'RoleController@getFormAddRoleUserPermission')->name('ajax-form-role-user-permission');
        Route::post('/add-user-permission', 'RoleController@addUserPermission')->name('add-user-permission');
    });
    Route::prefix('permission')->name('permission.')->group(function() {
        Route::get('/', 'PermissionController@index')->name('index');
        Route::get('/add', 'PermissionController@create')->name('add');
        Route::post('/add', 'PermissionController@store');
        Route::get('/edit/{id?}', 'PermissionController@edit')->name('edit');
        Route::post('/edit/{id?}', 'PermissionController@update');
        Route::get('/show/{id?}', 'PermissionController@show')->name('show');
        Route::get('/delete/{id?}', 'PermissionController@destroy')->name('delete');
    });
    Route::prefix('option')->name('option.')->group(function() {
        Route::get('/', 'OptionActionPermissionController@index')->name('index');
        Route::get('/add', 'OptionActionPermissionController@create')->name('add');
        Route::post('/add', 'OptionActionPermissionController@store');
        Route::get('/edit/{id?}', 'OptionActionPermissionController@edit')->name('edit');
        Route::post('/edit/{id?}', 'OptionActionPermissionController@update');
        Route::get('/show/{id?}', 'OptionActionPermissionController@show')->name('show');
        Route::get('/delete/{id?}', 'OptionActionPermissionController@destroy')->name('delete');
    });
});
