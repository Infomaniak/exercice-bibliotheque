<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBorrowingRequest;
use App\Models\Book;
use App\Models\Borrowing;
use App\Notifications\BorrowNotification;
use App\Repositories\BookRepository;
use App\Repositories\BorrowingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BorrowingController extends Controller
{
    public function __construct()
    {
        $this->middleware('islibrarian')->except([
            'create', 'store', 'update'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $borrow_delivred = Borrowing::where('isBorrow', 1)->orderby('id', 'desc')->get();
        $borrow_not_delivred = Borrowing::where('isBorrow', 0)->orderby('id', 'desc')->get();
        return view('dashboard.borrowings', [
            'borrow_delivred' => $borrow_delivred,
            'borrow_not_delivred' => $borrow_not_delivred,
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
    public function store(CreateBorrowingRequest $request, BorrowingRepository $repository)
    {

        if (!Auth::user()->hasVerifiedEmail())
            return redirect(url()->previous())->withErrors('Désolé vous devez d\'abord confirmer votre compte.');

        $repository->store([
            'during' => $request->input('during'),
            'quantity' => 1,
            'user_id' => auth()->user()->id,
            'book_id' => $request->input('book_id'),
        ]);
        $book = Book::find($request->input('book_id'));
        /*$book->update([
            'quantity' => $book->quantity - 1
        ]);*/
        $book->quantity--;
        $book->save();
        auth()->user()->notify(new BorrowNotification());
        session()->flash('success', 'Votre emprunt a bien été prise en compte, merci de respecter la date limite');
        return redirect(url()->previous());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BorrowingRepository $repository, $id)
    {
        Validator::make($request->all(), [
            'isBorrow' => 'required|integer|min:0|max:1'
        ])->validate();

        $repository->update($id, $request->all());

        $book = Borrowing::find($id)->book;
        $book->quantity++;    $book->save();
        session()->flash('success', 'Votre emprunt a bien été mise à jour');
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
        //
    }
}
