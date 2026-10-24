<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Beheeromgeving</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; }
        nav { background: #333; padding: 10px 30px; }
        nav a { color: white; margin-right: 20px; text-decoration: none; }
        nav a:hover { text-decoration: underline; }
        .inhoud { margin: 30px; }
        table { border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 6px 10px; }
        th { background: #eee; }
        .melding { color: green; }
    </style>
</head>
<body>
    <nav>
        <a href="/beheer/permissies">Permissies</a>
        <a href="/beheer/rollen">Rollen</a>
        <a href="/beheer/rol-permissies">Rol-Permissies</a>
        <a href="/beheer/gebruiker-rollen">Rol-Gebruikers</a>
        <a href="/games">Games</a>
    </nav>

    <div class="inhoud">
        @if (session('melding'))
            <p class="melding">{{ session('melding') }}</p>
        @endif

        @yield('inhoud')
    </div>
</body>
</html>
