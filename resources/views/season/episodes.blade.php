<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $season->name }} - Episodes</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div>
    <h1>{{ $season->name }}</h1>
    <h2>Episodes</h2>
    <table class="episodes-table">
        <thead>
        <tr>
            <th>Episode Number</th>
            <th>Name</th>
            <th>Air Date</th>
            <th>Overview</th>
        </tr>
        </thead>
        <tbody>
        @foreach($episodes as $episode)
            <tr>
                <td>{{ $episode->episode_number }}</td>
                <td>{{ $episode->name }}</td>
                <td>{{ $episode->air_date }}</td>
                <td>{{ $episode->overview }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$episodes->links()}}
</div>
</body>
</html>
