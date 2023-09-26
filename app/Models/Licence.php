<?php

namespace App\Models;

use App\Models\Subscription as ModelsSubscription;
use App\utils\Utils;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Cashier\Subscription;

class Licence extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'parent_id',
        'produit_id',
        'expires_at',
        'name',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    /**
     * Revoi un nom aléatoire unique pour une licence / souscription. Associé à la fonction internalNameExists()
     * 
     * @return string $name
     */
    private function getInternalName()
    {
        $name = uniqid();
        if ($this->internalNameExists($name)) {
            return $this->getInternalName();
        }
        return $name;
    }

    /**
     * Vérifie que le nom en paramètre soit unique dans les licences / souscriptions. Associé à la fonction getInternalName()
     * 
     * @param string $name
     * @return bool
     */
    private function internalNameExists($name) {
        $existsInLicences = Licence::where('name', $name)->exists();
        $existsInSubscriptions = Subscription::where('name', $name)->exists();
        if($existsInLicences || $existsInSubscriptions) {
            return true;
        }
        return false;
    }

    /**
     * Crée les licences pour les utilisateurs après un paiement réussi de l'Admin
     *
     * @param array $stripeObject
     * @param $transaction
     * @return void
     */
    public function createUserLicence(array $stripeObject, $transaction): void
    {
        for($i = 0; $i < $stripeObject['data']['object']['metadata']['quantity']; $i++) {
            $licence = Licence::create([
                'parent_id' => $stripeObject['data']['object']['metadata']['user_id'],
                'produit_id' => $stripeObject['data']['object']['metadata']['produit_id'],
                'name' => $this->getInternalName(),
                'expires_at' => $stripeObject['data']['object']['metadata']['expires_at'],
            ]);
            // enregistrement dans la table relation transaction/licence
            TransactionLicence::create([
                'transaction_id' => $transaction->id,
                'licence_id' => $licence->id,
            ]);
        }
    }
    /*
    public function createUserLicence(Request $request, Transaction $transaction, Produit $product)
    {
        for($i = 0; $i < $request->quantity; $i++) {
            $licence = Licence::create([
                'parent_id' => Auth::id(),
                'produit_id' => $product->id,
                'name' => $this->getInternalName(),
                'expires_at' => $product->active_to,
            ]);
            // enregistrement dans la table relation transaction/licence
            TransactionLicence::create([
                'transaction_id' => $transaction->id,
                'licence_id' => $licence->id,
            ]);
        }
    }
    */

    /**
     * Renouvelle les licences pour les utilisateurs après un paiement réussi de l'Admin
     *
     * @param array $stripeObject
     * @param $transaction
     * @return void
     */
    public function renewUserLicence(array $stripeObject, $transaction): void
    {
        foreach (json_decode($stripeObject['data']['object']['metadata']['licenceSelection']) as $licence_id)
        {
            $licence = Licence::find($licence_id);
            $licence->produit_id = $stripeObject['data']['object']['metadata']['produit_id'];
            $licence->actif = 1;
            $licence->expires_at = $stripeObject['data']['object']['metadata']['expires_at'];
            $licence->save();
            // enregistrement dans la table relation transaction/licence
            TransactionLicence::create([
                'transaction_id' => $transaction->id,
                'licence_id' => $licence->id,
            ]);
        }
    }
    /*
    public function renewUserLicence(Request $request, Transaction $transaction, Produit $product)
    {
        foreach (json_decode($request->licenceSelection) as $licence_id)
        {
            $licence = Licence::find($licence_id);
            $licence->transaction_id = $transaction->id;
            $licence->produit_id = $product->id;
            $licence->actif = 1;
            $licence->expires_at = $product->active_to;
            $licence->save();
            // enregistrement dans la table relation transaction/licence
            TransactionLicence::create([
                'transaction_id' => $transaction->id,
                'licence_id' => $licence->id,
            ]);
        }
    }
    */

    /*
    public function createUserLicence($quantity, $stripe_id, $expires_at)
    {
        for($i = 0; $i < $quantity; $i++) {
            Licence::create([
                'parent_id' => Auth::id(),
                'stripe_id' => $stripe_id,
                'name' => $this->getInternalName(),
                'expires_at' => $expires_at
            ]);
        }
    }

    public function renewUserLicence($quantity, $stripe_id, $expires_at, $licenceSelection)
    {
        foreach (json_decode($licenceSelection) as $licence_id)
        {
            $licence = Licence::find($licence_id);
            $licence->stripe_id = $stripe_id;
            $licence->actif = 1;
            $licence->expires_at = $expires_at; // avoir si on ajoute +1 an a la date actuelle
            $licence->save();
        }
    }
    */

    /**
     * Assigne une licence pour un utilisateur
     *
     * @param Request $request
     * @param int $user_id
     * @return bool
     */
    public function assignLicenceToUser(Request $request, $user_id)
    {
        // on regarde si une licence existe deja pour cet utilisateur :
        // 1. dans licences :
        $licenceFromAdmin = Licence::where('user_id', $user_id)
                                    ->where('parent_id', Auth::id())
                                    ->where('actif', 1)
                                    ->first();
        //Log::debug($licenceFromAdmin);
        // 2. dans subscriptions
        $licenceFromSelf = ModelsSubscription::where('user_id', $user_id)
                                            ->where('stripe_status', 'active')
                                            ->first();
        //Log::debug($licenceFromSelf);
        
        if(!$licenceFromAdmin && !$licenceFromSelf) {
            // pas de licence en cours trouvée pour le user, on assigne la licence
            Licence::where('id', $request->licence_id)
                ->where('parent_id', Auth::id())
                ->update(['user_id' => $user_id]);
            return true;
        }

        return false;

    }

    /*
    public function assignLicenceToUser($request, $user_id, $status)
    {        
        Licence::where('id', $request->licence_id)
               ->where('parent_id', Auth::id())
               ->update([
                    'user_id' => $user_id,
                ]);
    }
    */

    /**
     * Détache un utilisateur de sa licence
     *
     * @param [type] $id
     * @return void
     */
    public function removeLicenceToUser($id)
    {
        // get the license
        $licence = Licence::where('id', $id)->where('parent_id', Auth::id())->first();
        if($licence) {
            // met le champ licence a null dans users
            User::where('id', $licence->user_id)->update(['licence' => null]);
            // met le champ user_id a null dans licences
            $licence->user_id = null;
            $licence->save();
        }
    }

    /**
     * Renvoi une licence pour un utilisateur
     *
     * @param [type] $user_id
     * @return void
     */
    public function getLicenceByUserId($user_id)
    {
        Licence::where('user_id', $user_id)
               ->where('parent_id', Auth::id())
               ->first();
    }

    /**
     * Renvoi la liste des licences pour un Admin
     *
     * @return void
     */
    public static function listeDesLicencesPourUnAdmin()
    {
        $licences = Licence::select(
            'licences.produit_id', 'licences.actif', 'licences.id', 'licences.user_id', 'licences.created_at', 
            'licences.expires_at', 'licences.name as internal_name', 'users.name', 'users.prenom'
        )
        ->where("licences.parent_id", Auth::id())
        ->leftjoin("users", "users.id", "=", "licences.user_id")
        ->orderByDesc('licences.id')->get();
        return $licences;
    }
}
