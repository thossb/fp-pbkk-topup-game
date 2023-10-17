<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_status',
        'user_id',
        'transaction_id',
    ];

    protected $table = 'payment_history';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;

    // Define relationships with the 'users' and 'transactions' tables if needed.
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }
}
