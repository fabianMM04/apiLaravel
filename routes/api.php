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

Route::post('/service', [
    'uses' => 'ServiceController@postService',
    'middleware' => 'auth.jwt'
]);

Route::get('/services', [
   'uses' => 'ServiceController@getServices'
]);

Route::put('/service/{id}', [
    'uses' => 'ServiceController@putService',
    'middleware' => 'auth.jwt'
]);

Route::delete('/service/{id}', [
    'uses' => 'ServiceController@deleteService',
    'middleware' => 'auth.jwt'
]);

Route::post('/user',[
	'uses'=> 'UserController@signup'
]);

Route::post('/user/signin',[
	'uses'=> 'UserController@signin'
]);