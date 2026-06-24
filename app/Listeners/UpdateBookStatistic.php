<?php

namespace App\Listeners;

use App\Events\BookPublished;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateBookStatistic
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(BookPublished $event): void
    {
        dd($event);
        if($event->book->author_id === 8){
            dd('test');
        }
    }
}
