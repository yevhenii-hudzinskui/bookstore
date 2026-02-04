<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::controller(BookController::class)
    ->prefix('books')
    ->as('books.')
    ->group(function () {
        Route::get('',  'index')
            ->name('index');

        Route::get('create',  'create')
            ->name('create');

        Route::post('store', 'store')
            ->name('store');

        Route::get('{id}/edit', 'edit')
            ->where('id', '[0-9]+')
            ->name('edit');

        Route::put('{id}/update','update')
            ->name('update');

        Route::get('{id}', 'show')
            ->where('id', '[0-9]+')
            ->name('show');

        Route::delete('{id}', 'destroy')
            ->name('destroy');
    });


