<?php

/**
 ** Basic Routes for a RESTful service:
 **
 ** Route::get($uri, $callback);
 ** Route::post($uri, $callback);
 ** Route::put($uri, $callback);
 ** Route::delete($uri, $callback);
 **
 **/
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'Api\AuthController@login');
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('logout', 'Api\AuthController@logout');
        Route::get('user', 'Api\AuthController@user');
    });
});
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('products', 'Api\ProductController@index');
    Route::post('products', 'Api\ProductController@store');
    Route::get('products/{product}', 'Api\ProductController@show');
    Route::put('products/{product}', 'Api\ProductController@update');
    Route::delete('products/{product}', 'Api\ProductController@delete');
});
Route::delete('attributes/{attribute}', 'Api\AttributeController@delete');
Route::get('categories/{id}/attributes', 'CategoryController@attributes');

