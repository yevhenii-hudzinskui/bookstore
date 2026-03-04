<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
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

    public function store(Request $request)
    {
        $author = Author::find($request->input('author_id'));

        $author->books()->create([
            'name' => $request->input('name'),
        ]);

        return to_route('books.index');
    }

    public function edit(Request $request, Book $book)
    {

        return view('edit')
            ->with('book', $book);
    }

    public function update(Request $request, Book $book)
    {
        $data = [
            'name' => $request->input('name'),
            'author' => $request->input('author')
        ];

        $book->fill($data);
        $book->save();

        return to_route('books.index');
    }

    public function destroy(Book $book){

        $book->delete();

        return to_route('books.index');
    }
}
