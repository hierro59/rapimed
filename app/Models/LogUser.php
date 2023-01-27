<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_log',
        'user_id',
        'activity',
        'details'
    ];
}
