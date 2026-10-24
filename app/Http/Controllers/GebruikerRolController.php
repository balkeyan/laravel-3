<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Spatie\Permission\Models\Role;

class GebruikerRolController extends Controller
{
    public function index()
    {
        // join zodat je ook de namen ziet en niet alleen de id's
        $koppelingen = DB::table('model_has_roles')
            ->join('users', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->select('model_has_roles.*', 'users.email as gebruiker', 'roles.name as rol')
            ->orderBy('model_id')
            ->get();

        return view('beheer.gebruiker-rollen.index', ['koppelingen' => $koppelingen]);
    }

    public function create()
    {
        return view('beheer.gebruiker-rollen.create', [
            'gebruikers' => User::all(),
            'rollen' => Role::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'model_id' => 'required',
            'role_id' => 'required',
        ]);

        $bestaat = DB::table('model_has_roles')
            ->where('model_id', $request->model_id)
            ->where('role_id', $request->role_id)
            ->exists();

        if ($bestaat) {
            return redirect('/beheer/gebruiker-rollen')->with('melding', 'Deze koppeling bestaat al');
        }

        DB::table('model_has_roles')->insert([
            'model_id' => $request->model_id,
            'model_type' => 'App\\Models\\User',
            'role_id' => $request->role_id,
        ]);

        // anders onthoudt spatie de oude permissies
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        return redirect('/beheer/gebruiker-rollen')->with('melding', 'Koppeling toegevoegd');
    }

    public function edit($model_id, $role_id)
    {
        return view('beheer.gebruiker-rollen.edit', [
            'model_id' => $model_id,
            'role_id' => $role_id,
            'gebruikers' => User::all(),
            'rollen' => Role::all(),
        ]);
    }

    public function update(Request $request, $model_id, $role_id)
    {
        $request->validate([
            'model_id' => 'required',
            'role_id' => 'required',
        ]);

        DB::table('model_has_roles')
            ->where('model_id', $model_id)
            ->where('role_id', $role_id)
            ->update([
                'model_id' => $request->model_id,
            'model_type' => 'App\\Models\\User',
                'role_id' => $request->role_id,
            ]);

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        return redirect('/beheer/gebruiker-rollen')->with('melding', 'Koppeling aangepast');
    }

    public function destroy($model_id, $role_id)
    {
        DB::table('model_has_roles')
            ->where('model_id', $model_id)
            ->where('role_id', $role_id)
            ->delete();

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        return redirect('/beheer/gebruiker-rollen')->with('melding', 'Koppeling verwijderd');
    }
}
