<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;

// Routes pour le tableau de bord
Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

// Route pour afficher le formulaire de création d'un auteur
Route::get('/authors/create', [AuthorController::class, 'create'])->name('authors.create');

// Route pour afficher le formulaire de modification d'un auteur
Route::get('/authors/{author}/edit', [AuthorController::class, 'edit'])->name('authors.edit');


Route::resource('authors', AuthorController::class);

// Routes pour les livres
Route::resource('books', BookController::class);