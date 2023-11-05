<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::all(); // Retrieve all available games.

        return view('games.index', compact('games')); // belum ada view
    }

    public function map()
    {
        $games = Game::all();

        return view('dashboard-topup', compact('games'));
    }

    public function show($id)
    {
        $game = Game::find($id); // Retrieve a specific game by ID.

        return view('games.show', compact('game')); //belum ada view
    }
}
