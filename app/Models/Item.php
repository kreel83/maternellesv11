<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public function section() {
        return $this->hasMany('App\Models\Section','id','section_id')->first();
    }
}
