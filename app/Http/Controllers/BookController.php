<?php

namespace App\Http\Controllers;

use App\Actions\CreateBookAction;
use App\Events\BookPublished;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Jobs\BookViewed;
use App\Models\Author;
use App\Models\Book;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Attributes\Controllers\Authorize;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;

class BookController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('can-view-books');

        $books = Book::all();

        return view('index')
            ->with('books', $books);
    }

    #[Authorize('view', 'book')]
    public function show(Book $book)
    {
        return view('show')
            ->with('book', $book);
    }

    public function create()
    {
        Gate::authorize('create', Book::class);

        $authors = Author::all();

        return view('create')
            ->with('authors', $authors);
    }

    public function store(StoreBookRequest $request, CreateBookAction $createBookAction)
    {
        Gate::authorize('create', Book::class);

        $book = $createBookAction->execute(
            $request->validated(),
            $request->safe()->input('author_id'),
            $request->user()
        );

//        BookPublished::dispatch($book, $request->user());

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

    #[Authorize('delete', 'book')]
    public function destroy(Book $book){

        $book->delete();

        return to_route('books.index');
    }
}
