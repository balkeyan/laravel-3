@extends('beheer.layout')

@section('inhoud')
    <h1>Koppeling bewerken</h1>

    <form action="/beheer/gebruiker-rollen/update/{{ $model_id }}/{{ $role_id }}" method="POST">
        @csrf
        <p>Gebruiker:
            <select name="model_id">
                @foreach ($gebruikers as $gebruiker)
                    <option value="{{ $gebruiker->id }}" @if ($gebruiker->id == $model_id) selected @endif>{{ $gebruiker->id }} - {{ $gebruiker->email }}</option>
                @endforeach
            </select>
        </p>
        <p>Rol:
            <select name="role_id">
                @foreach ($rollen as $rol)
                    <option value="{{ $rol->id }}" @if ($rol->id == $role_id) selected @endif>{{ $rol->id }} - {{ $rol->name }}</option>
                @endforeach
            </select>
        </p>
        <button type="submit">Opslaan</button>
    </form>

    <br>
    <a href="/beheer/gebruiker-rollen">Terug</a>
@endsection
