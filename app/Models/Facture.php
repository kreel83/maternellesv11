<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperFacture
 */
class Facture extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'transaction_id',
        'number',
        'amount',
    ];

    private static function genereNumeroDeFacture() {
        $number = Facture::max('number') + 1;
        if($number < config('app.custom.start_invoice_number')) {
            $number = config('app.custom.start_invoice_number');
        }
        return $number;
    }

    public static function creerUneFacture(array $data)
    {
        $facture = Facture::create([
            'user_id' => $data['user_id'],
            'transaction_id' => $data['transaction_id'],
            'number' => self::genereNumeroDeFacture(),
            'amount' => $data['amount'],
        ]);
        FactureLigne::create([
            'facture_id' => $facture->id,
            'produit_id' => $data['produit_id'],
            'quantity' => $data['quantity'],
            'price' => $data['price'],
        ]);
        return $facture;
    }

}
