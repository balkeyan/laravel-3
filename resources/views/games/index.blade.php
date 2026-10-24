<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Game Collection</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        table { border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 6px 10px; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h1>Mijn Game Collection</h1>

    @auth
        <p>Ingelogd als: {{ Auth::user()->email }}</p>
    @endauth

    @role('admin')
        <p>Welkom beheerder! Je hebt volledige toegang.</p>
        <p><a href="/beheer/permissies">Naar de beheeromgeving</a></p>
    @endrole

    @role('klant')
        <p>Welkom klant! Je kunt de games bekijken.</p>
    @endrole

    @can('product invoeren')
        <a href="/games/create">Game toevoegen</a>
        <br><br>
    @endcan

    <table>
        <tr>
            <th>Titel</th>
            <th>Genre</th>
            <th>Platform</th>
            <th>Jaar</th>
            <th>Acties</th>
        </tr>
        @foreach ($games as $game)
        <tr>
            <td>{{ $game->title }}</td>
            <td>{{ $game->genre }}</td>
            <td>{{ $game->platform }}</td>
            <td>{{ $game->release_year }}</td>
            <td>
                @can('product aanpassen')
                    <a href="/games/edit/{{ $game->id }}">Edit</a>
                @endcan
                @can('product verwijderen')
                    <form action="/games/destroy/{{ $game->id }}" method="POST" style="display:inline">
                        @csrf
                        <button type="submit">Delete</button>
                    </form>
                @endcan
                @cannot('product aanpassen')
                    geen rechten
                @endcannot
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>
