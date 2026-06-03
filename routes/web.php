<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ChangeLocale;
use App\Http\Middleware\EnsureTokenIsValid;
use Illuminate\Support\Facades\Route;

Route::get('users', function () {
    $response = Http::withUrlParameters([
        'endpoint' => 'https://laravel.com',
        'page' => 'docs',
        'version' => '13.x',
        'topic' => 'validation',
    ])->get('{+endpoint}/{page}/{version}/{topic}');

    dd($response->body());
    $response = \Illuminate\Support\Facades\Http::local()->withQueryParameters([
        'page' => 1,
    ])->timeout(35)->get('/api/users');

    $data = $response->json('data');
    return view('users')->with('users', $data);
});

Route::get('users/store', function () {

    $response = \Illuminate\Support\Facades\Http::local()->post('/api/users', [
        'name' => 'test',
        'email' => 'test23434@exc.com',
        'password' => 'secret'
    ]);

    $response->onError(function ($response) {
        dd($response->status(), $response->body());
    });
    dd($response->status());
//    $response->throw();
});



Route::post('change-locale', ChangeLocale::class)
    ->name('change-locale');

//Route::permanentRedirect('/', '/' . app()->getLocale());

Route::prefix('{locale?}')->
    group(
    function () {

    Route::view('/', 'welcome');

    Route::get('/home', function () {

        $response = Http::dd()->withUrlParameters([
            'endpoint' => 'https://laravel.com',
            'page' => 'docs',
            'version' => '13.x',
            'topic' => 'validation',
        ])->get('{+endpoint}/{page}/{version}/{topic}');

        dd($response->status(), $response->body());
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

    });
