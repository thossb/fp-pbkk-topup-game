<?php

// App/Http/Service/GameDenomService.php

namespace App\Http\Service;

use App\Http\Repository\GameDenomRepository;
use Illuminate\Support\Collection;

class GameDenomService
{
    protected $gameDenomRepository;

    public function __construct(GameDenomRepository $gameDenomRepository)
    {
        $this->gameDenomRepository = $gameDenomRepository;
    }

    public function getAllGameDenoms(): Collection
    {
        return $this->gameDenomRepository->getAllGameDenoms();
    }

    public function getGameDenomById($id)
    {
        return $this->gameDenomRepository->getGameDenomById($id);
    }

    public function createGameDenom(array $data)
    {
        return $this->gameDenomRepository->createGameDenom($data);
    }

    public function updateGameDenom($id, array $data)
    {
        return $this->gameDenomRepository->updateGameDenom($id, $data);
    }

    public function deleteGameDenomById($id)
    {
        return $this->gameDenomRepository->deleteGameDenomById($id);
    }
}
