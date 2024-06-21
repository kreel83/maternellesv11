<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CahiersSynthese extends Model
{
    use HasFactory;

    protected $casts = [
        'observations' => 'array',
    ];
}
