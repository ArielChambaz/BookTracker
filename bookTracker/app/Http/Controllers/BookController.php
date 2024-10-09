<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class BookController extends Controller
{
    public function create()
    {
        $authors = Author::all();
        $categories = Category::all();
        $booksCount = Book::count();
        $authorsCount = Author::count();
        return view('books.add-books', compact('authorsCount', 'booksCount', 'authors','categories'));
    }

    public function edit(Book $book)
    {
        $authorsCount = Author::count();
        $booksCount = Book::count();
        $authors = Author::all();
        $categories = Category::all();
        return view('books.edit', compact('book', 'authorsCount', 'booksCount', 'authors', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'author_id' => 'required|exists:authors,id',
                'published_year' => 'required|integer',
                'category_id' => 'required|exists:categories,id',
                'body' => 'required|string',
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
        //dd($request->all()); //see what data is actually being passed from the form
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:author,id',
            'published_year' => 'required|integer',
            'category_id' => 'required|exists:category,id',
            //'body' => 'required|string',  // Ensure body is included
        ]);

        // Create the book using validated data
        Book::create($validatedData);

        return redirect()->route('books.create')->with('success', 'Book created successfully.');
    }
}
