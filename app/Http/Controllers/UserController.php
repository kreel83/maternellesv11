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
     * Valide le compte d'un user depuis un lien envoyé par mail par l'admin
     * La vue permet la création du mot de passe par l'utilisateur
     * @return \Illuminate\View\View
     */
    public function valideUserFromAdminCreatePassword(Request $request): View
    {
        $user = User::where('validation_key', $request->token)->first();
        return view("registration.validation")
            ->with('token', $request->token)
            ->with('user', $user);
    }

    public function valideUserFromReminderEmail(Request $request): View
    {
        $user = User::where('validation_key', $request->token)->first();
        if($user) {
            $user->actif = 1;
            $user->save();
        }
        return view("registration.validation_self")
            ->with('user', $user);
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

        $user = User::where('validation_key', $request->token)->first();
        if($user) {
            $user->password = Hash::make($request->password);
            $user->actif = 1;
            $user->save();
        }
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
            ->with('route', route('user.contact.post'));
    }

}
