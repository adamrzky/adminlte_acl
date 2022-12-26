<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

   
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
    // Route::resource('products','ProductController');
    Route::resource('permissions', 'PermissionController');

    //Product
    Route::get('/products', 'ProductController@index')->name('products.index');
    Route::get('/products/broadcast/{id}', 'ProductController@broadcast')->name('products.broadcast');
    Route::get('/products/show/{id}', 'ProductController@show')->name('products.show');
    Route::get('/products/{id}/edit', 'ProductController@edit')->name('products.edit');
    Route::get('/products/create', 'ProductController@create')->name('products.create');
    Route::put('/products/update/{product}', 'ProductController@update')->name('products.update');
    Route::post('/products/store', 'ProductController@store')->name('products.store');
    Route::delete('/products/{product}/destroy', 'ProductController@destroy')->name('products.destroy');



});
