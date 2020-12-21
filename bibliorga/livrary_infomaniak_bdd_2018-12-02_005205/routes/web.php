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


Route::resource('book', 'BookController');
Route::resource('category', 'CategoryController');
Route::resource('user', 'UserController');
Route::resource('author', 'AuthorController');
Route::resource('borrowing', 'BorrowingController');
Route::resource('opinion', 'OpinionController');
Route::resource('favorite', 'FavoriteController');
Route::resource('love', 'LoveController');
