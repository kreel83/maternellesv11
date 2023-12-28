<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Events\WebhookReceived;
use Laravel\Cashier\Payment;
use Laravel\Cashier\Subscription;
use Illuminate\Support\Facades\Log;

/**
 * @mixin IdeHelperTransaction
 */
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
        'payment_method',
    ];

    public static function ajouterUneTransactionStripe(array $stripeObject)
    {
        switch($stripeObject['data']['object']['payment_method_details']['type']) {
            case 'card':
                $payment_method = 'carte bancaire';
                break;
            default:
                $payment_method = $stripeObject['data']['object']['payment_method_details']['type'];
        }
        $transaction = new Transaction;
        $transaction->txid = $stripeObject['data']['object']['id'];
        $transaction->amount = ($stripeObject['data']['object']['amount'] / 100);
        $transaction->customer = $stripeObject['data']['object']['customer'];
        $transaction->status = $stripeObject['data']['object']['status'];
        $transaction->payment_method = $payment_method;
        if(array_key_exists('method', $stripeObject['data']['object']['metadata'])) {
            // transaction par 'charge' simple pour licence côté admin - l'objet metadata est présent
            // pour un abonnement côté user, la transaction sera complété sur l'event invoice.payment_succeeded
            // qui contiendra l'objet metadata
            $transaction->user_id = $stripeObject['data']['object']['metadata']['user_id'];
            $transaction->produit_id = $stripeObject['data']['object']['metadata']['produit_id'];
            $transaction->method = $stripeObject['data']['object']['metadata']['method'];
            $transaction->price = $stripeObject['data']['object']['metadata']['price'];
            $transaction->quantity = $stripeObject['data']['object']['metadata']['quantity'];
        }
        $transaction->save();
        return $transaction;
    }

    /*
    public static function ajouterUneTransactionLicenceAdmin(array $stripeObject)
    {
        switch($stripeObject['data']['object']['payment_method_details']['type']) {
            case 'card':
                $payment_method = 'carte bancaire';
                break;
            default:
                $payment_method = $stripeObject['data']['object']['payment_method_details']['type'];
        }

        $transaction = Transaction::create([
            'user_id' => $stripeObject['data']['object']['metadata']['user_id'],
            'produit_id' => $stripeObject['data']['object']['metadata']['produit_id'],
            'txid' => $stripeObject['data']['object']['id'],
            'method' => $stripeObject['data']['object']['metadata']['method'],
            'price' => $stripeObject['data']['object']['metadata']['price'],
            'quantity' => $stripeObject['data']['object']['metadata']['quantity'],
            'amount' => ($stripeObject['data']['object']['amount'] / 100),
            'customer' => $stripeObject['data']['object']['customer'],
            'status' => $stripeObject['data']['object']['status'],
            'payment_method' => $payment_method,
        ]);
        return $transaction;
    }
    */

    /*
    public static function ajouterUneTransactionAbonnementUser(array $stripeObject)
    {
        $subscription = Subscription::where('stripe_id', $stripeObject['data']['object']['subscription'])->first();
        $transaction = Transaction::create([
            'user_id' => $stripeObject['data']['object']['subscription_details']['metadata']['user_id'],
            'produit_id' => $stripeObject['data']['object']['subscription_details']['metadata']['produit_id'],
            'subscription_id' => $subscription->id,
            'txid' => $stripeObject['data']['object']['id'],
            'method' => $stripeObject['data']['object']['subscription_details']['metadata']['method'],
            'price' => $stripeObject['data']['object']['subscription_details']['metadata']['price'],
            'quantity' => $stripeObject['data']['object']['subscription_details']['metadata']['quantity'],
            'amount' => ($stripeObject['data']['object']['amount_paid'] / 100),
            'customer' => $stripeObject['data']['object']['customer'],
            'status' => $stripeObject['data']['object']['status'],
        ]);
        return $transaction;
    }
    */

    public static function completerUneTransactionStripe(array $stripeObject)
    {
        $subscription = Subscription::where('stripe_id', $stripeObject['data']['object']['subscription'])->first();
        $transaction = Transaction::where('txid', $stripeObject['data']['object']['charge'])->first();
        if($transaction) {
            $transaction->subscription_id = $subscription->id;
            $transaction->user_id = $stripeObject['data']['object']['subscription_details']['metadata']['user_id'];
            $transaction->produit_id = $stripeObject['data']['object']['subscription_details']['metadata']['produit_id'];
            $transaction->method = $stripeObject['data']['object']['subscription_details']['metadata']['method'];
            $transaction->price = $stripeObject['data']['object']['subscription_details']['metadata']['price'];
            $transaction->quantity = $stripeObject['data']['object']['subscription_details']['metadata']['quantity'];
            $transaction->save();
            return $transaction;
        }
        return '0';
    }

}
