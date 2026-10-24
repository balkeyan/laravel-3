@extends('beheer.layout')

@section('inhoud')
    <h1>Nieuwe permissie</h1>

    @error('name')
        <p style="color:red">{{ $message }}</p>
    @enderror

    <form action="/beheer/permissies/store" method="POST">
        @csrf
        <p>Naam: <input type="text" name="name"></p>
        <button type="submit">Opslaan</button>
    </form>

    <br>
    <a href="/beheer/permissies">Terug</a>
@endsection
