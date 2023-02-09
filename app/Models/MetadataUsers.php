<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetadataUsers extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id', 'medical_history', 'address', 'city', 'state', 'country', 'phone', 'sex', 'status'
    ];
}
