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
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{ $movie->id }}</td>
            <td>{{ $movie->title }}</td>
            <td>{{ $movie->overview }}</td>
            <td>{{ $movie->tmdb_id }}</td>
            <td>{{ $movie->translations }}</td>
        </tr>
        </tbody>
    </table>
    <a href="{{ route('movie') }}">Back</a>
</div>
</body>
</html>
