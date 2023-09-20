<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalToken extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'companie_id',
        'user_id',
        'token',
        'status'
    ];

    protected $table = 'personal_tokens';
}
