<?php

namespace App\Actions;

use App\Models\Author;
use App\Models\Book;
use App\Models\User;

class CreateBookAction
{
    public function execute(array $data, int $authorId, User $user): Book
    {
        $author = Author::findOrFail($authorId);

        $book = Book::make($data);
        $book->author()->associate($author);
        $book->user()->associate($user);
        $book->save();

        return $book;
    }
}