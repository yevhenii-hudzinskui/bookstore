<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::middleware('auth')
    ->group( function () {
        Route::view('dashboard', 'dashboard')
            ->name('dashboard');

        Route::resource('books', BookController::class);

        Route::get('authors', [AuthorController::class, 'index'])->name('authors.index');

        Route::view('authors/create', 'authors.create');
        Route::post('authors', [AuthorController::class, 'store'])
            ->name('authors.store');
    });


