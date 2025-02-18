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
            <th>Name</th>
        </tr>
        </thead>
        <tbody>
        @foreach($translations as $translation)
                <td>{{  __('genres.' . $translation->title) }}</td>
        @endforeach
        </tbody>
    </table>
    {{$translations->links()}}
</div>
</body>
</html>
