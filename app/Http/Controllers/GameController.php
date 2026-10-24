<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    // overzicht van alle games
    public function index()
    {
        $games = Game::all();
        return view('games.index', ['games' => $games]);
    }

    public function create()
    {
        return view('games.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'genre' => 'required',
            'platform' => 'required',
            'release_year' => 'required|integer',
        ]);

        Game::create($request->all());

        return redirect('/games');
    }

    public function edit($id)
    {
        $game = Game::find($id);
        return view('games.edit', ['game' => $game]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'genre' => 'required',
            'platform' => 'required',
            'release_year' => 'required|integer',
        ]);

        $game = Game::find($id);
        $game->update($request->all());

        return redirect('/games');
    }

    public function destroy($id)
    {
        $game = Game::find($id);
        $game->delete();

        return redirect('/games');
    }
}
