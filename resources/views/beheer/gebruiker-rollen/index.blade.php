@extends('beheer.layout')

@section('inhoud')
    <h1>Rollen koppelen aan gebruikers</h1>

    <a href="/beheer/gebruiker-rollen/create">Nieuwe koppeling</a>
    <br><br>

    <table>
        <tr>
            <th>model_id</th>
            <th>Gebruiker</th>
            <th>role_id</th>
            <th>Rol</th>
            <th>Acties</th>
        </tr>
        @foreach ($koppelingen as $k)
        <tr>
            <td>{{ $k->model_id }}</td>
            <td>{{ $k->gebruiker }}</td>
            <td>{{ $k->role_id }}</td>
            <td>{{ $k->rol }}</td>
            <td>
                <a href="/beheer/gebruiker-rollen/edit/{{ $k->model_id }}/{{ $k->role_id }}">Bewerken</a>
                <form action="/beheer/gebruiker-rollen/destroy/{{ $k->model_id }}/{{ $k->role_id }}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit" onclick="return confirm('Weet je het zeker?')">Verwijderen</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
@endsection
