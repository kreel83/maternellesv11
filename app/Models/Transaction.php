<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Payment;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'produit_id',
        'subscription_id',
        'txid',
        'method',
        'price',
        'quantity',
        'amount',
        'customer',
        'status',
    ];

    /**
     * Enregistre la transaction bancaire pour l'achat de licences Admin
     *
     * @param Request $request
     * @param Payment $stripeCharge
     * @param Produit $product
     * @return Transaction
     */
    public static function ajouterUneTransactionLicenceAdmin(Request $request, Payment $stripeCharge, Produit $product)
    {
        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'produit_id' => $product->id,
            'txid' => $stripeCharge->id,
            'method' => $request->method,
            'price' => $product->price,
            'quantity' => $request->quantity,
            'amount' => ($stripeCharge->amount / 100),
            'customer' => $stripeCharge->customer,
            'status' => $stripeCharge->status,
        ]);
        return $transaction;
    }

    /**
     * Enregistre la transaction bancaire pour l'achat d'un abonnement User
     *
     * @param Request $request
     * @param [type] $subscription
     * @param Produit $product
     * @return void
     */
    public static function ajouterUneTransactionAbonnementUser(Request $request, $subscription, Produit $product)
    {
        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'produit_id' => $product->id,
            'subscription_id' => $subscription->id,
            'txid' => $subscription->stripe_id,
            'method' => 'subscription',
            'price' => $product->price,
            'quantity' => 1,
            'amount' => $product->price,
            'customer' => Auth::user()->stripe_id,
            'status' => $subscription->stripe_status,
        ]);
        return $transaction;
    }

}
