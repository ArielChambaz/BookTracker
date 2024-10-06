<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Book;

class DashboardController extends Controller
{
    public function index()
    {
        $authorsCount = Author::count();
        $booksCount = Book::count();
        return view('welcome', compact('authorsCount', 'booksCount'));
    }
}