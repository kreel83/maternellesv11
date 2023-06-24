<?php

namespace App\Http\Controllers;

use App\Models\Licence;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;

class UserController extends Controller
{
    public function deco() {
        Auth::logout();
        return redirect()->route('enfants');
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
        Auth::login($user);
        return redirect(RouteServiceProvider::HOME);
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
}
