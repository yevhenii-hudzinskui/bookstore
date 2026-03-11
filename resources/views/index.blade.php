@extends('layouts.app')

@section('content')
<div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
        <h1 class="text-3xl font-semibold text-gray-900 leading-6 tracking-tight">Books</h1>
        <p class="mt-2 text-sm text-gray-700">A list of all the books in your store including their ID, name, and author.</p>
    </div>
    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
        <a href="{{ route('books.create') }}" class="block px-3 py-2 text-sm font-semibold text-center text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            Add new book
        </a>
    </div>
</div>

<div class="flow-root mt-8">
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">ID</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Name</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Author</th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6 text-right">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($books as $book)
                        <tr>
                            <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap sm:pl-6">{{ $book->id }}</td>
                            <td class="px-3 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                                <a href="{{ route('books.show', $book) }}" class="text-indigo-600 hover:text-indigo-900">{{ $book->name }}</a>
                            </td>
                            <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $book->author?->name ?? 'Unknown' }}</td>
                            <td class="relative py-4 pl-3 pr-4 text-sm font-medium text-right whitespace-nowrap sm:pr-6">
                                <a href="{{ route('books.edit', $book) }}" class="mr-3 text-indigo-600 hover:text-indigo-900 inline-block">Edit</a>
                                <form method="POST" action="{{ route('books.destroy', $book) }}" class="inline">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
