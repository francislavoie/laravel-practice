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

    Route::get('/users/view/{user}', 'Admin\UserController@view');

    Route::get('/posts', 'PostController@index');
    Route::get('/posts/create', 'PostController@createView');
    Route::post('/posts/create', 'PostController@create');
    Route::get('/posts/view/{post}', 'PostController@view');
    Route::get('/posts/edit/{post}', 'PostController@editView');
    Route::post('/posts/edit/{post}', 'PostController@edit');
});

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    
    Route::get('/users', 'UserController@index');
    Route::get('/users/view/{user}', 'UserController@view');
    Route::get('/users/edit/{user}', 'UserController@editView');
    Route::post('/users/edit/{user}', 'UserController@edit');
    Route::get('/users/delete/{user}', 'UserController@delete');
});
