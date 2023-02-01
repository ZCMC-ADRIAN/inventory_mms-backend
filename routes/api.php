<?php

use Illuminate\Http\Request;
use App\Http\Controllers\SignUp;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/signup', [SignUp::class, 'SignUp']);
Route::post('/signin', [SignUp::class, 'Login']);


Route::middleware(['auth:sanctum'])->group(function () {
    Route::namespace('App\Http\Controllers')->group(function () {
        Route::post('/create', 'CreateItem@CreateItem');
        Route::post('/logout', 'SignUp@logout');

        //Fields
        Route::get('/user', 'UserDetails@user_details');
        Route::get('/article', 'GetData\Fields@get_article');
        Route::get('/types', 'GetData\Fields@get_types');
        Route::get('/status', 'GetData\Fields@get_status');
        Route::get('/supplier', 'GetData\Fields@get_supplier');

        //Table
        Route::get('/data-table', 'GetData\Table@data_table');
        Route::get('/available', 'GetData\Table@available');
        Route::get('/details', 'GetData\Table@details');
        // Route::get('/test', 'test@test');
    });
});
