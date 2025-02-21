<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $serie->title }} - Seasons</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div>
    <h1>{{ $serie->title }}</h1>
    <h2>Seasons</h2>
    <table class="seasons-table">
        <thead>
        <tr>
            <th>Season Number</th>
            <th>Name</th>
            <th>Overview</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($seasons as $season)
            <tr>
                <td>{{ $season->season_number }}</td>
                <td>{{ $season->name }}</td>
                <td>{{ $season->overview }}</td>
                <td><a href="{{ route('season.show', $season->id) }}">View Episodes</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
