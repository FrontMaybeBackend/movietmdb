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
        @foreach($translationsPL as $translation)
            <tr>
                <td>{{ $translation->trans_pl_title }}</td>
                <td>{{ $translation->trans_pl_overview }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>


</div>
</body>
</html>
