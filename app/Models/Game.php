<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category',
        'unit',
    ];

    public function transaction()
    {
        return $this->hasMany(Transaction::class, 'game_id');
    }

    public function denom()
    {
        return $this->hasMany(GameDenom::class, 'game_id');
    }
}
