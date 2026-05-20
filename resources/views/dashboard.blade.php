@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto">
        <h1>@lang('Dashboard')</h1>
        <h1>{{ __('Dashboard') }}</h1>
        <h3>Текст</h3>
        <p>Selected Locale: {{ session('locale') }}</p>
        <p>Current locale: {{ app()->currentLocale() }}</p>
        <form action="{{ route('change-locale') }}" method="POST">
            @csrf
            <select name="locale">
                @foreach(config('app.locales') as $locale)
                    <option value="{{ $locale }}" @selected(session('locale') == $locale)>{{ $locale }}</option>
                @endforeach
                    <option value="pl" @selected(session('locale') == 'pl')>pl</option>
            </select>
            <button type="submit">Change language</button>
        </form>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>

    </div>
@endsection
