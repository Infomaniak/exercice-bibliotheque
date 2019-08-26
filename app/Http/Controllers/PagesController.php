<?php

namespace App\Http\Controllers;

use App\Book;

class PagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['home', 'search']);
    }

	
	public function mybooks ($page = 0) 
	{
		$books = Book::where('borrower', auth()->user()->name)->limit(8)->offset($page*8)->get();

		$previous = $page-1;
		$previous=$page>0?$page-1:$page;
		$next=count(Book::where('borrower', auth()->user()->name)->get())>($page+1)*8?$page+1:$page;

        return view('mybooks')->with([
            'books' => $books, 
            'page' => $page, 
            'previous' => $previous, 
            'next' => $next,
            'search' => ""
        ]);
	}
	
	public function mybookssearch ($search, $page = 0) 
	{
		$books = Book::where('borrower', auth()->user()->name)->where(function ($query) { $query->where('title', 'LIKE', '%'.request()->search.'%')->orWhere('author', 'LIKE', '%'.request()->search.'%');})->select('*')->limit(8)->offset($page*8)->get();
		$booknb = Book::where('borrower', auth()->user()->name)->where(function ($query) { $query->where('title', 'LIKE', '%'.request()->search.'%')->orWhere('author', 'LIKE', '%'.request()->search.'%');})->select('*')->count();

		$previous = $page-1;
		$previous=$page>0?($page-1):$page;
		$next=$booknb>($page+1)*8?$page+1:$page;

        return view('mybooks')->with([
        	'search' => request()->search,
            'books' => $books, 
            'page' => $page, 
            'previous' => $previous, 
            'next' => $next
        ]);
	}
	
	public function home ($page = 0) 
	{
		$books = Book::whereNull('borrower')->limit(8)->offset($page*8)->get();

		$previous = $page-1;
		$previous=$page>0?$page-1:$page;
		$next=count(Book::whereNull('borrower')->get())>($page+1)*8?$page+1:$page;

        return view('home')->with([
            'books' => $books, 
            'page' => $page, 
            'previous' => $previous, 
            'next' => $next,
            'search' => ""
        ]);
	}
	
	public function search ($search, $page = 0) 
	{
		$books = Book::whereNull('borrower')->where(function ($query) { $query->where('title', 'LIKE', '%'.request()->search.'%')->orWhere('author', 'LIKE', '%'.request()->search.'%');})->select('*')->limit(8)->offset($page*8)->get();
		$booknb = Book::whereNull('borrower')->where(function ($query) { $query->where('title', 'LIKE', '%'.request()->search.'%')->orWhere('author', 'LIKE', '%'.request()->search.'%');})->select('*')->count();

		$previous = $page-1;
		$previous=$page>0?($page-1):$page;
		$next=$booknb>($page+1)*8?$page+1:$page;

        return view('home')->with([
        	'search' => request()->search,
            'books' => $books, 
            'page' => $page, 
            'previous' => $previous, 
            'next' => $next
        ]);
	}
	
	public function Bhome ($page = 0) 
	{
		$books = Book::whereNotNull('borrower')->limit(8)->offset($page*8)->get();

		$previous = $page-1;
		$previous=$page>0?$page-1:$page;
		$next=count(Book::whereNotNull('borrower')->get())>($page+1)*8?$page+1:$page;

        return view('borrowed')->with([
            'books' => $books, 
            'page' => $page, 
            'previous' => $previous, 
            'next' => $next,
            'search' => ""
        ]);
	}
	
	public function Bsearch ($search, $page = 0) 
	{
		$books = Book::whereNotNull('borrower')->where(function ($query) { $query->where('title', 'LIKE', '%'.request()->search.'%')->orWhere('author', 'LIKE', '%'.request()->search.'%');})->select('*')->limit(8)->offset($page*8)->get();
		$booknb = Book::whereNotNull('borrower')->where(function ($query) { $query->where('title', 'LIKE', '%'.request()->search.'%')->orWhere('author', 'LIKE', '%'.request()->search.'%');})->select('*')->count();

		$previous = $page-1;
		$previous=$page>0?($page-1):$page;
		$next=$booknb>($page+1)*8?$page+1:$page;

        return view('borrowed')->with([
        	'search' => request()->search,
            'books' => $books, 
            'page' => $page, 
            'previous' => $previous, 
            'next' => $next
        ]);
	}
}
