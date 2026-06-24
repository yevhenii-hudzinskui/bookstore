<?php

namespace App\Observers;

use App\Jobs\BookViewed;
use App\Models\Book;

class BookObserver
{

    public function retrieved(Book $book): void
    {
        // BookViewed::dispatch($book)->delay(now()->addSeconds(50));
    }
    /**
     * Handle the Book "created" event.
     */
    public function created(Book $book): void
    {
        dd($book);
    }

    /**
     * Handle the Book "updated" event.
     */
    public function updated(Book $book): void
    {
        //
    }

    /**
     * Handle the Book "deleted" event.
     */
    public function deleted(Book $book): void
    {
        //
    }

    /**
     * Handle the Book "restored" event.
     */
    public function restored(Book $book): void
    {
        //
    }

    /**
     * Handle the Book "force deleted" event.
     */
    public function forceDeleted(Book $book): void
    {
        //
    }
}
