<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('App\Http\Controllers')->group(function () {
    // Route::post('/details', 'InsertDetails@insert_details');
    Route::post('/create', 'CreateItem@CreateItem');

    //Fields
    Route::get('/article', 'GetData\Fields@get_article');
    Route::get('/types', 'GetData\Fields@get_types');
    Route::get('/status', 'GetData\Fields@get_status');
    Route::get('/supplier', 'GetData\Fields@get_supplier');

    // Route::get('/test', 'test@test');
});
