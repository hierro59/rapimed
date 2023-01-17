<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citas extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'specialist_id', 'fecha_cita', 'hora_cita', 'tipo', 'score', 'status'
    ];
}
