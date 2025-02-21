<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>series Table</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div>
    <a href="{{ route('serie.translate', ['language' => 'pl']) }}">
        <button>PL</button>
    </a>
    <a href="{{ route('serie.translate', ['language' => 'de']) }}">
        <button>DE</button>
    </a>
    <table class="series-table">
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
        @foreach($series as $serie)
            <tr>
                <td>{{ $serie->id }}</td>
                <td>{{ $serie->title_with_prefix }}</td>
                <td>{{ $serie->overview }} </td>
                <td>{{ $serie->tmdb_id }}</td>
                <td> <a href="{{ route('serie.show', $serie) }}">View</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
