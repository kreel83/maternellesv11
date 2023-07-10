<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Ecole;
use App\Models\User;
use App\Models\UserDirection;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserEmailVerificationSelfRegistration;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register_user');
    }

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function createProf()
    {
        return view('auth.register_prof');
    }

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function createDirection()
    {
        return view('auth.register_direction');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'prenom' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storeProf(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $validationKey = md5(microtime(TRUE)*100000);

        $user = User::create([
            'name' => $request->name,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'validation_key' => $validationKey,
            'licence' => 'self'
        ]);

        // Envoi d'un email de vérification
        $token = md5($user->id.$validationKey.env('HASH_SECRET'));
        $url = route('user.validUserFromSelfRegistration').'?'.'uID='.$user->id.'&key='.$validationKey.'&token='.$token;
        Mail::to($request->email)->send(new UserEmailVerificationSelfRegistration($url, $request->prenom));

        return view('auth.register_user_sendmail')
            ->with('email', $request->email);

        /*
        event(new Registered($user));
        Auth::login($user);
        return redirect(RouteServiceProvider::HOME);
        */
    }

     /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storeDirection(Request $request)
    {
        $request->validate([
            'ecole_id' => ['required', 'string', 'max:8', 'min:8', 'exists:ecoles,identifiant_de_l_etablissement'],
            'name' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = UserDirection::create([
            'ecole_id' => $request->ecole_id,
            'name' => $request->name,
            'prenom' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        //event(new Registered($user));

        Auth::guard('direction')->login($user);
        //dd(Auth::check());
        return redirect(RouteServiceProvider::DASHBOARDPRO);
    }

    /**
     * Display the registration view for Admin.
     *
     * @return \Illuminate\View\View
     */
    public function adminCreationForm(Request $request): View
    {
        $ecole = Ecole::where('identifiant_de_l_etablissement', $request->codeEtablissement)->first();
        return view('auth.register-admin')
            ->with('email',$ecole->mail)
            ->with('ecole_id',$request->codeEtablissement);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function createAdminUser(Request $request)
    {
        //dd($request);
        $request->validate([
            'ecole_id' => ['required', 'string', 'min:8', 'max:8', 'exists:ecoles,identifiant_de_l_etablissement'],
            'name' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $validationKey = md5(microtime(TRUE)*100000);

        $user = User::create([
            'ecole_id' => $request->ecole_id,
            'name' => $request->name,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'validation_key' => $validationKey,
            'role' => 'admin'
        ]);

        // Envoi d'un email de vérification
        $token = md5($user->id.$validationKey.env('HASH_SECRET'));
        $url = route('user.validUserFromSelfRegistration').'?'.'uID='.$user->id.'&key='.$validationKey.'&token='.$token;
        //Mail::to($request->email)->send(new UserEmailVerificationSelfRegistration($url, $request->prenom));
        //Mail::to('thierry.thevenoud@gmail.com')->send(new UserEmailVerificationSelfRegistration($url, $request->prenom));

        return view('auth.register_user_sendmail')
            ->with('email', $request->email);
        /*
        event(new Registered($user));
        Auth::login($user);
        return redirect(route('admin.index'));
        */
    }

}
