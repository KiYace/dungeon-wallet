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
    Route::get('expenses/{bill_id?}', 'App\Http\Controllers\API\ExpensesController@index');
    Route::post('expenses/', 'App\Http\Controllers\API\ExpensesController@store');
});
