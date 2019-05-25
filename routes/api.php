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

Route::group(['prefix'=>'', 'as'=>'api.', 'namespace'=>'Auth'], function() {
	Route::apiResource('users', 'UserController');
});

Route::group(['prefix'=>'core', 'as'=>'api.Core.', 'namespace'=>'Core', 'middleware'=>'auth:api'], function() {
	Route::apiResource('publicaciones', 'PublicacionController', ['parameters'=>['publicacion'=>'PUBL_ID']]);
});