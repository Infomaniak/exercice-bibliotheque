<?php

namespace App\Http\Controllers;

use App\Models\{Author, Book, Borrowing, User};

class DashboardController extends Controller
{

    public function __construct()
    {
        //$this->middleware(['islibrarian']);
    }

    public function index()
    {
        return view('dashboard.dashboard', [
            'users' => User::All(),
            'books' => Book::All(),
            'borrows' => Borrowing::All(),
            'authors' => Author::All(),
        ]);
    }
}
