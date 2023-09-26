<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactureLigne extends Model
{
    use HasFactory;

    protected $dispatchesEvents = [
        'retrieved' => \App\Events\FactureLigneEvent::class,
    ];

    public $price_tax_excl, $tax_amount;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'facture_id',
        'produit_id',
        'quantity',
        'price',
    ];

}
