<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Myperiode extends Model
{
    use HasFactory;



    protected $casts = [
        'date_start' => 'datetime:d/m/Y',
        'date_end' => 'datetime:d/m/Y',
    ];


}
