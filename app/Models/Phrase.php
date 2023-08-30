<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phrase extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function commentaire() {
        return Commentaire::find($this->commentaire_id);

        return $this->hasOne('App\Models\Commentaire');
    }
}
