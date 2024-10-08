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

    public function edit(Book $book)
    {
        $authorsCount = Author::count();
        $booksCount = Book::count();
        $authors = Author::all();
        return view('books.edit', compact('book', 'authorsCount', 'booksCount', 'authors'));
    }

    public function update(Request $request, Book $book)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'author_id' => 'required|exists:authors,id',
                'published_year' => 'required|integer',
                'genre' => 'required|string|max:255',
            ]);

            $book->update($validatedData);

            return redirect()->route('dashboard.index')->with('success', 'Book updated successfully.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            Log::error('Error updating book: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while updating the book.');
        }
    }


    public function destroy(Book $book)
    {
        try {
            $book->delete();
            return redirect()->route('dashboard.index')->with('success', 'Book deleted successfully.');
        } catch (Exception $e) {
            Log::error('Error deleting book: ' . $e->getMessage());
            return redirect()->route('dashboard.index')->with('error', 'An error occurred while deleting the book.');
        }
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
