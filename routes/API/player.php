<?php

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

Route::post('player', 'App\Http\Controllers\API\PlayerController@store');
Route::middleware('auth:sanctum')
    ->put('player', 'App\Http\Controllers\API\PlayerController@update');
Route::middleware('auth:sanctum')
    ->put('player/change_password', 'App\Http\Controllers\API\PlayerController@changePassword');
