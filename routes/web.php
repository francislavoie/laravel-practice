<?php

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

Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
});

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    
    Route::get('/users', 'UserController@index');
    Route::get('/users/create', 'UserController@createView');
    Route::post('/users/create', 'UserController@create');
    Route::get('/users/view/{user}', 'UserController@view');
    Route::get('/users/edit/{user}', 'UserController@editView');
    Route::post('/users/edit/{user}', 'UserController@edit');
    Route::get('/users/delete/{user}', 'UserController@delete');
});
