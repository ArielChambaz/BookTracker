<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Book;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Rechercher des livres
        $books = Book::where('title', 'LIKE', "%{$query}%")
                     ->orWhereHas('author', function($queryBuilder) use ($query) {
                         $queryBuilder->where('first_name', 'LIKE', "%{$query}%")
                                      ->orWhere('last_name', 'LIKE', "%{$query}%");
                     })
                     ->get();

        // Rechercher des auteurs
        $authors = Author::where('first_name', 'LIKE', "%{$query}%")
                         ->orWhere('last_name', 'LIKE', "%{$query}%")
                         ->with('books')
                         ->get();

        return view('search.results', compact('books', 'authors', 'query'));
    }
}
