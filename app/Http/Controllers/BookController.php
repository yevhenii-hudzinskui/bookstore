<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public array $books = [
        1 => ['name' => 'book 1', 'author' => 'author 1'],
        2 => ['name' => 'book 2', 'author' => 'author 2'],
        3 => ['name' => 'book 3', 'author' => 'author 3'],
        4 => ['name' => 'book 4', 'author' => 'author 4'],
    ];

    public function index()
    {
//        DB::table('books')->insert(['name' => 'book 1', 'author' => 'author 1']);
        $res = DB::table('books')->get();
        dd($res);
        return view('index')
            ->with('books', $this->books);
    }

    public function show(int $id)
    {
        return view('show')
           ->with('id', $id)
            ->with('book', $this->books[$id]);
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        // Збереження в базу даних
        //
        return to_route('books.index');
    }

    public function edit(Request $request, int $id)
    {
        return view('edit')
            ->with('id', $id)
            ->with('book', $this->books[$id]);
    }

    public function update(Request $request, $id)
    {
        // Оновлення в базі даних
        //
        return to_route('books.index');
    }

    public function destroy(int $id){
        // видалення в базі даних
        //
        return to_route('books.show', ['id' => $id]);
    }
}
