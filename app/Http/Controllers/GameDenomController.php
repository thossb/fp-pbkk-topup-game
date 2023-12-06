<?php

namespace App\Http\Controllers;

// use App\Models\GameDenom;
use Illuminate\Http\Request;
use App\Http\Service\GameDenomService;

// class GameDenomController extends Controller
// {
//     public function index()
//     {
//         $games = GameDenom::all();
//     }

//     public function show($id)
//     {
//     }

//     public function addDenom(Request $request)
//     {
//         $validated = $request->validate([
//             'denom' => 'required|string|max:20',
//             'price' => 'required|integer',
//             'game_id' => 'required|exists:games,id',
//         ]);

//         $gameDenom = GameDenom::create($validated);

//         return response()->json(['message' => 'Game denom added successfully', 'data' => $gameDenom], 201);
//     }

//     public function getDenomList()
//     {
//         $denoms = GameDenom::all();

//         return response()->json(['data' => $denoms]);
//     }

//     public function updateGameDenom(Request $request, $id)
//     {
//         $validated = $request->validate([
//             'denom' => 'required|string|max:20',
//             'price' => 'required|integer',
//             'game_id' => 'required|exists:games,id',
//         ]);

//         $gameDenom = GameDenom::find($id);

//         if (!$gameDenom) {
//             return response()->json(['message' => 'Game denom not found'], 404);
//         }

//         $gameDenom->update($validated);

//         return response()->json(['message' => 'Game denom updated successfully', 'data' => $gameDenom]);
//     }

//     public function deleteGameDenom($id)
//     {
//         $gameDenom = GameDenom::find($id);

//         if (!$gameDenom) {
//             return response()->json(['message' => 'Game denom not found'], 404);
//         }

//         $gameDenom->delete();

//         return response()->json(['message' => 'Game denom deleted successfully']);
//     }
// }

class GameDenomController extends Controller
{
    protected $gameDenomService;

    public function __construct(GameDenomService $gameDenomService)
    {
        $this->gameDenomService = $gameDenomService;
    }

    public function index()
    {
        $denoms = $this->gameDenomService->getAllGameDenoms();

        return response()->json(['data' => $denoms]);
    }

    public function show($id)
    {
        $gameDenom = $this->gameDenomService->getGameDenomById($id);

        if (!$gameDenom) {
            return response()->json(['message' => 'Game denom not found'], 404);
        }

        return response()->json(['data' => $gameDenom]);
    }

    public function addDenom(Request $request)
    {
        $validated = $request->validate([
            'denom' => 'required|string|max:20',
            'price' => 'required|integer',
            'game_id' => 'required|exists:games,id',
        ]);

        $gameDenom = $this->gameDenomService->createGameDenom($validated);

        return response()->json(['message' => 'Game denom added successfully', 'data' => $gameDenom], 201);
    }

    public function getDenomList()
    {
        $denoms = $this->gameDenomService->getAllGameDenoms();

        return response()->json(['data' => $denoms]);
    }

    public function updateGameDenom(Request $request, $id)
    {
        $validated = $request->validate([
            'denom' => 'required|string|max:20',
            'price' => 'required|integer',
            'game_id' => 'required|exists:games,id',
        ]);

        $gameDenom = $this->gameDenomService->updateGameDenom($id, $validated);

        if (!$gameDenom) {
            return response()->json(['message' => 'Game denom not found'], 404);
        }

        return response()->json(['message' => 'Game denom updated successfully', 'data' => $gameDenom]);
    }

    public function deleteGameDenom($id)
    {
        $result = $this->gameDenomService->deleteGameDenomById($id);

        if (!$result) {
            return response()->json(['message' => 'Game denom not found'], 404);
        }

        return response()->json(['message' => 'Game denom deleted successfully']);
    }
}