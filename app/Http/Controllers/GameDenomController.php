<?php

namespace App\Http\Controllers;

use App\Models\GameDenom;
use Illuminate\Http\Request;

class GameDenomController extends Controller
{
    public function index()
    {
        $games = GameDenom::all();
    }

    public function show($id)
    {
    }
}
