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
    return view('welcome', [
        'new_books' => \App\Models\Book::orderby('publication', 'desc')->take(4)->get(),
        'most_viewed' => \App\Models\Borrowing::mostViewed()->take(4)
    ]);
});

//Auth::routes();
Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['middleware' => ['islibrarian']], function () {
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
        Route::resource('book', 'BookController');
        Route::resource('category', 'CategoryController');
    });

    Route::group(['middleware' => ['isadmin']], function () {
        Route::get('/users', 'UserController@index')->name('user.index');
    });

    Route::resource('opinion', 'OpinionController');
    Route::resource('borrowing', 'BorrowingController');

    Route::put('/users/{id}', 'UserController@update')->name('user.update');
    Route::get('books/activity', 'BookController@showMyBooks')->name('mybooks');
});

Route::resource('author', 'AuthorController');
Route::resource('book', 'BookController');

Route::get('books/all', 'BookController@showAllBooks')->name('books.all');
Route::get('books/new', 'BookController@showAllNewBooks')->name('books.new');
Route::get('books/mostviewed', 'BookController@showMostViewedBooks')->name('books.viewed');

Route::get('static/livre', 'BookController@staticShow');
Route::get('static/author', 'AuthorController@staticShow');
