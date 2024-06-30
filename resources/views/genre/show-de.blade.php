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
    <a href ="{{ route('genre.show-pl') }}">
        <button type="submit">PL</button>
    </a>
    <a href ="{{ route('genre.show-de') }}">
        <button type="submit">DE</button>
    </a>
    <table class="genres-table">
        <thead>
        <tr>
            <th>Name</th>
        </tr>
        </thead>
        <tbody>
        @foreach($translationsPL as $translations)
            <td>{{  __('genres.' . $translations->title) }}</td>
        @endforeach
        </tbody>
    </table>
    {{$translationsPL->links()}}
</div>
</body>
</html>
