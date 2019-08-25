<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(auth()->user()->librarian, 403);
        return view('book.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book = new Book();

        $book->title = request('title');
        $book->author = request('author');
        $book->synopsis = request('synopsis');

        $this->validate($request, [
          'picture'  => 'required|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        $image = $request->file('picture');

        if (Book::all()->count()>0){
            $new_id = Book::latest('id')->first()->id+1;
        }
        else
        {
            $new_id = 1;
        }

        $new_name =  $new_id . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('img'), $new_name);

        $book->picture = "../img/".$new_name;

        $book->save();


        return redirect('/books/'.$new_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $previous = Book::where('id', '<', $book->id)->max('id');

        if (empty($previous)){
            $previous = $book->id;
        }

        $next = Book::where('id', '>', $book->id)->min('id');


        if (empty($next)){
            $next = $book->id;
        }

        return view('book.display')->with([
            'book' => $book, 
            'previous' => $previous, 
            'next' => $next
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        abort_unless(auth()->user()->librarian, 403);
        return view('book.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $book = Book::find($book->id);

        $book->title = request('title');
        $book->author = request('author');
        $book->synopsis = request('synopsis');

        if (!empty(request('picture'))){
            $this->validate($request, [
              'picture'  => 'required|image|mimes:jpg,jpeg,png,gif|max:2048'
            ]);

            $image = $request->file('picture');

            $new_name =  $book->id . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('img'), $new_name);

            $book->picture = "../img/".$new_name;
        }

        $book->save();


        return redirect('/books/'.$book->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function toggle(Book $book)
    {

        $book = Book::find($book->id);

        if ($book->borrower === NULL){
            $book->borrower = auth()->user()->name;
        }
        else{
            $book->borrower = NULL;
        }

        $book->save();


        return redirect('/books/'.$book->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book = Book::find($book->id);

        $book->delete();

        return redirect('/');
    }

    public function previous(Book $book)
    {

        return view('book', compact('book'));
    }
}
