@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto">
        <h1>Dashboard</h1>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
@endsection
