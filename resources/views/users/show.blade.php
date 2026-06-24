@extends('layouts.app')

@section('title', 'Профіль ' . $user->name)

@section('content')
    <h1>Користувач: {{ $user->name }}</h1>
    <p>Дата реєстрації: {{ $user->created_at->format('d.m.Y') }}</p>
    
    <h3>Книги:</h3>
    {{-- Тут може бути цикл @foreach --}}
@endsection