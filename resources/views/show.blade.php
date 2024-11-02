<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chirp Details</title>
</head>
<body>
    <h1>{{ $chirp->user->name }}'s Chirp</h1>
    <p>{{ $chirp->message }}</p>
    <p>Posted on: {{ $chirp->created_at }}</p>
    <a href="{{ url('/chirps') }}">Back to Chirps</a>
</body>
</html>