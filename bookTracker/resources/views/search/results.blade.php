@extends('layouts.app')

@section('content')

<div class="container px-6 py-8 mx-auto">
    <h3 class="text-3xl font-medium text-gray-700">Search for a book or an author</h3>

    <form action="{{ route('search') }}" method="GET" class="max-w-md mx-auto mt-8">
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="search" name="query" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search books or authors..." required />
            <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
        </div>
    </form>

    @if($books->isEmpty() && $authors->isEmpty())
        <p class="mt-4 text-gray-600">No results found.</p>
    @else
        @if(!$books->isEmpty())
            <h4 class="text-2xl font-medium text-gray-700 mt-6">Books</h4>
            <div class="mt-4">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Published Year</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Genre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($books as $book)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $book->title }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $book->author->first_name }} {{ $book->author->last_name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $book->published_year }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $book->genre }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('books.edit', $book->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        @if(!$authors->isEmpty())
            <h4 class="text-2xl font-medium text-gray-700 mt-6">Authors</h4>
            <div class="mt-4">
                @foreach($authors as $author)
                    <div class="mb-6">
                        <h5 class="text-xl font-medium text-gray-700">{{ $author->first_name }} {{ $author->last_name }}</h5>
                        <p class="text-gray-600">Books:</p>
                        <ul class="list-disc list-inside">
                            @foreach($author->books as $book)
                                <li>{{ $book->title }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        @endif
    @endif

</div>

@endsection