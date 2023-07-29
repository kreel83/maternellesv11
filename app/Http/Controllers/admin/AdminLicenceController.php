<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\UserEmailVerificationFromAdmin;
use App\Models\Licence;
use App\Models\Produit;
use App\Models\Transaction;
use App\Models\User;
use App\utils\Utils;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Laravel\Cashier\Exceptions\IncompletePayment;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Subscription;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Validator;
use Laravel\Cashier\Exceptions\InvalidPaymentMethod;
use Laravel\Cashier\Payment;
use Stripe\Exception\CardException;
use Stripe\PaymentIntent;

class AdminLicenceController extends Controller
{
    
    /**
     * Affiche la liste des licences pour un Admin
     *
     * @return View
     */
    public function index(): View
    {
        $licences = Licence::listeDesLicencesPourUnAdmin();
        // Récupère le produit en vente en ce moment
        $product = Produit::produitEnCoursLicenceAdmin();
        /*
        // A VOIR : ne sert que si on veut des listes deroulantes de user dans le tableau des licences
        $users = User::select('id','name','prenom')
            ->where('ecole_id', Auth::user()->ecole_id)
            ->where('id','<>',Auth::id())
            ->whereNotIn('id', Licence::select('user_id')
                                    ->where('user_id','<>',null)
                                    ->where('parent_id',Auth::id())
                                    ->get()->toArray())
            ->get();
        */
        return view('admin.licence.index')
            //->with('users', $users)
            ->with('product', $product)
            ->with('licences', $licences);
    }

    /**
     * Affiche la page pour commander des licences utilisateur
     *
     * @return View
     */
    public function achat(): View
    {
        // Récupère le produit en vente en ce moment
        $product = Produit::produitEnCoursLicenceAdmin();
        $intent = auth()->user()->createSetupIntent();
        return view('admin.licence.achat')
            ->with('product', $product)
            ->with('method', 'purchase')
            ->with('title', "Achats de licences pour mon établissement")
            ->with('quantity', '1')
            ->with('routeCardForm', route('admin.licence.create'))
            ->with('intent', $intent)
            ->with('licenceSelection', array());
    }

    /**
     * Affiche la page pour renouveller des licences utilisateur
     *
     * @param Request $request
     * @return View
     */
    public function renew(Request $request): View
    {
        $request->validate([
            'licenceSelection' => ['required'],
        ], [
            'licenceSelection.required' => 'Merci de sélectionner au moins une licence',
        ]);

        // Récupère le produit en vente maintenant
        $product = Produit::produitEnCoursLicenceAdmin();
        $intent = auth()->user()->createSetupIntent();
        return view('admin.licence.achat')
            ->with('product', $product)
            ->with('method', 'renew')
            ->with('title', "Renouvellement de licences")
            ->with('quantity', count($request->licenceSelection))
            ->with('routeCardForm', route('admin.licence.create'))
            ->with('intent', $intent)
            ->with('licenceSelection', $request->licenceSelection);
    }


    /*
    private function getInternalName()
    {
        $name = uniqid();
        if ($this->internalNameExists($name)) {
            return $this->getInternalName();
        }
        return $name;
    }

    private function internalNameExists($name) {
        $existsInLicences = Licence::where('name', $name)->exists();
        $existsInSubscriptions = Subscription::where('name', $name)->exists();
        if($existsInLicences || $existsInSubscriptions) {
            return true;
        }
        return false;
    }
    */

    /**
     * Write code on Method
     *
     * @return view()
     */
    public function create(Request $request)
    {
        try {
            // récupération des éléments du produit actuel
            $product = Produit::find($request->product_id);
            // préparation de la facture
            $request->user()->invoicePrice($product->stripe_product_id, $request->quantity);
            // montant à charger * 100 pour envoyer à Stripe une valeur sans décimal
            $amount = ($request->quantity * $product->price) * 100;
            // on charge le client
            $stripeCharge = $request->user()->charge(
                $amount, $request->payment_method
            );
            // enregistrement de la transaction
            $transaction = Transaction::ajouterUneTransactionLicenceAdmin($request, $stripeCharge, $product);
            // création / renouvellement des licences
            $licence = new Licence;
            if($request->method == 'purchase') {
                $licence->createUserLicence($request, $transaction, $product);
            } elseif($request->method == 'renew') {
                $licence->renewUserLicence($request, $transaction, $product);
            }
            return view("admin.licence.result")
                ->with('result', 'success')
                ->with('request', $request);                
        } catch (CardException $exception) {
                $json = $exception->getJsonBody();
                $message = $json['error']['message'].' ('.$json['error']['type'].')';
                //dd($json['error']['message']);
            return view("admin.licence.result")
                ->with('result', $message)
                ->with('request', $request);
            /*
            return redirect()->route(
                'cashier.payment',
                [$exception->payment->id, 'redirect' => route('home')]  // A VOIR la route en cas d'echec de paiement
            );
            */
        }
    }

    /*
    // anciennement utilisé si achat de licence par souscription stripe
    public function create(Request $request)
    {
        
        foreach (json_decode($request->licenceSelection) as $licence_id)
        {
            //$licence = new Licence;
            $licence = Licence::find($licence_id);
            $newExpirationDate = $licence->expires_at;
            dd($licence);
            //$licence->stripe_id = $stripe_id;
            //$licence->actif = 1;
            //$licence->expires_at = $expires_at; // avoir si on ajoute +1 an a la date actuelle

        }
        
        try {
            $internal_name = $this->getInternalName();
            $subscription = $request->user()->newSubscription($internal_name, 'price_1NEXRRF73qwd826kHYATzqgl')
                ->quantity($request->quantity)
                ->create($request->token);
            $expires_at = Auth::user()->subscription($internal_name)->asStripeSubscription()->current_period_end;
            $licence = new Licence;
            if($request->method == 'buy') {
                $licence->createUserLicence($request->quantity, $subscription->stripe_id, $expires_at);
            } elseif($request->method == 'renew') {
                $licence->renewUserLicence($request->quantity, $subscription->stripe_id, $expires_at, $request->licenceSelection);
            }
            return view("admin.subscription.result");
        } catch (IncompletePayment $exception) {
            return redirect()->route(
                'cashier.payment',
                [$exception->payment->id, 'redirect' => route('home')]  // A VOIR la route en cas d'echec de paiement
            );
        }
    }
    */

    public function assign(Request $request)
    {
        // verifier si compte user existe deja ! (OK)
        // verifier si pas deja une licence pour ce user !
        // verfifier validité de l'email
        // verifier si email a pas de . (OK)
        $email = filter_var($request->email, FILTER_SANITIZE_EMAIL);
        $is_email = filter_var($email, FILTER_VALIDATE_EMAIL);
        if($is_email) {
            $user = User::where('email', $email)->first();
            //$status = (is_null($user)) ? 'attente' : 'active';
            if(!$user) {
                // compte utilisateur inexistant, on le crée + envoi d'un email pour vérification
                // pré-remplissage nom + prénom d'après l'adresse email
                $prenomNom = Utils::getNameFromEmail($email);
                $validationKey = md5(microtime(TRUE)*100000);
                $user = User::create([
                    'prenom' => $prenomNom['prenom'],
                    'name' => $prenomNom['nom'],
                    'email' => $email,
                    'ecole_id' => Auth::user()->ecole_id,
                    'validation_key' => $validationKey,
                    'licence' => 'admin'
                ]);
                // Envoi d'un email de vérification
                $token = md5($user->id.$request->licence_id.$validationKey.env('HASH_SECRET'));
                $url = route('user.valideUserFromAdminCreatePassword').'?'.'uID='.$user->id.'&lID='.$request->licence_id.'&key='.$validationKey.'&token='.$token;
                Mail::to($email)->send(new UserEmailVerificationFromAdmin($url));
            }
            $licence = new Licence;
            if($licence->assignLicenceToUser($request, $user->id)){
                return json_encode([
                    'result' => '1',
                    'msg' => 'Licence assignée !'
                ]);
            } else {
                return json_encode([
                    'result' => '0',
                    'msg' => 'Une licence est déjà active pour cet utilisateur !'
                ]);
            }
            //$licence->assignLicenceToUser($request, $newUser->id, $status);
            
        } else {
            return json_encode([
                'result' => '0',
                'msg' => 'Adresse email incorrecte !'
            ]);
        }  
    }

    public function remove($id)
    {
        $licence = new Licence;
        $licence->removeLicenceToUser($id);
        return redirect()->route('admin.licence.index');
    }

    /**
     * Retourne la vue avec la liste des factures de l'admin
     *
     * @return View
     */
    public function invoice(): View
    {
        $invoices = Auth::user()->invoices();
        return view("admin.invoice")
            ->with('invoices', $invoices);
    }
    
}