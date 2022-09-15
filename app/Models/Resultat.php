<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resultat extends Model
{
    use HasFactory;


    public function notation() {
        return $this->hasone('App\models\Notation','id','notation_id')->first();
    }

    public function item() {
        return $this->hasOne('App\Models\Item','id','item_id')->first();
    }
}
