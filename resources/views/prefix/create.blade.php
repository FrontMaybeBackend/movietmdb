<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Prefix</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div>
    <h1>Add Prefix</h1>
    <form action="{{ route('prefix.store') }}" method="POST">
        @csrf
        <div>
            <label for="type">Type (movie/serie):</label>
            <input type="text" name="type" id="type" value="{{ old('type') }}" required>
            @error('type')
            <div class="error" style="color: red;">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="value">Value:</label>
            <input type="text" name="value" id="value" value="{{ old('value') }}" required>
            @error('value')
            <div class="error" style="color: red;">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <button type="submit">Add Prefix</button>
        </div>
    </form>
</div>
</body>
</html>
