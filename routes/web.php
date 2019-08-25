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

Route::get('/borrowed/search/{search}/{page}', 'PagesController@Bsearch');
Route::post('/borrowed/search', 'PagesController@Bsearch');
Route::get('/borrowed/{page}', 'PagesController@Bhome');
Route::get('/borrowed', 'PagesController@Bhome');


Route::get('/my-books/search/{search}/{page}', 'PagesController@mybookssearch');
Route::post('/my-books/search', 'PagesController@mybookssearch');
Route::get('/my-books/{page}', 'PagesController@mybooks');
Route::get('/my-books', 'PagesController@mybooks');


Route::resource('books', 'BooksController');
Route::post('/books/{book}', 'BooksController@toggle');

Auth::routes();

Route::get('/search/{search}/{page}', 'PagesController@search');
Route::post('/search', 'PagesController@search');
Route::get('/{page}', 'PagesController@home');
Route::get('/', 'PagesController@home');


// Route::get('/home', 'HomeController@index')->name('home');
