<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RolController extends Controller
{
    public function index()
    {
        $rollen = Role::all();
        return view('beheer.rollen.index', ['rollen' => $rollen]);
    }

    public function create()
    {
        return view('beheer.rollen.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);

        // guard_name is altijd web
        Role::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);

        return redirect('/beheer/rollen')->with('melding', 'Rol toegevoegd');
    }

    public function edit($id)
    {
        $rol = Role::find($id);
        return view('beheer.rollen.edit', ['rol' => $rol]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $id,
        ]);

        $rol = Role::find($id);
        $rol->name = $request->name;
        $rol->save();

        return redirect('/beheer/rollen')->with('melding', 'Rol aangepast');
    }

    public function destroy($id)
    {
        $rol = Role::find($id);
        $rol->delete();

        return redirect('/beheer/rollen')->with('melding', 'Rol verwijderd');
    }
}
