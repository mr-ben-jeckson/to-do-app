<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// List Products
Route::get('/products', 'ProductsController@index');

// Single Products
Route::get('/product/{id}', 'ProductsController@show');

// Create Products
Route::post('/product', 'ProductsController@store');

// Update Products
Route::put('/product', 'ProductsController@store');

// Delete Products
Route::delete('/product/{id}', 'ProductsController@destroy');

// Task Finished
Route::get('/product/finish/{id}', 'ProductController@finish');

// Task Finished
Route::get('/product/todo/{id}', 'ProductController@todo');

// Nav Bar
Route::get('/product/check', 'ProductController@check');
