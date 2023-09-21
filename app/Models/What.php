<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class What extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'message',
        'type'
    ];

    protected $table = 'whats';

}
