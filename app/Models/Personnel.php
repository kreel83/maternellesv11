<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\utils\Utils;

class Personnel extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function phrase($enfant) {
        return Utils::traitement($this->phrase, $enfant);
    }
    public function section() {
        return $this->hasMany('App\Models\Section','id','section_id')->first();
    }

}
