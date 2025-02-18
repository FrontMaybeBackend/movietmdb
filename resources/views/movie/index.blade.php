<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies Table</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div>
    <a href="{{ route('movie.translate', ['language' => 'pl']) }}">
        <button>PL</button>
    </a>
    <a href="{{ route('movie.translate', ['language' => 'de']) }}">
        <button>DE</button>
    </a>
    <table class="movies-table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Overview</th>
            <th>tmdb_id</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($movies as $movie)
            <tr>
                <td>{{ $movie->id }}</td>
                <td>{{ $movie->title }}</td>
                <td>{{ $movie->overview }}</td>
                <td>{{ $movie->tmdb_id }}</td>
                <td> <a href="{{route('movie.show',$movie->id)}}">View</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$movies->links()}}

</div>
</body>
</html>
