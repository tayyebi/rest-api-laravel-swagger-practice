<?php

use App\Http\Middleware\HandlePutFormData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group([
    'prefix' => 'v1', 
    'as' => 'api.', 
    'namespace' => 'App\Http\Controllers\V1', 
    'middleware' => []
  ], function () {
    Route::post('register', 'UsersController@store');
    Route::post('login', 'UsersController@login');
});


Route::group([
    'prefix' => 'v1', 
    'as' => 'api.', 
    'namespace' => 'App\Http\Controllers\V1', 
    'middleware' => [
            // App\Http\Middleware\HandlePutFormData::class,
            'auth:api',
        ]
  ], function () {
    Route::apiResource('provinces', 'ProvincesController');
    Route::apiResource('cities', 'CitiesController');
});