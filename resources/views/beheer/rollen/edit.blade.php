@extends('beheer.layout')

@section('inhoud')
    <h1>Rol bewerken</h1>

    @error('name')
        <p style="color:red">{{ $message }}</p>
    @enderror

    <form action="/beheer/rollen/update/{{ $rol->id }}" method="POST">
        @csrf
        <p>Naam: <input type="text" name="name" value="{{ $rol->name }}"></p>
        <button type="submit">Opslaan</button>
    </form>

    <br>
    <a href="/beheer/rollen">Terug</a>
@endsection
