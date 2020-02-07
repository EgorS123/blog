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

Route::get('/post/create', 'PostController@showCreate')->name('create.post');
Route::post('/post/create', 'PostController@create');


Route::get('/post/edit/{id}', 'PostController@showEdit')->name('edit.post');
Route::post('post/edit/{id}', 'PostController@edit');


Route::post('comment/create', 'CommentController@create')->name('create.comment');


Route::get('/post/{id}', 'PublicPostController@showPost')->name('post');


Route::get('/user/settings', 'SettingsUserController@showSettings')->name('settings');
Route::post('/user/settings', 'SettingsUserController@settings');


Route::get('/user/{id}', 'ProfileController@index')->name('profile');