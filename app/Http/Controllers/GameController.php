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
        $games = Game::paginate(6);

        return view('dashboard-topup', compact('games'));
    }

    public function show($id)
    {
        $game = Game::find($id); // Retrieve a specific game by ID.
        $denoms = GameDenom::where('game_id', $id)->get();

        return view('games.show', compact('game', 'denoms')); //belum ada view
    }

    /**
     * Add a new game.
     */
    public function addGame(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:128',
            'description' => 'nullable|string|max:128',
            'category' => 'required|string|max:128',
            'unit' => 'required|string|max:20',
        ]);

        $game = new Game([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'category' => $validated['category'],
            'unit' => $validated['unit'],
        ]);

        $game->save();

        return redirect()->route('game.list')->with('status', 'Game added successfully');
    }

    /**
     * Get the list of games.
     */
    public function getGameList(Request $request)
    {
        $pagination = 6;
        $query = Game::query();
    
        if ($request->has('query')) {
            $search_text = $request->input('query');
            $query->where(function ($q) use ($search_text) {
                $q->where('name', 'LIKE', "%$search_text%")
                    ->orWhere('description', 'LIKE', "%$search_text%")
                    ->orWhere('category', 'LIKE', "%$search_text%")
                    ->orWhere('unit', 'LIKE', "%$search_text%");
            });
        }
    
        if ($request->has('sort_by')) {
            $sort_by = $request->input('sort_by');
            if ($sort_by === 'name_asc') {
                $query->orderBy('name', 'asc');
            } elseif ($sort_by === 'name_desc') {
                $query->orderBy('name', 'desc');
            } elseif ($sort_by === 'description_asc') {
                $query->orderBy('description', 'asc');
            } elseif ($sort_by === 'description_desc') {
                $query->orderBy('description', 'desc');
            } elseif ($sort_by === 'category_asc') {
                $query->orderBy('category', 'asc');
            } elseif ($sort_by === 'category_desc') {
                $query->orderBy('category', 'desc');
            } elseif ($sort_by === 'unit_asc') {
                $query->orderBy('unit', 'asc');
            } elseif ($sort_by === 'unit_desc') {
                $query->orderBy('unit', 'desc');
            }
        } else {
            $query->orderBy('name', 'asc');
        }
    
        $games = $query->paginate($pagination);
    
        return view('games.list', [
            'title' => 'Game List',
            'games' => $games,
            'query' => $request->input('query'),
            'sort_by' => $request->input('sort_by'),
        ]);
    }

    /**
     * Update a game.
     */
    public function updateGame(Request $request, $id)
    {
        $game = Game::find($id);

        if (!$game) {
            return redirect()->route('game.list')->with('error', 'Game not found');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:128',
            'description' => 'nullable|string|max:128',
            'category' => 'required|string|max:128',
            'unit' => 'required|string|max:20',
        ]);

        $game->name = $validated['name'];
        $game->description = $validated['description'];
        $game->category = $validated['category'];
        $game->unit = $validated['unit'];

        $game->save();

        return redirect()->route('game.list')->with('status', 'Game updated successfully');
    }

    /**
     * Delete a game.
     */
    public function deleteGame($id)
    {
        $game = Game::find($id);

        if (!$game) {
            return redirect()->route('game.list')->with('error', 'Game not found');
        }

        $game->delete();

        return redirect()->route('game.list')->with('status', 'Game deleted successfully');
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
