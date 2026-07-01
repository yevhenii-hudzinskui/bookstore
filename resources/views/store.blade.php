<div>
    <form method="POST" action="{{ route('stor') }}" enctype='multipart/form-data'>
        @csrf
        <input type="file" name="test">
        <button type="submit">save</button>
    </form>
</div>
