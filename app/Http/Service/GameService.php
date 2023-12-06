<?php

// App/Http/Service/GameService.php

namespace App\Http\Service;

use App\Http\Repository\GameRepository;
use Illuminate\Http\Request;

class GameService
{
    protected $gameRepository;

    public function __construct(GameRepository $gameRepository)
    {
        $this->gameRepository = $gameRepository;
    }

    public function getAllGames()
    {
        return $this->gameRepository->getAllGames();
    }

    public function getPaginatedGames($perPage)
    {
        return $this->gameRepository->getPaginatedGames($perPage);
    }

    public function getGameById($id)
    {
        return $this->gameRepository->getGameById($id);
    }

    public function addGame(Request $request)
    {
        // Validation and other business logic can be added here
        return $this->gameRepository->addGame($request);
    }

    public function updateGame(Request $request, $id)
    {
        // Validation and other business logic can be added here
        return $this->gameRepository->updateGame($request, $id);
    }

    public function deleteGame($id)
    {
        return $this->gameRepository->deleteGame($id);
    }
}
