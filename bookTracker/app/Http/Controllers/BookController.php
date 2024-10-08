<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Book;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class BookController extends Controller
{
    public function create()
    {
        $authorsCount = Author::count();
        $booksCount = Book::count();
        $authors = Author::all();
        return view('books.add-books', compact('authorsCount', 'booksCount', 'authors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'published_year' => 'required|integer',
            'genre' => 'required|string|max:255',
        ]);

        Book::create($request->all());

        return redirect()->route('books.create')->with('success', 'Book created successfully.');
    }
}
