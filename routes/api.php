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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => ['cors']], function () {
    //
    Route::post('/register', 'API\AuthController@register');
    Route::post('/gettoken', 'API\AuthController@getToken');

    Route::group(['middleware' => ['check.auth']], function () {
        Route::get('/product', 'API\ProductController@index')->name('api.product');
    });

});
