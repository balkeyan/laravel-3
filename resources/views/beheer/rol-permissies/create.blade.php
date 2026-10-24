@extends('beheer.layout')

@section('inhoud')
    <h1>Permissie koppelen aan rol</h1>

    @if ($errors->any())
        <p style="color:red">Kies een permissie en een rol!</p>
    @endif

    <form action="/beheer/rol-permissies/store" method="POST">
        @csrf
        <p>Permissie:
            <select name="permission_id">
                @foreach ($permissies as $permissie)
                    <option value="{{ $permissie->id }}">{{ $permissie->id }} - {{ $permissie->name }}</option>
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
    <a href="/beheer/rol-permissies">Terug</a>
@endsection
