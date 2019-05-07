<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;

/**
 ** Basic Routes for a RESTful service:
 **
 ** Route::get($uri, $callback);
 ** Route::post($uri, $callback);
 ** Route::put($uri, $callback);
 ** Route::delete($uri, $callback);
 **
 **/

Route::get('products','Api\ProductController@index');

Route::get('products/{product}', 'Api\ProductController@show');

Route::post('products', 'Api\ProductController@store');

Route::put('products/{product}','Api\ProductController@update');

Route::delete('products/{product}','Api\ProductController@delete');
