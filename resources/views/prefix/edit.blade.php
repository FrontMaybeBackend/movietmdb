<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Prefix</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div>
    <h1>Edit Prefix for {{ $prefix->type }}</h1>

    @if(session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('prefix.update', $prefix->type) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="value">Prefix Value:</label>
        <input type="text" name="value" id="value" value="{{ old('value', $prefix->value) }}" required>

        @error('value')
        <div style="color: red;">{{ $message }}</div>
        @enderror

        <button type="submit">Update Prefix</button>
    </form>

    <a href="{{ route('prefix.edit', $prefix->type) }}">Back</a>
</div>
</body>
</html>
