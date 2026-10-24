<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolPermissieController extends Controller
{
    public function index()
    {
        // join zodat je ook de namen ziet en niet alleen de id's
        $koppelingen = DB::table('role_has_permissions')
            ->join('permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
            ->join('roles', 'roles.id', '=', 'role_has_permissions.role_id')
            ->select('role_has_permissions.*', 'permissions.name as permissie', 'roles.name as rol')
            ->orderBy('role_id')
            ->get();

        return view('beheer.rol-permissies.index', ['koppelingen' => $koppelingen]);
    }

    public function create()
    {
        return view('beheer.rol-permissies.create', [
            'permissies' => Permission::all(),
            'rollen' => Role::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'permission_id' => 'required',
            'role_id' => 'required',
        ]);

        $bestaat = DB::table('role_has_permissions')
            ->where('permission_id', $request->permission_id)
            ->where('role_id', $request->role_id)
            ->exists();

        if ($bestaat) {
            return redirect('/beheer/rol-permissies')->with('melding', 'Deze koppeling bestaat al');
        }

        DB::table('role_has_permissions')->insert([
            'permission_id' => $request->permission_id,
            'role_id' => $request->role_id,
        ]);

        // anders onthoudt spatie de oude permissies
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        return redirect('/beheer/rol-permissies')->with('melding', 'Koppeling toegevoegd');
    }

    public function edit($permission_id, $role_id)
    {
        return view('beheer.rol-permissies.edit', [
            'permission_id' => $permission_id,
            'role_id' => $role_id,
            'permissies' => Permission::all(),
            'rollen' => Role::all(),
        ]);
    }

    public function update(Request $request, $permission_id, $role_id)
    {
        $request->validate([
            'permission_id' => 'required',
            'role_id' => 'required',
        ]);

        DB::table('role_has_permissions')
            ->where('permission_id', $permission_id)
            ->where('role_id', $role_id)
            ->update([
                'permission_id' => $request->permission_id,
                'role_id' => $request->role_id,
            ]);

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        return redirect('/beheer/rol-permissies')->with('melding', 'Koppeling aangepast');
    }

    public function destroy($permission_id, $role_id)
    {
        DB::table('role_has_permissions')
            ->where('permission_id', $permission_id)
            ->where('role_id', $role_id)
            ->delete();

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        return redirect('/beheer/rol-permissies')->with('melding', 'Koppeling verwijderd');
    }
}
