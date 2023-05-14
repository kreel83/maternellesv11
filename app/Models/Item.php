<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\utils\Utils;
use App\Events\ItemEvent;

class Item extends Model
{
    use HasFactory;

    protected $dispatchesEvents = [
        'retrieved' => ItemEvent::class,
    ];

    public function section() {
        return $this->hasMany('App\Models\Section','id','section_id')->first();
    }

    public function image() {
        return $this->belongsTo('App\Models\Image');
    }

    public function phrase($enfant) {
        return Utils::traitement($this->phrase, $enfant);
    }


}
