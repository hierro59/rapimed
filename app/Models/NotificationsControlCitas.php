<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationsControlCitas extends Model
{
    use HasFactory;

    protected $fillable = [
        'ncc_cita_id',
        'ncc_menos_diez',
        'ncc_menos_cinco',
        'ncc_menos_un_dia',
        'ncc_inicio'
    ];
}
