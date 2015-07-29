<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return Redirect::to('books');
});

Route::resource('user', 'UserController');
Route::resource('book', 'BookController');
Route::resource('userbook', 'UserBookController');
Route::resource('books', 'BooksIdController');

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::get('auth/soc', 'Auth\AuthController@redirectToFacebook');
Route::get('auth/soc/callback', 'Auth\AuthController@handleFacebookCallback');

