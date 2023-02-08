<?php

use Illuminate\Http\Request;
use App\Http\Controllers\SignUp;
use App\Http\Controllers\test;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/signup', [SignUp::class, 'SignUp']);
Route::post('/signin', [SignUp::class, 'Login']);
Route::get('/test', [test::class, 'test']);


Route::middleware(['auth:sanctum'])->group(function () {
    Route::namespace('App\Http\Controllers')->group(function () {
        Route::post('/logout', 'SignUp@logout');
        Route::post('/create', 'CreateItem@CreateItem');

        //Fields
        Route::get('/user', 'UserDetails@user_details');
        Route::get('/article', 'GetData\Fields@get_article');
        Route::get('/types', 'GetData\Fields@get_types');
        Route::get('/status', 'GetData\Fields@get_status');
        Route::get('/supplier', 'GetData\Fields@get_supplier');


        //Item details
        Route::GET('/itemtable', 'ItemController@multiq');
        Route::GET('/item', 'ItemController@index');
        Route::GET('/itemdetail/{id}', 'ItemController@query');

        Route::GET('/location', 'LocationController@index');
        Route::GET('/assoc/{id}', 'AssocController@show');
        Route::GET('/assoc', 'AssocController@index');
        Route::GET('/condition', 'ConditionController@query');

        //
        Route::GET('/type', 'TypesController@index');
        Route::GET('/brand', 'BrandController@index');
        Route::post('/inv', 'InventoryController@store');

        //Table
        Route::get('/data-table', 'GetData\Table@data_table');
        Route::get('/available', 'GetData\Table@available');
        Route::get('/details', 'GetData\Table@details');
    });
});
