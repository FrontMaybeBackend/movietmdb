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
    <table class="movies-table">
        <thead>
        <tr>
            <th>Tytuł</th>
            <th>Opis</th>
        </tr>
        </thead>
        <tbody>
        @foreach($translations as $translation)
            <tr>
                <td>
                    @if ($translation->trans_de_title)
                        {{ $translation->trans_de_title }}
                    @else
                        brak tłumaczenia
                    @endif
                </td>
                <td>{{ $translation->trans_de_overview }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$translations->links()}}

</div>
</body>
</html>
