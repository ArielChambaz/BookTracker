@extends('layouts.app')

@section('content')

<div class="container px-6 py-8 mx-auto" id="main-content">
    <h3 class="text-6xl font-bold text-gray-900 mb-6  mt-2 text-center">
        <span class="text-blue-700">Search</span> a Book 
    </h3>

<form action="{{ route('search') }}" method="GET" class="max-w-xl mx-auto mt-8 mb-2">
    <label for="default-search" class="mb-2 text-sm font-bold text-gray-900 sr-only">Search</label>
    <div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
        </div>
        <input type="search" name="query" id="default-search" class="block w-full p-4 ps-10 text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Search books or authors..." required />
        <button type="submit" class="text-black absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold rounded-lg text-sm px-4 py-2">Search</button>
    </div>
</form>

@if($books->isEmpty() && $authors->isEmpty())
    <p class="mt-4 text-gray-600">No results found.</p>
@else
    @if(!$books->isEmpty())
        <h4 class="text-2xl font-medium text-gray-700 mt-4">Books</h4>
        <div class="mt-4">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Author</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Published Year</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Genre</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($books as $book)
                        <tr>
                            <td class="px-6 py-4 text-sm whitespace-nowrap"><a href="{{ route('books.show', $book->id) }}" class="hover:underline">{{ $book->title }}</a></td>
                            <td class="px-6 py-4 text-sm whitespace-nowrap">{{ $book->author->first_name }} {{ $book->author->last_name }}</td>
                            <td class="px-6 py-4 text-sm whitespace-nowrap">{{ $book->published_year }}</td>
                            <td class="px-6 py-4 text-sm whitespace-nowrap">{{ $book->category->name  }}</td>
                            <td class="px-6 py-4 text-sm whitespace-nowrap">
                                <a href="{{ route('books.edit', $book->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</a>
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
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Author</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Books</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($authors as $author)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $author->first_name }} {{ $author->last_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <ul class="list-disc list-inside">
                                    @if($author->books->isEmpty())
                                        <p>No book linked to this author</p>
                                    @else
                                        @foreach($author->books as $book)
                                            <p>{{ $book->title }}</p>
                                        @endforeach
                                    @endif
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endif

</div>

@endsection