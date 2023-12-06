<?php

// App/Http/Repository/GameDenomRepository.php

namespace App\Http\Repository;

use App\Models\GameDenom;
use Illuminate\Support\Collection;

class GameDenomRepository
{
    public function getAllGameDenoms(): Collection
    {
        return GameDenom::all();
    }

    public function getGameDenomById($id)
    {
        return GameDenom::find($id);
    }

    public function createGameDenom(array $data)
    {
        return GameDenom::create($data);
    }

    public function updateGameDenom($id, array $data)
    {
        $gameDenom = GameDenom::find($id);

        if ($gameDenom) {
            $gameDenom->update($data);
        }

        return $gameDenom;
    }

    public function deleteGameDenomById($id)
    {
        $gameDenom = GameDenom::find($id);

        if ($gameDenom) {
            $gameDenom->delete();
            return true;
        }

        return false;
    }
}
