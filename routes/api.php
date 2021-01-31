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



Route::post('login', 'API\AuthController@login');
Route::group([
 
   'middleware' => ['api','jwt.verify'],
 
], function ($router) { 
    Route::post('logout', 'API\AuthController@logout');
    Route::post('refresh', 'API\AuthController@refresh');
    Route::post('me', 'API\AuthController@me');

    Route::post('users', 'API\UserController@store');
    Route::get('users', 'API\UserController@index');

    Route::get('products', 'API\ProductController@index');
});
