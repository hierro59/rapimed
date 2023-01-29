<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScoreCustomer extends Model
{
    use HasFactory;

    protected $fillable = [
        'cita_id',
        'customer_id',
        'specialist_id',
        'score',
        'commit',
        'status'
    ];
}
