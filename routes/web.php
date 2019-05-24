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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::prefix('admin')->middleware('auth')->group(function() {
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
    Route::resource('categories','CategoryController')->except('show');
    Route::resource('products','ProductController')->except('show');
});