@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container px-6 py-8 mx-auto" id="main-content">
    <h3 class="text-6xl font-bold text-gray-900 mb-4 text-center">
        Welcome to <span class="text-blue-700">Booktracker</span> ! 
    </h3>
    <h4 class="text-xl font-medium text-gray-900 mb-6 ">
        Take a look at our collection of freely available books.
    </h4>
        @if(session('success'))
        <div role="alert" id="success-alert" class="mt-3 relative flex flex-col w-full p-3 text-sm text-white bg-green-600 rounded-md opacity-0 transition-opacity duration-500 ease-in-out">
            <p class="flex text-base">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5 mr-2 mt-0.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"></path>
                </svg>
                Success
            </p>
            <p class="ml-4 p-3">
                {{ session('success') }}
            </p>
            <button class="flex items-center justify-center transition-all w-8 h-8 rounded-md text-white hover:bg-white/10 active:bg-white/10 absolute top-1.5 right-1.5" type="button" onclick="this.parentElement.remove();">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const alert = document.getElementById('success-alert');
                setTimeout(() => {
                    alert.classList.remove('opacity-0');
                    alert.classList.add('opacity-100');
                }, 200); // Delay to ensure the transition is visible
    
                setTimeout(() => {
                    alert.classList.remove('opacity-100');
                    alert.classList.add('opacity-0');
                    setTimeout(() => {
                        alert.remove();
                    }, 500); // Wait for the transition to complete before removing the element
                }, 5200); // 5 seconds after the alert appears
            });
        </script>
    @endif
    
        @if(session('error'))
            <div role="alert" id="error-alert" class="mt-3 relative flex flex-col w-full p-3 text-sm text-white bg-red-600 rounded-md opacity-0 transition-opacity duration-500 ease-in-out">
                <p class="flex text-base">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5 mr-2 mt-0.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"></path>
                    </svg>
                    Error
                </p>
                <p class="ml-4 p-3">
                    {{ session('error') }}
                </p>
                <button class="flex items-center justify-center transition-all w-8 h-8 rounded-md text-white hover:bg-white/10 active:bg-white/10 absolute top-1.5 right-1.5" type="button" onclick="this.parentElement.remove();">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
    
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const alert = document.getElementById('error-alert');
                    setTimeout(() => {
                        alert.classList.remove('opacity-0');
                        alert.classList.add('opacity-100');
                    }, 200); // Delay to ensure the transition is visible
    
                    setTimeout(() => {
                        alert.classList.remove('opacity-100');
                        alert.classList.add('opacity-0');
                        setTimeout(() => {
                            alert.remove();
                        }, 500); // Wait for the transition to complete before removing the element
                    }, 5200); // 5 seconds after the alert appears
                });
            </script>
        @endif

        <div class="mt-4">
            <div class="flex flex-wrap -mx-6">
                <div class="w-full px-6 sm:w-1/2 xl:w-1/3">
                    <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                        <div class="p-3 bg-indigo-600 bg-opacity-75 rounded-full">
                            <svg class="w-8 h-8 text-white" viewBox="0 0 28 30" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M18.2 9.08889C18.2 11.5373 16.3196 13.5222 14 13.5222C11.6804 13.5222 9.79999 11.5373 9.79999 9.08889C9.79999 6.64043 11.6804 4.65556 14 4.65556C16.3196 4.65556 18.2 6.64043 18.2 9.08889Z"
                                    fill="currentColor"></path>
                                <path
                                    d="M25.2 12.0444C25.2 13.6768 23.9464 15 22.4 15C20.8536 15 19.6 13.6768 19.6 12.0444C19.6 10.4121 20.8536 9.08889 22.4 9.08889C23.9464 9.08889 25.2 10.4121 25.2 12.0444Z"
                                    fill="currentColor"></path>
                                <path
                                    d="M19.6 22.3889C19.6 19.1243 17.0927 16.4778 14 16.4778C10.9072 16.4778 8.39999 19.1243 8.39999 22.3889V26.8222H19.6V22.3889Z"
                                    fill="currentColor"></path>
                                <path
                                    d="M8.39999 12.0444C8.39999 13.6768 7.14639 15 5.59999 15C4.05359 15 2.79999 13.6768 2.79999 12.0444C2.79999 10.4121 4.05359 9.08889 5.59999 9.08889C7.14639 9.08889 8.39999 10.4121 8.39999 12.0444Z"
                                    fill="currentColor"></path>
                                <path
                                    d="M22.4 26.8222V22.3889C22.4 20.8312 22.0195 19.3671 21.351 18.0949C21.6863 18.0039 22.0378 17.9556 22.4 17.9556C24.7197 17.9556 26.6 19.9404 26.6 22.3889V26.8222H22.4Z"
                                    fill="currentColor"></path>
                                <path
                                    d="M6.64896 18.0949C5.98058 19.3671 5.59999 20.8312 5.59999 22.3889V26.8222H1.39999V22.3889C1.39999 19.9404 3.2804 17.9556 5.59999 17.9556C5.96219 17.9556 6.31367 18.0039 6.64896 18.0949Z"
                                    fill="currentColor"></path>
                            </svg>
                        </div>

                        <div class="mx-5">
                            <h4 class="text-2xl font-semibold text-gray-700">{{ number_format($authorsCount) }}</h4>
                            <div class="text-gray-500">Total Authors</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="mt-8">

        </div>

        <div class="flex flex-col mt-8">
            <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-sm font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    Name
                                </th>
                                <th class="px-6 py-3 text-sm font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    Date of Birth
                                </th>
                                <th class="px-6 py-3 text-sm font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    Email
                                </th>
                                <th class="px-6 py-3 text-sm font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    Description
                                </th>
                                <th class="px-6 py-3 text-sm font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    Actions
                                </th>
                            </tr>
                        </thead>
        
                        <tbody class="bg-white">
                            @foreach($authors as $author)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-900">{{ $author->first_name }} {{ $author->last_name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-900">{{ $author->birth_year }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-900">{{ $author->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-900">{{ $author->description }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium leading-5 text-left whitespace-no-wrap border-b border-gray-200">
                                        <a href="{{ route('authors.edit', $author->id) }}" class="text-indigo-600 hover:text-indigo-900 inline-block mr-4">Edit</a>
                                        <form action="{{ route('authors.destroy', $author->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 inline-block">Delete</button>
                                        </form>
                                    </td>                                    
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-4">
    <div class="flex flex-wrap -mx-6">
        <div class="w-full px-6 mt-6 sm:w-1/2 xl:w-1/3 sm:mt-0">
            <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                <div class="p-3 bg-orange-600 bg-opacity-75 rounded-full">
                    <!-- Correct Book Icon -->
                    <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l-7-2V5a1 1 0 011-1h10a1 1 0 011 1v12l-7 2zm0 0v-8m0 8l7-2V5a1 1 0 00-1-1h-6"/>
                    </svg>
                </div>

                <div class="mx-5">
                    <h4 class="text-2xl font-semibold text-gray-700">{{ number_format($booksCount) }}</h4>
                    <div class="text-gray-500">Total Books</div>
                </div>
            </div>
        </div>
    </div>
</div>



        <div class="flex flex-col mt-8">
            <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-sm font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    Title
                                </th>
                                <th class="px-6 py-3 text-sm font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    Author
                                </th>
                                <th class="px-6 py-3 text-sm font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    Published Year
                                </th>
                                <th class="px-6 py-3 text-sm font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    Category
                                </th>
                                <th class="px-6 py-3 text-sm font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    Actions
                                </th>
                            </tr>
                        </thead>
        
                        <tbody class="bg-white">
                        @foreach($books as $book)
    <tr>
        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
            <div class="text-sm leading-5 text-gray-900">
                <a href="{{ route('books.show', $book->id) }}" class="hover:underline hover:font-bold">{{ $book->title }}</a>
            </div>
        </td>
        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
            <div class="text-sm leading-5 text-gray-900">{{ $book->author->first_name }} {{ $book->author->last_name }}</div>
        </td>
        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
            <div class="text-sm leading-5 text-gray-900">{{ $book->published_year }}</div>
        </td>
        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
            <div class="text-sm leading-5 text-gray-900">{{ $book->category->name }}</div>
        </td>
        <td class="px-6 py-4 text-sm font-medium leading-5 text-left whitespace-no-wrap border-b border-gray-200">
            <a href="{{ route('books.edit', $book->id) }}" class="text-indigo-600 hover:text-indigo-900 inline-block mr-4">Edit</a>
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
            </div>
        </div>

    </div>



@endsection

