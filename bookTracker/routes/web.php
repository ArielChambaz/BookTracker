<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;


Route::get('/', [DashboardController::class, 'index']);

Route::get('/add-authors', [AuthorController::class, 'index']);
Route::post('/add-authors', [AuthorController::class, 'store']);

Route::resource('books', BookController::class);
Route::resource('authors', AuthorController::class);

Route::get('authors/afterEdit', [AuthorController::class, 'afterEdit'])->name('authors.afterEdit');
