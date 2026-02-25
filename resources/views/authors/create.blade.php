<div>
    <form method="POST" action="{{ route('authors.store') }}">
        @csrf
        <label>Name:
            <input type="text" name="name">
        </label>
        <label>Country:
            <input type="text" name="country">
        </label>
        <button type="submit">Create</button>
    </form>
</div>
