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

Route::get('/itemslist', 'PostController@listItem');
Route::get('/postitems', function(){
  return view('postitems');
});

Route::post('/createitem', 'PostController@CreateItem');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/image', 'ImageController@ImageList');
Route::get('/imageK', 'ImageController@ImageListKeyaki');
Route::get('/imageH', 'ImageController@ImageListHinata');

Route::post('/date', 'ImageController@date');
Route::post('/dateh', 'ImageController@dateh');
Route::post('/datek', 'ImageController@datek');

Route::match(['get', 'post'],'/serach', 'ImageController@serach');
Route::match(['get', 'post'],'/serach2', 'ImageController@serach2');


Route::post('/getImage', 'ImageController@getImage');

Route::get('/rakutensarch', function () {
    return view('rakutensarch');
});

Route::post('/getRakuten', 'RakutenController@getRakuten');
