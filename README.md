
# Laravel CRUD Project - BookTracker

<p align="center">
    <img src="bookTracker/public/img/capture_logo.jpg" alt="capture_logo">
</p>

Welcome to the GitHub repository of the final project of Ariel CHAMBAZ and Victor LEQUEUX AUDRAN made for the Framework based programming course 2024 at ITS ! This project was created to manage Books, Authors, and Categories. It features functionality to create, edit, delete, and view authors and books, with category management, and exception handling.

Link to the video presentation:
https://www.youtube.com/watch?v=J5luD0f5RhY

## Requirements

- PHP ^8.2
- Composer
- Node.js and npm

## Installation

1. Clone the repository:
    ```sh
    git git@github.com:ArielChambaz/BookTracker.git
    cd cd BookTracker/bookTracker/
    ```

2. Install PHP dependencies:
    ```sh
    composer install
    ```

3. Install JavaScript dependencies:
    ```sh
    npm install
    ```

4. Copy the [`.env.example`](.env.example) file to a new `.env` file and configure your environment variables:
    ```sh
    cp .env.example .env
    ```

5. Generate the application key:
    ```sh
    php artisan key:generate
    ```

## Development Scripts

- To start the development server:
    ```sh
    php artisan serve
    ```

- To compile assets:
    ```sh
    npm run dev
    ```


## Project Features

- **CRUD Operations** for Books and Authors
- **Category Management** for Books
- **View content** of a single book
- **Exception Handling** for example when trying to delete an author linked to books it notify the user that it's not possible  
- **Basic Blade Layout** with TailwindCSS for a responsive design

## Database Structure

The project uses three tables:

- **Authors**: Stores author details. We wanted to personalize the names so that they sounded french. The PHP library `Fake` allows us to do that by modifying the value of the `APP_FAKER_LOCALE`variable to `fr_FR` in the `.env` file.
- **Books**: Stores book details including title, author, category, and description.
- **Categories**: Categorizes books with predefined categories.

Here is a sample of the code written in `2024_10_06_043145_create_books_table.php` (the migration file of our `Books table`) : 
```php
public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('author_id')->constrained('authors');
            $table->integer('published_year');
            $table->foreignId('category_id')->constrained('categories');
            $table->text('body')->nullable();
            $table->timestamps();
        });
    }
```

## Models and Relationships

- **Book** belongs to an **Author** and a **Category**.
- **Author** can have many **Books**.
- **Category** can be assigned to many **Books**.

Here is the structure of the `Books table`, we can see that there are 2 foreign key, one to fetch the author from the `Authors table` and one to fetch the category from the `Categories table`  : 

<p align="center">
    <img src="bookTracker/public/img/capture_book_table_structure.jpg" alt="capture_book_table_structure">
</p>

Here are the relationships defined in the models `Book.php`, `Author.php`, and `Category.php`:

```php
// In Book.php
public function author(): BelongsTo {
    return $this->belongsTo(Author::class);
}
public function category(): BelongsTo {
    return $this->belongsTo(Category::class);
}

// In Author.php
public function books(): HasMany {
    return $this->hasMany(Book::class);
}

// In Category.php
public function books(): HasMany {
    return $this->hasMany(Book::class);
}
```

## Book, Category and Authors factories and seeders

To automatically fill the tables in our database, we created new factories `BookFactory.php`, `AuthorFactory.php` and `CategoryFactory.php`. Here is a screenshot of the dummy data in the `Books table` in TablePlus:

<p align="center">
    <img src="bookTracker/public/img/capture_book_table_data.jpg" alt="capture_book_table_data">
</p>

Here is the code of `BookFactory.php`. As you can see we tried to mimic real books by generating long paragraph with spaces between them : 
```php
public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(rand(2, 5)),
            'author_id' => Author::factory(),
            'category_id' => Category::inRandomOrder()->first()->id, // Assign a random category 
            'body' => implode("<br><br>", array_map(function() {
                return fake()->text(500); // Generates a longer text (300 characters).
                }, range(1, rand(5, 9))) // Generates between 3 to 5 paragraphs.
            ),
            'published_year' =>$this->faker->dateTimeBetween('-400 years', '-5 years')->format('Y'),
        ];
    }
```

To avoid having to manually activate our factories by typing commands into `Tinker` for each new fresh migration, we created seeders to automatically populate our tables with the `php artisan migrate:fresh --seed` command. Here is what we wrote in each seeder : 
```php
// In AuthorSeeder.php
public function run(): void{
    Author::factory(6)->create(); //create 6 random authors using the linked factory 
}

// In CategorySeeder.php
public function run(): void{
    Category::factory(7)->create(); //create 7 category from the list given in the linked factory
}

public function run(): void{
        $this->call([CategorySeeder::class,AuthorSeeder::class]);
        Book::factory(100)->recycle([ //create 100 books and assign to them a category and an author already created by the 2 previous seeders. 
            Category::all(),
            Author::all(),
        ])->create();
    }
```

## User Interface

The UI uses TailwindCSS for styling and includes a responsive layout for better user experience. Here’s the dashboard / homepage of our website :

<p align="center">
    <img src="bookTracker/public/img/capture_home_page_top.jpg" alt="capture_home_page_top">
</p>

Buttons for actions (add author, add book, search) change color on hover to improve usability

**START EDITING FROM HERE**

## Book Management

You can create, edit, and delete books. Each book belongs to an author and a category.

<p align="center">
    <img src="public/img/capture_create_book.jpg" alt="Create Book Page">
</p>

Example code for displaying books with actions (file: `resources\views\books\index.blade.php`):

```php
@foreach($books as $book)
    <tr>
        <td>{{ $book->title }}</td>
        <td>{{ $book->author->first_name }} {{ $book->author->last_name }}</td>
        <td>{{ $book->published_year }}</td>
        <td>{{ $book->category->name }}</td>
        <td>
            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-edit">Edit</a>
            <form action="{{ route('books.destroy', $book->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-delete">Delete</button>
            </form>
        </td>
    </tr>
@endforeach
```

## Display Single Book

You can view the details of a single book by clicking its title. The view displays the book's title, author, category, and content.

<p align="center">
    <img src="public/img/capture_view_book.jpg" alt="View Book">
</p>

Example Blade view code (file: `resources\views\books\show.blade.php`):

```php
@extends('layouts.app')

@section('content')
    <h1>{{ $book->title }}</h1>
    <p>Author: {{ $book->author->first_name }} {{ $book->author->last_name }}</p>
    <p>Published Year: {{ $book->published_year }}</p>
    <p>Category: {{ $book->category->name }}</p>
    <div class="book-content">
        {{ $book->body }}
    </div>
@endsection
```

## Exception Management

### Exception handling in AuthorController.php

The destroy method in AuthorController.php handles the deletion of an author. If the author is linked to books, deletion is prevented and an error message is returned to the user.

Example AuthorController.php view code (file: `app/Http/Controllers/AuthorController.php`):

#### Code Example

```php
public function destroy(Author $author)
{
    try {
        if ($author->books()->count() > 0) {
            return redirect()->route('dashboard.index')->with('error', 'Cannot delete author with associated books.');
        }

        $author->delete();
        return redirect()->route('dashboard.index')->with('success', 'Author deleted successfully.');
    } catch (Exception $e) {
        Log::error('Error deleting author: ' . $e->getMessage());
        return redirect()->route('dashboard.index')->with('error', 'An error occurred while deleting the author.');
    }
}
```

### Displaying Success and Error Messages in Blade

The success and error messages are displayed in the Blade view using styled alerts. Here is an example of how to display these alerts in your Blade template.

Exemple welcome.blade.php view code (file: `aresources/views/welcome.blade.php`):

#### Code Example

```
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
```

## Dashboard Overview

The homepage of the application is a dashboard displaying counts of authors and books. You can navigate back to the dashboard from any page using the "Back to Dashboard" button.

<p align="center">
    <img src="public/img/capture_dashboard.jpg" alt="Dashboard">
</p>

Example controller code for the dashboard (file: `app\Http\Controllers\DashboardController.php`):

```php
public function index() {
    $authorsCount = Author::count();
    $booksCount = Book::count();
    $authors = Author::all();
    $books = Book::all();
    
    return view('welcome', compact('authorsCount', 'booksCount', 'authors', 'books'));
}
```

 (file: `resources\views\components\button.blade.php`):

```html
<a href="{{ route('books.index') }}" class="btn-back hover:bg-blue-600 hover:text-white">Back to Books List</a>
```
