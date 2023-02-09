<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserUploadImages extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id', 'type', 'image_name', 'status'
    ];
}
