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
        'price',
        'category',
    ];

    protected $table = 'game';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    protected $casts = [
        'price' => 'decimal:2', // To ensure the 'price' attribute is a decimal with 2 decimal places.
    ];

    public function transaction()
    {
        return $this->hasMany(Transaction::class, 'game_id');
    }
}
