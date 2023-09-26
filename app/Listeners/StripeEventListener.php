<?php

namespace App\Listeners;

use App\Http\Controllers\UserController;
use App\Models\Facture;
use App\Models\Licence;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Cashier\Events\WebhookReceived;

class StripeEventListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /* 
    // webhooks a activer dans Stripe pour que cashier fonctionne correctement :
    customer.subscription.created
    customer.subscription.updated
    customer.subscription.deleted
    customer.updated
    customer.deleted
    payment_method.automatically_updated
    invoice.payment_action_required
    invoice.payment_succeeded
    */

    /**
     * Handle received Stripe webhooks.
     *
     * @param WebhookReceived $event
     * @return void
     */
    public function handle(WebhookReceived $event): void
    {
        if ($event->payload['type'] === 'charge.succeeded') {
            Log::info($event->payload);
            $transaction = Transaction::ajouterUneTransactionStripe($event->payload);
            if(array_key_exists('method', $event->payload['data']['object']['metadata'])) {
                $method = $event->payload['data']['object']['metadata']['method'];
                if($method == 'purchase' || $method == 'renew') {
                    switch ($method) {
                        case 'purchase':
                            $licence = new Licence();
                            $licence->createUserLicence($event->payload, $transaction);
                            break;
                        case 'renew':
                            $licence = new Licence();
                            $licence->renewUserLicence($event->payload, $transaction);
                            break;
                    }
                    $factureData = array(
                        'user_id' => $event->payload['data']['object']['metadata']['user_id'],
                        'transaction_id' => $transaction->id,
                        'produit_id' => $event->payload['data']['object']['metadata']['produit_id'],
                        'amount' => ($event->payload['data']['object']['amount'] / 100),
                        'price' => $event->payload['data']['object']['metadata']['price'],
                        'quantity' => $event->payload['data']['object']['metadata']['quantity'],
                    );
                    Facture::creerUneFacture($factureData);
                }
            }
        }

        // paiement d'un abonnement. on prend le dernier évènement en référence
        if ($event->payload['type'] === 'invoice.payment_succeeded') {
            Log::info($event->payload);
            switch ($event->payload['data']['object']['billing_reason']) {
                case 'subscription_create':
                    // on complete la transaction précédemment crée dans l'event charge.succeeded
                    $transaction = Transaction::completerUneTransactionStripe($event->payload);
                    // création de la facture
                    $factureData = array(
                        'user_id' => $event->payload['data']['object']['subscription_details']['metadata']['user_id'],
                        'transaction_id' => $transaction->id,
                        'produit_id' => $event->payload['data']['object']['subscription_details']['metadata']['produit_id'],
                        'amount' => ($event->payload['data']['object']['amount_paid'] / 100),
                        'price' => $event->payload['data']['object']['subscription_details']['metadata']['price'],
                        'quantity' => $event->payload['data']['object']['subscription_details']['metadata']['quantity'],
                    );
                    Facture::creerUneFacture($factureData);
                    // mise a jour du type de licence dans Users
                    User::where('id', $event->payload['data']['object']['subscription_details']['metadata']['user_id'])->update(['licence' => 'self']);
                    break;
                default:
                    Log::error($event->payload);
                    break;
            }
        }
    }

}
