@extends('beheer.layout')

@section('inhoud')
    <h1>Permissies koppelen aan rollen</h1>

    <a href="/beheer/rol-permissies/create">Nieuwe koppeling</a>
    <br><br>

    <table>
        <tr>
            <th>permission_id</th>
            <th>Permissie</th>
            <th>role_id</th>
            <th>Rol</th>
            <th>Acties</th>
        </tr>
        @foreach ($koppelingen as $k)
        <tr>
            <td>{{ $k->permission_id }}</td>
            <td>{{ $k->permissie }}</td>
            <td>{{ $k->role_id }}</td>
            <td>{{ $k->rol }}</td>
            <td>
                <a href="/beheer/rol-permissies/edit/{{ $k->permission_id }}/{{ $k->role_id }}">Bewerken</a>
                <form action="/beheer/rol-permissies/destroy/{{ $k->permission_id }}/{{ $k->role_id }}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit" onclick="return confirm('Weet je het zeker?')">Verwijderen</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
@endsection
