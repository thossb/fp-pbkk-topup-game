<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'payment_method',
        'payment_proof',
        'transaction_date',
        'user_id',
        'game_id',
    ];

    protected $table = 'transaction';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    // Define the relationships with the 'users' and 'games' tables if needed.
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id');
    }

    public function payment_history()
    {
        return $this->hasOne(PaymentHistory::class, 'transaction_id');
    }
}