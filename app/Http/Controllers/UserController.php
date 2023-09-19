<?php

namespace App\Http\Controllers;

use App\Models\Licence;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{

    public function deco(Request $request) : RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
        //return redirect()->route('enfants');
    }

    /**
     * Validate a User with a link in an email
     *
     * @return \Illuminate\View\View
     */
    public function valideUserFromAdminCreatePassword(Request $request): View
    {
        // appelé depuis lien dans email envoyé par admin en assignant une licence
        // la vue permet la création du mot de passe par l'utilisateur
        $token = md5($request->uID.$request->lID.$request->key.env('HASH_SECRET'));
        if($token != $request->token) {
            $user = null;
        } else {
            $user = User::where([
                ['id', $request->uID],
                ['validation_key' , $request->key]
                ])->first();
        }
        return view("registration.validation")
            ->with('user', $user)
            ->with('licence_id', $request->lID);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function valideUserFromAdminSavePassword(Request $request)
    {
        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'password.required' => 'Mot de passe obligatoire.',
            'password.confirmed' => 'La confirmation du mot de passe a échouée.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
        ]);

        $user = User::find($request->uID);
        if(!is_null($user)) {
            $user->password = Hash::make($request->password);
            $user->actif = 1;
            $user->save();
            // si on a un ID de licence on met le statut a ' active '
            if(isset($request->lID)) {
                $licence = Licence::find($request->lID);
                $licence->status = 'active';
                $licence->save();
            }
        }
        //Auth::login($user);
        //return redirect(RouteServiceProvider::HOME);
        //return redirect()->route('login');

        return view("registration.validation_self")
            ->with('user', $user);
    }

    /**
     * Validate a self registration User with a link in an email
     *
     * @return \Illuminate\View\View
     */
    public function validUserFromSelfRegistration(Request $request): View
    {
        // appelé depuis lien dans email envoyé quand un utilisateur s'enregistre par lui même
        $token = md5($request->uID.$request->key.env('HASH_SECRET'));
        if($token != $request->token) {
            $user = null;
        } else {
            $user = User::where([
                ['id', $request->uID],
                ['validation_key' , $request->key]
                ])->first();
            if(!is_null($user)) {
                $user->actif = 1;
                $user->save();
                // Auth::login($user);  // A VOIR si on log automatiquement à la validation
            }
        }
        return view("registration.validation_self")
            ->with('user', $user);
    }

    /**
     * Delete innactive users
     *
     * @return \Illuminate\View\Void
     */
    public function deleteInactiveUser(): void
    {
        $enddate = Carbon::now()->subMinutes(30)->toDateTimeString();
        //dd($enddate);
        $deleted = User::where('actif', 0)
            ->where('created_at', '<=', $enddate)
            ->where('password', '<>', '')   // pour ne pas supprimer les Users crées depuis admin/licence
            ->get();
        dd($deleted);
    }

    public function contact(): View
    {
        return view('contact.user')
            ->with('route', route('contact'));
    }
    
    /**
     * Montre/Cache les sous-menus du menu Abonnement
     * Utilisé dans AuthenticatedSessionController::store
     * @return void
     */
    public static function setMenuAbonnement(Request $request) {
        $user = AUTH::user();
        if ($request->session()->exists('menuAbonnement')) {
            $request->session()->forget('menuAbonnement');
        }
        $invoices = $user->invoices();
        switch($user->licence) {
            case 'admin':
                // Vérifie si une licence est accordée par l'école
                $licence = Licence::where([
                    ['user_id', $user->id],
                    ['actif', 1],
                ])->first();
                if($licence) {
                    session(['isAuthenticated' => true]);
                    $abonnement = true;
                } else {
                    $abonnement = false;
                }
                session(['menuAbonnement' => [
                    'abonnement' => $abonnement, 
                    'resiliationSubMenu' => false,
                    'resumeSubMenu' => false,
                    'invoice' => $invoices->isNotEmpty()
                ]]);
                break;
            case 'self':
                // Vérifie si une licence est prise individuellement
                $onGracePeriode = Auth::user()->subscription('default')->onGracePeriod();
                $cancelled = Auth::user()->subscription('default')->canceled();
                if (Auth::user()->subscribed('default')) {
                    session(['isAuthenticated' => true]);
                    session(['menuAbonnement' => [
                        'abonnement' => true, 
                        'resiliationSubMenu' => !$onGracePeriode,
                        'resumeSubMenu' => $cancelled && $onGracePeriode,
                        'invoice' => $invoices->isNotEmpty()
                    ]]);
                } else {
                    session(['menuAbonnement' => [
                        'abonnement' => false, 
                        'resiliationSubMenu' => false,
                        'resumeSubMenu' => false,
                        'invoice' => $invoices->isNotEmpty()
                    ]]);
                }
                break;
            default:
                session(['menuAbonnement' => [
                    'abonnement' => false, 
                    'resiliationSubMenu' => false,
                    'resumeSubMenu' => false,
                    'invoice' => $invoices->isNotEmpty()
                ]]);
        }
    }

}
