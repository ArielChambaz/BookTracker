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
    public function index()
    {
        $authorsCount = Author::count();
        $booksCount = Book::count();
        $authors = Author::all();
        return view('add-authors', compact('authorsCount', 'booksCount', 'authors'));
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
            return redirect()->route('authors.index')->with('success', 'Author added successfully.');
        } catch (ValidationException $e) {
            // Redirection en cas d'échec de validation
            return redirect()->route('authors.index')->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            // Log de l'erreur
            Log::error($e);
            // Redirection en cas d'échec
            return redirect()->route('authors.index')->with('error', 'Failed to add author. Please try again.');
        }
    }
}