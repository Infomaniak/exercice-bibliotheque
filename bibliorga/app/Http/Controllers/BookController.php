<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Category;
use App\Repositories\BookRepository;
use App\Repositories\BorrowingRepository;

class BookController extends Controller
{
    protected $_paginate = 10;

    public function __construct(BookRepository $repository)
    {
        $this->middleware('islibrarian')->except([
            'show', 'showAllBooks', 'showAllNewBooks', 'showMyBooks', 'showMostViewedBooks'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BookRepository $repository)
    {
        $books = $repository->getPaginate($this->_paginate);
        $categories = Category::all();
        $authors = Author::orderby('firstname', 'asc')->orderby('lastname', 'asc')->get();
        return view('dashboard.books', [
            'books' => $books,
            'categories' => $categories,
            'authors' => $authors
        ]);
    }

    public function showAllBooks(BookRepository $repository)
    {
        $books = $repository->getPaginate($this->_paginate);
        $links = $books->links();
        $books = $books->sortByDesc('id');
        return view('pages.books', [
            'books' => $books,
            'links' => $links,
        ]);
    }

    public function showMyBooks(BookRepository $repository)
    {
        $borrow_delivred = Borrowing::where('user_id', auth()->user()->id)->where('isBorrow', 1)->orderby('id', 'desc')->get();
        $borrow_not_delivred = Borrowing::where('user_id', auth()->user()->id)->where('isBorrow', 0)->orderby('id', 'desc')->get();
        //$links = $books->links();
        //$books = $books->sortByDesc('id');
        return view('pages.my_books', [
                'borrow_delivred' => $borrow_delivred,
                'borrow_not_delivred' => $borrow_not_delivred,
        ]);
    }

    public function showAllNewBooks(BookRepository $repository)
    {
        $books = $repository->getPaginate($this->_paginate);
        $links = $books->links();
        $books = $books->sortByDesc('publication');
        return view('pages.new_books', [
            'books' => $books,
            'links' => $links,
        ]);
    }

    public function showMostViewedBooks(BorrowingRepository $repository)
    {
        return view('pages.most_viewed_books', [
            'most_viewed' => Borrowing::mostViewed()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->home();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBookRequest $request, BookRepository $repository)
    {
        $book_image_name = null;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            //dd($file);
            $book_image_name = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move(public_path(config('image.path_book_image')), $book_image_name);
        }

        $repository->store([
            'image' => $book_image_name,
            'title' => $request->input('title'),
            'publication' => $request->input('publication'),
            'ref' => $request->input('ref'),
            'description' => $request->input('description'),
            'quantity' => $request->input('quantity'),
            'category_id' => $request->input('category_id'),
            'author_id' => $request->input('author_id'),
        ]);
        session()->flash('success', 'Livre ajouté avec succès.');
        return redirect(url()->previous());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(BookRepository $repository, $id)
    {
        if (($book = $repository->getById($id)) == null)
            return redirect(url()->previous())->withErrors('Cet livre n\'existe pas');
        return view('profiles.book', compact('book'));
    }

    public function staticShow()
    {
        return view('author');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return redirect()->home();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateBookRequest $request, BookRepository $repository, $id)
    {
        $book_image_name = null;
        $book = Book::find($id);
        if ($request->hasFile('photo')) {
            //upload
            $file = $request->file('photo'); // get the image data
            $book_image_name = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension(); // Create an unique name
            $file->move(public_path(config('image.path_book_image')), $book_image_name); // upload the image
            //Delete late image
            if ($book->image){
                unlink(public_path($book->cover_url));
            }
        }

        $book->update([
            'image' => $book_image_name ?? $book->image,
            'title' => $request->input('title'),
            'publication' => $request->input('publication'),
            'ref' => $request->input('ref'),
            'description' => $request->input('description'),
            'quantity' => $request->input('quantity'),
            'category_id' => $request->input('category_id'),
            'author_id' => $request->input('author_id'),
        ]);
        session()->flash('success', 'Le livre a bien été mise à jour.');
        return redirect(url()->previous());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        //Delete image
        if ($book->image){
            unlink(public_path($book->cover_url));
        }
        $book->delete();
        session()->flash('success', 'Le livre a bien été mise à jour.');
        return redirect(url()->previous());
    }
}
