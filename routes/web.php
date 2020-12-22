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



Route::get('register', function () {
  return view('register');
});

//mail
Auth::routes(['verify' => true]);

Route::get('/', 'PostController@index')->name('posts.index')->middleware('verified');

Route::resource('/posts','PostController',['except' => ['index']]);

Route::resource('/comments','CommentController')->middleware('auth');

Route::post('delete/{id}', 'PostController@delete')->name('posts.delete');