@extends('beheer.layout')

@section('inhoud')
    <h1>Rollen</h1>

    <a href="/beheer/rollen/create">Nieuwe rol</a>
    <br><br>

    <table>
        <tr>
            <th>id</th>
            <th>Naam</th>
            <th>Guard</th>
            <th>Acties</th>
        </tr>
        @foreach ($rollen as $rol)
        <tr>
            <td>{{ $rol->id }}</td>
            <td>{{ $rol->name }}</td>
            <td>{{ $rol->guard_name }}</td>
            <td>
                <a href="/beheer/rollen/edit/{{ $rol->id }}">Bewerken</a>
                <form action="/beheer/rollen/destroy/{{ $rol->id }}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit" onclick="return confirm('Weet je het zeker?')">Verwijderen</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
@endsection
