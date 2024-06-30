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
    <table class="series-table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Overview</th>
            <th>tmdb_id</th>
            <th>Translations</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($series as $serie)
            <tr>
                <td>{{ $serie->id }}</td>
                <td>{{ $serie->title }}</td>
                <td>{{ $serie->overview }}</td>
                <td>{{ $serie->tmdb_id }}</td>
                <td>{{ $serie->translations }}</td>
                <td> <a href="{{ route('serie.show', $serie->id) }}">View</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
