<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>
</head>
<body>
    <h1>Create Event</h1>
    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif
    <form action="{{ route('events.store') }}" method="POST">
        @csrf
        <div>
            <label for="starts_at">Starts At:</label>
            <input type="datetime-local" id="starts_at" name="starts_at">
        </div>
        <div>
            <label for="expires_at">Expires At:</label>
            <input type="datetime-local" id="expires_at" name="expires_at">
        </div>
        <button type="submit">Create Event</button>
    </form>
</body>
</html>