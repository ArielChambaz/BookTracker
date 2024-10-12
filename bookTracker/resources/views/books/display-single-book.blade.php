@extends('layouts.app')

@section('content')
<div class="container px-6 py-8 mx-auto" id="main-content">
    <!-- Improved Title Styling -->
    <h3 class="text-6xl font-bold text-gray-900 mb-6 text-center tracking-wide leading-tight">
        <span class="text-blue-700">Read</span> a Book :
    </h3>

    <div class="container mx-auto py-10">
        <div class="max-w-5xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="flex items-center justify-between px-8 py-6 bg-blue-800">
                <h1 class="text-4xl font-bold text-white">{{ $book->title }}</h1>
                <div class="flex rounded-lg bg-white hover:bg-black">
                    <a href="{{ route('dashboard.index')}}" class="text-black text-sm mt-1 ml-2 mr-2 mb-1 hover:text-white text-center font-bold">Back to dashboard</a>
                </div>
            </div>
            <div class="px-8 py-6">
                <p class="text-gray-600 text-lg">
                    <span class="font-semibold">Author:</span> {{ $book->author->first_name }} {{ $book->author->last_name }}
                </p>
                <p class="text-gray-600 text-lg mt-2">
                    <span class="font-semibold">Published Year:</span> {{ $book->published_year }}
                </p>
                <p class="text-gray-600 text-lg mt-2">
                    <span class="font-semibold">Category:</span> {{ $book->category->name }}
                </p>
                <div class="mt-8">
                    <h2 class="text-lg font-semibold text-gray-600">Content:</h2>
                    <p class="text-gray-600 mt-2 text-justify leading-relaxed">
                        {!! $book->body ?? 'No description available for this book.'!!}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
