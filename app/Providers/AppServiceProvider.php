<?php

namespace App\Providers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::before(function (User $user, string $ability) {
            if ($user->isAdministrator()) {
                return true;
            }
        });

        Gate::define('update-book', function (User $user, Book $book) {
            return $user->id !== $book->user_id
                ? Response::allow()
//                : Response::deny();
                : Response::denyAsNotFound();
        });

        Gate::define('can-view-books', function (User $user) {
            return $user->email === 'test@example.com';
        });
    }
}
