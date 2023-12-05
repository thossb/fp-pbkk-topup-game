<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'type',
        'read_status',
        'redirect_url',
        'user_id',
    ];
}
