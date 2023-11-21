<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameDenom extends Model
{
    use HasFactory;

    protected $fillable = [
        'denom',
        'price',
        'game_id',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id');
    }
}
