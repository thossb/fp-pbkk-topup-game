<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\GameDenom;

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
        $denoms = GameDenom::where('game_id', $id)->get();

        return view('games.show', compact('game', 'denoms')); //belum ada view
    }


    // public function test()
    // {
    //     $game = Game::with(['transaction'])->all();

    //     return response()->json(['message' => 'makan bang', 'data' => $game]);
    // }

    // public function testIndividual($id)
    // {
    //     $game = Game::where(['id', '=', $id])->first();
    //     $game->transaction();

    //     return response()->json(['message' => 'makan bang', 'data' => $game]);
    // }
}
