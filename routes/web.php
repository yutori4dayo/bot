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
    return view('auth.login');
});


Route::get('/post', function () {
    return view('post');
});
Route::get('/edit', 'PostController@edit');

Route::post('/getPost', 'PostController@getPost');
Route::get('/list', 'PostController@postList');
Route::post('/delete', 'PostController@delete');
Route::post('/editPost', 'PostController@editPost');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');