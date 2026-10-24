@extends('beheer.layout')

@section('inhoud')
    <h1>Permissies</h1>

    <a href="/beheer/permissies/create">Nieuwe permissie</a>
    <br><br>

    <table>
        <tr>
            <th>id</th>
            <th>Naam</th>
            <th>Guard</th>
            <th>Acties</th>
        </tr>
        @foreach ($permissies as $permissie)
        <tr>
            <td>{{ $permissie->id }}</td>
            <td>{{ $permissie->name }}</td>
            <td>{{ $permissie->guard_name }}</td>
            <td>
                <a href="/beheer/permissies/edit/{{ $permissie->id }}">Bewerken</a>
                <form action="/beheer/permissies/destroy/{{ $permissie->id }}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit" onclick="return confirm('Weet je het zeker?')">Verwijderen</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
@endsection
