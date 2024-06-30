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
    <table>
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
                <td>{{ $serie->id }}</td>
                <td>{{ $serie->title }}</td>
                <td>{{ $serie->overview }}</td>
                <td>{{ $serie->tmdb_id }}</td>
                <td>{{ $serie->translations }}</td>
            </tr>
        </tbody>
    </table>
    <a href="{{ route('serie') }}">Back</a>
</div>
</body>
</html>
