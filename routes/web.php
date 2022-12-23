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
    // Route::resource('roles','RoleController');
    // Route::resource('users','UserController');
    // Route::resource('products','ProductController');
    // Route::resource('permissions', 'PermissionController');

    //Product
    Route::get('/products', 'ProductController@index')->name('products.index');
    Route::get('/products/broadcast/{id}', 'ProductController@broadcast')->name('products.broadcast');
    Route::get('/products/show/{id}', 'ProductController@show')->name('products.show');
    Route::get('/products/{id}/edit', 'ProductController@edit')->name('products.edit');
    Route::get('/products/create', 'ProductController@create')->name('products.create');
    Route::put('/products/update/{product}', 'ProductController@update')->name('products.update');
    Route::post('/products/store', 'ProductController@store')->name('products.store');
    Route::delete('/products/{product}/destroy', 'ProductController@destroy')->name('products.destroy');

    //User
    Route::get('/users', 'UserController@index')->name('users.index');
    Route::get('/users/show/{id}', 'UserController@show')->name('users.show');
    Route::get('/users/{id}/edit', 'UserController@edit')->name('users.edit');
    Route::get('/users/create', 'UserController@create')->name('users.create');
    Route::PUT('/users/update/{product}', 'UserController@update')->name('users.update');
    Route::post('/users/store', 'UserController@store')->name('users.store');
    Route::delete('/users/{product}/destroy', 'UserController@destroy')->name('users.destroy');

    //Role  
    
    Route::get('/roles', 'RoleController@index')->name('roles.index');
    Route::get('/roles/show/{id}', 'RoleController@show')->name('roles.show');
    Route::get('/roles/{id}/edit', 'RoleController@edit')->name('roles.edit');
    Route::get('/roles/create', 'RoleController@create')->name('roles.create');
    Route::patch('/roles/update/{product}', 'RoleController@update')->name('roles.update');
    Route::post('/roles/store', 'RoleController@store')->name('roles.store');
    Route::delete('/roles/{product}/destroy', 'RoleController@destroy')->name('roles.destroy');


    //Permissions
    Route::get('/permissions', 'PermissionController@index')->name('permissions.index');
    Route::get('/permissions/show/{id}', 'PermissionController@show')->name('permissions.show');
    Route::get('/permissions/{id}/edit', 'PermissionController@edit')->name('permissions.edit');
    Route::get('/permissions/create', 'PermissionController@create')->name('permissions.create');
    Route::put('/permissions/update/{product}', 'PermissionController@update')->name('permissions.update');
    Route::post('/permissions/store', 'PermissionController@store')->name('permissions.store');
    Route::delete('/permissions/{product}/destroy', 'PermissionController@destroy')->name('permissions.destroy');
});
