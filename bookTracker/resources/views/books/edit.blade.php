<!-- resources/views/books/edit.blade.php -->
@extends('layouts.app')

@section('content')

<div class="container px-6 py-8 mx-auto">
    <h3 class="text-6xl font-bold text-gray-900 mb-4 text-center">
        Edit a book  
    </h3>

    <div class="px-5 py-6 bg-white rounded-md shadow-sm mt-8">
        <form class="ml-8 mr-8 mx-auto mt-2" method="POST" action="{{ route('books.update', ['book' => $book->id]) }}">
            @csrf
            @method('PUT')
            <div class="relative z-0 w-full mb-5 mt-8 group">
                <input type="text" name="title" id="title" class="block py-2.5 px-0 w-full text-lg text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-black-500 focus:outline-none focus:ring-0 focus:border-black-600 peer" placeholder=" " required value="{{ old('title', $book->title) }}" />
                <label for="title" class="peer-focus:font-medium absolute text-lg text-gray-900 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Title</label>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <select name="author_id" id="author_id" class="block py-2.5 px-0 w-full text-lg text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-black-500 focus:outline-none focus:ring-0 focus:border-black-600 peer" required>
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}" {{ $book->author_id == $author->id ? 'selected' : '' }}>{{ $author->first_name }} {{ $author->last_name }}</option>
                    @endforeach
                </select>
                <label for="author_id" class="peer-focus:font-medium absolute text-lg text-gray-900 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Author</label>
            </div>
            <div class="relative z-0 w-full mb-5 group">
            <select name="published_year" id="published_year" class="block py-2.5 px-0 w-full text-lg text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-black-500 focus:outline-none focus:ring-0 focus:border-black-600 peer" required>
                @for ($year = date('Y'); $year >= 1700; $year--)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endfor
            </select>                
            <label for="published_year" class="peer-focus:font-medium absolute text-sm text-gray-900 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Published Year</label>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <select name="category_id" id="category_id" class="block py-2.5 px-0 w-full text-lg text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-black-500 focus:outline-none focus:ring-0 focus:border-black-600 peer" required>
                    <option value="" disabled selected>Select category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <label for="category_id" class="peer-focus:font-medium absolute text-lg text-gray-900 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Category</label>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <textarea name="body" id="body" rows="4" class="block py-2.5 px-0 w-full text-lg text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-black-500 focus:outline-none focus:ring-0 focus:border-black-600 peer" placeholder=" ">{{ old('description', $author->description) }}</textarea>
                <label for="body" class="peer-focus:font-medium absolute text-lg text-gray-900 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Description</label>
            </div>
            <button type="submit" class="text-white bg-black hover:bg-gray-800 focus:ring-4 mb-6 mt-6 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-lg w-full px-5 py-2.5 text-center dark:bg-black dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                Save changes
            </button>
        </form>
    </div>
</div>
@endsection 