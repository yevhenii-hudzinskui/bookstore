<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Middleware\EnsureTokenIsValid;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('/home', function () {
    dd('Home page');
});

Route::get('/profile', function () {
    echo 'Profile page';
})->middleware(EnsureTokenIsValid::class);

Route::middleware('auth')
    ->group( function () {
        Route::view('dashboard', 'dashboard')
            ->middleware('can:can-view-dashboard')
            ->middleware('can:can-view-books')
            ->name('dashboard');

        Route::resource('books', BookController::class);

        Route::get('authors', [AuthorController::class, 'index'])->name('authors.index');

        Route::view('authors/create', 'authors.create');
        Route::post('authors', [AuthorController::class, 'store'])
            ->name('authors.store');
    });


