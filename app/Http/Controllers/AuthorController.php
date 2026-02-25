<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::all();

        return view('authors.index')
            ->with('authors', $authors);
    }

    public function store(Request $request)
    {
        Author::create([
            'name' => $request->input('name'),
            'country' => $request->input('country'),
        ]);

        return redirect()->route('authors.index');
    }
}
