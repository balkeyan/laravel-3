<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Game bewerken</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 30px;">
    <h1>Game bewerken</h1>

    @if ($errors->any())
        <p style="color:red">Vul alle velden in!</p>
    @endif

    <form action="/games/update/{{ $game->id }}" method="POST">
        @csrf
        <p>Titel: <input type="text" name="title" value="{{ $game->title }}"></p>
        <p>Genre: <input type="text" name="genre" value="{{ $game->genre }}"></p>
        <p>Platform: <input type="text" name="platform" value="{{ $game->platform }}"></p>
        <p>Jaar: <input type="number" name="release_year" value="{{ $game->release_year }}"></p>
        <button type="submit">Opslaan</button>
    </form>

    <br>
    <a href="/games">Terug</a>
</body>
</html>
