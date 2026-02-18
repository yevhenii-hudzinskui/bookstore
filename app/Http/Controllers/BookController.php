<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return view('create');
    }

    public function store(Request $request)
    {
        $book = [
            'name' => $request->input('name'),
            'author' => $request->input('author')
        ];

        Book::create($book);

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
