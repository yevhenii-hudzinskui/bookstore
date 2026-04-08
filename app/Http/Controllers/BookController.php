<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BookController extends Controller
{
    public function index()
    {
        Gate::authorize('can-view-books');
        $books = Book::all();

        return view('index')
            ->with('books', $books);
    }

    public function show(Book $book)
    {
        return view('show')
            ->with('book', $book);
    }

    public function create()
    {
        $authors = Author::all();

        return view('create')
            ->with('authors', $authors);
    }

    public function store(StoreBookRequest $request)
    {
        $author = Author::findOrFail($request->safe()->input('author_id'));
        $user = $request->user();

        $book = Book::make($request->validated());
        $book->author()->associate($author);
        $book->user()->associate($user);
        $book->save();

        return to_route('books.index');
    }

    public function edit(Request $request, Book $book)
    {
        Gate::authorize('update-book', $book);

        $authors = Author::all();

        return view('edit')
            ->with('book', $book)
            ->with('authors', $authors);
    }

    public function update(UpdateBookRequest $request, Book $book)
    {
        $author = Author::findOrFail($request->safe()->input('author_id'));

        $book->fill($request->validated());
        $book->author()->associate($author);
        $book->save();

        return to_route('books.index');
    }

    public function destroy(Book $book){

        $book->delete();

        return to_route('books.index');
    }
}
