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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('tags', 'App\Http\Controllers\API\TagsController@index');
    Route::post('tags', 'App\Http\Controllers\API\TagsController@store');
    Route::put('tags/{id}', 'App\Http\Controllers\API\TagsController@update');
});
