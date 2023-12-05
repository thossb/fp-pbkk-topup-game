<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'server',
        'phone_number',
        'payment_method',
        'payment_proof',
        'status',
        'denom_id',
        'game_id',
        'user_id'
    ];

    // Define the relationships with the 'users' and 'games' tables if needed.
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function denom()
    {
        return $this->belongsTo(GameDenom::class, 'denom_id');
    }

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id');
    }
}
