<?php
// app/Http/Controllers/AuthorController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Book;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AuthorController extends Controller
{
    public function create()
    {
        $authorsCount = Author::count();
        $booksCount = Book::count();
        $authors = Author::all();
        return view('authors.add-authors', compact('authorsCount', 'booksCount', 'authors'));
    }

    public function edit(Author $author)
    {
        $authorsCount = Author::count();
        $booksCount = Book::count();
        $authors = Author::all();
        return view('authors.edit', compact('author', 'authorsCount', 'booksCount', 'authors'));
    }

    public function update(Request $request, Author $author)
    {
        try { 
            $validatedData = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:authors,email,' . $author->id,
                'birth_year' => 'required|integer',
                'description' => 'nullable|string',
            ]);

            $author->update($validatedData);

            return redirect()->route('dashboard.index')->with('success', 'Author updated successfully.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            Log::error('Error updating author: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while updating the author.');
        }
    }

    public function destroy(Author $author)
    {
        try {
            $author->delete();
            return redirect()->route('dashboard.index')->with('success', 'Author deleted successfully.');
        } catch (Exception $e) {
            Log::error('Error deleting author: ' . $e->getMessage());
            return redirect()->route('dashboard.index')->with('error', 'An error occurred while deleting the author.');
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'birth_year' => 'required|integer',
                'email' => 'required|email|unique:authors,email',
                'description' => 'nullable|string',
            ]);

            // Création d'un nouvel auteur
            Author::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'birth_year' => $request->birth_year,
                'email' => $request->email,
                'description' => $request->description,
            ]);

            // Redirection après la création
            return redirect()->route('authors.create')->with('success', 'Author added successfully.');
        } catch (ValidationException $e) {
            // Redirection en cas d'échec de validation
            return redirect()->route('authors.create')->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            // Log de l'erreur
            Log::error($e);
            // Redirection en cas d'échec
            return redirect()->route('authors.create')->with('error', 'Failed to add author. Please try again.');
        }
    }
}