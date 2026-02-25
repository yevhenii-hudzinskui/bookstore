<div>
    @if($authors->isEmpty())
        <p>Authors is empty</p>
    @else
        @foreach($authors as $author)
            <p>Name: {{ $author->name }}</p>
        @endforeach
    @endif
</div>
