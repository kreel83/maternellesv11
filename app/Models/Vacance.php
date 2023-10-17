<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacance extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'ecole_code_academie',
        'description',
        'start_date',
        'end_date',
        'location',
        'zones',
        'annee_scolaire',
    ];


}
