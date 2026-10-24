@extends('beheer.layout')

@section('inhoud')
    <h1>Koppeling bewerken</h1>

    <form action="/beheer/rol-permissies/update/{{ $permission_id }}/{{ $role_id }}" method="POST">
        @csrf
        <p>Permissie:
            <select name="permission_id">
                @foreach ($permissies as $permissie)
                    <option value="{{ $permissie->id }}" @if ($permissie->id == $permission_id) selected @endif>{{ $permissie->id }} - {{ $permissie->name }}</option>
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
    <a href="/beheer/rol-permissies">Terug</a>
@endsection
