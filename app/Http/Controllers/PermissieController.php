<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissieController extends Controller
{
    public function index()
    {
        $permissies = Permission::all();
        return view('beheer.permissies.index', ['permissies' => $permissies]);
    }

    public function create()
    {
        return view('beheer.permissies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);

        // guard_name is altijd web
        Permission::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);

        return redirect('/beheer/permissies')->with('melding', 'Permissie toegevoegd');
    }

    public function edit($id)
    {
        $permissie = Permission::find($id);
        return view('beheer.permissies.edit', ['permissie' => $permissie]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $id,
        ]);

        $permissie = Permission::find($id);
        $permissie->name = $request->name;
        $permissie->save();

        return redirect('/beheer/permissies')->with('melding', 'Permissie aangepast');
    }

    public function destroy($id)
    {
        $permissie = Permission::find($id);
        $permissie->delete();

        return redirect('/beheer/permissies')->with('melding', 'Permissie verwijderd');
    }
}
