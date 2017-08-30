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
    return view('home');
});

Route::get('/list', 'UrlController@urlList');

Route::get('/signup', function () {
    return view('register');
});

Route::get('/shorten', 'UrlController@urlToShortCode');
Route::get('/url/{short_code}', 'UrlController@getFullUrl');
Route::get('/register', 'UserController@register');
Route::get('/login', 'UserController@login');
Route::get('/logout', 'UserController@logout');
