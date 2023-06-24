<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\UserEmailVerificationFromAdmin;
use App\Models\Licence;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Laravel\Cashier\Exceptions\IncompletePayment;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Subscription;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;

class AdminLicenceController extends Controller
{
    
    /**
     * Load licences list view.
     */
    public function index():View
    {
        $licences = Licence::select(
            'licences.status', 'licences.id', 'licences.user_id', 'licences.created_at', 'licences.expires_at',
            'licences.name as internal_name', 'users.name', 'users.prenom'
        )
        ->where("licences.parent_id", Auth::id())
        ->leftjoin("users", "users.id", "=", "licences.user_id")
        ->orderByDesc('licences.id')->get();
        $users = User::select('id','name','prenom')
            ->where('ecole_id', Auth::user()->ecole_id)
            ->where('id','<>',Auth::id())
            ->whereNotIn('id', Licence::select('user_id')
                                    ->where('user_id','<>',null)
                                    ->where('parent_id',Auth::id())
                                    ->get()->toArray())
            ->get();
        return view('admin.subscription.index')
            ->with('users', $users)
            ->with('licences', $licences);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function achat()
    {
        $intent = auth()->user()->createSetupIntent();
        return view('admin.subscription.achat')
            ->with('title', "Achats de licences pour mon établissement")
            ->with('price', '9.90')
            ->with('routeCardForm', route('admin.licence.create'))
            ->with('intent', $intent)
            ->with('multiple', true);   // achat de plusieurs licences : oui
        //return view('admin.licence.achat', compact("intent"));
        //return view('subscription.cardform', compact("intent"));
    }

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

    /**
     * Write code on Method
     *
     * @return view()
     */
    public function create(Request $request)
    {
        try {
            $internal_name = $this->getInternalName();
            $subscription = $request->user()->newSubscription($internal_name, 'price_1NEXRRF73qwd826kHYATzqgl')
                ->quantity($request->quantity)
                ->create($request->token);
            $expires_at = Auth::user()->subscription($internal_name)->asStripeSubscription()->current_period_end;
            $licence = new Licence;
            $licence->createUserLicence($request->quantity, $subscription->stripe_id, $expires_at);
            return view("admin.subscription.result");
        } catch (IncompletePayment $exception) {
            return redirect()->route(
                'cashier.payment',
                [$exception->payment->id, 'redirect' => route('home')]  // A VOIR la route en cas d'echec de paiement
            );
        }
    }

    public function assign(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $status = (is_null($user)) ? 'attente' : 'active';
        if(is_null($user)) {
            // compte utilisateur inexsitant, on le crée + envoi d'un email avec password provisoire
            //$password = '1234'; //uniqid();
            // pré-remplissage nom + prénom d'après l'adresse email
            $tmp = explode('@', $request->email);
            $prenomNom = explode('.', $tmp[0]);
            $validationKey = md5(microtime(TRUE)*100000);
            $user = User::create([
                'prenom' => $prenomNom[0],
                'name' => $prenomNom[1],
                'email' => $request->email,
                'validation_key' => $validationKey,
                'licence' => 'admin'
                //'password' => Hash::make($password),
            ]);
            // Envoi d'un email de vérification
            $token = md5($user->id.$request->licence_id.$validationKey.env('HASH_SECRET'));
            $url = route('user.valideUserFromAdminCreatePassword').'?'.'uID='.$user->id.'&lID='.$request->licence_id.'&key='.$validationKey.'&token='.$token;
            Mail::mailer('sendmail')->to($request->email)->send(new UserEmailVerificationFromAdmin($url));
        }
        $licence = new Licence;
        $licence->assignLicenceToUser($request, $user->id, $status);
        
    }

    public function remove($id)
    {
        $licence = new Licence;
        $licence->removeLicenceToUser($id);
        return redirect()->route('admin.licence.index');
    }

    public function invoice(): View
    {
        return view('admin.licence.invoice');
    }
    
}