<?php

// App/Http/Repository/GameRepository.php

namespace App\Http\Repository;

use App\Models\Game;
use App\Models\GameDenom;
use Illuminate\Http\Request;

class GameRepository
{
    public function getAllGames()
    {
        return Game::all();
    }

    public function getPaginatedGames($perPage)
    {
        return Game::paginate($perPage);
    }

    public function getGameById($id)
    {
        return Game::find($id);
    }

    public function addGame(Request $request)
    {
        $validated = $request->validate([
            // Validation rules
        ]);

        return Game::create($validated);
    }

    public function updateGame(Request $request, $id)
    {
        $game = Game::find($id);

        if (!$game) {
            return false; // or throw an exception
        }

        $validated = $request->validate([
            // Validation rules
        ]);

        $game->update($validated);

        return $game;
    }

    public function deleteGame($id)
    {
        $game = Game::find($id);

        if (!$game) {
            return false; // or throw an exception
        }

        $game->delete();

        return true;
    }
}
