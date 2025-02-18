<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>genres</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div>
    <a href="{{ route('genre.translate', ['language' => 'pl']) }}">
        <button>PL</button>
    </a>
    <a href="{{ route('genre.translate', ['language' => 'de']) }}">
        <button>DE</button>
    </a>

    <table class="genres-table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>tmdb_id</th>
            <th>Translations</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($genres as $genre)
            <tr>
                <td>{{  $genre->id }}</td>
                <td>{{ $genre->title}}</td>
                <td>{{ $genre->tmdb_id }}</td>
                <td>{{ $genre->translations }}</td>
                <td><a href="{{ route('genre.show', $genre->id) }}">View</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $genres->links() }}
</div>
</body>
</html>
