@extends('beheer.layout')

@section('inhoud')
    <h1>Rol koppelen aan gebruiker</h1>

    @if ($errors->any())
        <p style="color:red">Kies een gebruiker en een rol!</p>
    @endif

    <form action="/beheer/gebruiker-rollen/store" method="POST">
        @csrf
        <p>Gebruiker:
            <select name="model_id">
                @foreach ($gebruikers as $gebruiker)
                    <option value="{{ $gebruiker->id }}">{{ $gebruiker->id }} - {{ $gebruiker->email }}</option>
                @endforeach
            </select>
        </p>
        <p>Rol:
            <select name="role_id">
                @foreach ($rollen as $rol)
                    <option value="{{ $rol->id }}">{{ $rol->id }} - {{ $rol->name }}</option>
                @endforeach
            </select>
        </p>
        <button type="submit">Opslaan</button>
    </form>

    <br>
    <a href="/beheer/gebruiker-rollen">Terug</a>
@endsection
