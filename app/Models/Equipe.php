<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipe extends Model
{
    use HasFactory;

    protected $dispatchesEvents = [
        'retrieved' => \App\Events\EquipeEvent::class,
    ];

    public $photoEquipe;

    const FONCTIONS = ['Aide maternelle (ATSEM)','AESH'];

    public function fonction() {
        return self::FONCTIONS[$this->fonction];
    }
}
