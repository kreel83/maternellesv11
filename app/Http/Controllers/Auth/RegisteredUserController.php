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
use App\utils\Utils;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

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

    /** ----------------------------------------- */
    /** Fonctions création de compte Admin / User */
    /** ----------------------------------------- */

    public function registrationStart(): View
    {
        return view('registration.start');
    }

    public function registrationStep1($role)
    {
        if(!in_array($role, ['admin', 'user'])) {
            return redirect()->route('registration.start');
        }
        return view('registration.step1')
            ->with('role', $role);
    }

    public function registrationStep1Post(Request $request)
    {
        $rules = ['required', 'string', 'max:8', 'min:8', 'exists:ecoles,identifiant_de_l_etablissement'];

        $msg = array(
            'ecole_id.required' => 'Veuillez indiquer un identifiant.',
            'ecole_id.min' => 'L\'identifiant doit avoir 8 caractères minimum.',
            'ecole_id.max' => 'L\'identifiant doit avoir 8 caractères maximum.',
            'ecole_id.exists' => 'Identifiant introuvable. Vérifiez votre saisie.',
        );

        if($request->role == 'admin') {
            array_push($rules, 'unique:users,ecole_identifiant_de_l_etablissement');
            $msg = Arr::add($msg, 'ecole_id.unique', 'Un compte administrateur existe déjà pour cet établissement.');
        }

        $request->validate([
            'ecole_id' => $rules,
        ], $msg);

        /*
        $request->validate([
            'ecole_id' => ['required', 'string', 'max:8', 'min:8', 'exists:ecoles,identifiant_de_l_etablissement'],
            'role' => ['required', 'string', Rule::in(['admin', 'user'])],
        ], [
            'ecole_id.required' => 'Veuillez indiquer un identifiant.',
            'ecole_id.min' => 'L\'identifiant doit avoir 8 caractères minimum.',
            'ecole_id.max' => 'L\'identifiant doit avoir 8 caractères maximum.',
            'ecole_id.exists' => 'Identifiant introuvable. Vérifiez votre saisie.',
            'role.in' => 'Fonction non reconnue.',
        ]);
        */

        /*
        $ecole = Ecole::where('identifiant_de_l_etablissement', $request->ecole_id)->first();
        return view('registration.step2')
            ->with('role', $request->role)
            ->with('ecole', $ecole);
        */
        $ecole_id = strtoupper($request->ecole_id);

        $token = md5($request->role.$ecole_id.env('HASH_SECRET'));
        // dd(md5($request->role.$request->ecole_id.env('HASH_SECRET')), $request->role, $request->ecole_id);
        return redirect()->route('registration.step2', [
            'role' => $request->role, 
            'ecole_id' => $ecole_id,
            'token' => $token,
        ]);
    }
    
    public function registrationStep2($role, $ecole_id, $token)
    {
        
        // verification Token
        if($token != md5($role.$ecole_id.env('HASH_SECRET'))) {
            
            return redirect()->route('registration.start')
                ->with('status', 'danger')
                ->with('msg', 'Token invalide.');
        }
        $ecole = Ecole::where('identifiant_de_l_etablissement', $ecole_id)->first();
        return view('registration.step2')
            ->with('role', $role)
            ->with('ecole', $ecole)
            ->with('token', $token);
    }

    public function registrationStep3(Request $request)
    {
        // dd($request->token, $request->role, $request->ecole_id,env('HASH_SECRET'), md5($request->role.$request->ecole_id.env('HASH_SECRET')));
        // verification Token
        if($request->token != md5($request->role.$request->ecole_id.env('HASH_SECRET'))) {
            return redirect()->route('registration.start')
                ->with('status', 'danger')
                ->with('msg', 'Token invalide.');
        }

        $ecole = Ecole::where('identifiant_de_l_etablissement', $request->ecole_id)->first();
        // test si l'email de l'ecole est sur un domaine académique
        //$academique = Str::contains($ecole->mail, '@ac-');
        $academique = Str::containsAll($ecole->mail, ['@ac-', '.fr']);
        $domain = Str::after($ecole->mail, '@');
        return view('registration.step3')
            ->with('academique', $academique)
            ->with('domain', $domain)
            ->with('role', $request->role)
            ->with('ecole_id', $request->ecole_id)
            ->with('email', $ecole->mail)
            ->with('token', $request->token);
    }
    
    public function registrationStep3Post(Request $request)
    {
        // verification Token
        if($request->token != md5($request->role.$request->ecole_id.env('HASH_SECRET'))) {
            return redirect()->route('registration.start')
                ->with('status', 'danger')
                ->with('msg', 'Token invalide.');
        }     
           
        $request->validate([
            'emailondomain' => ['exclude_if:role,admin', 'required'],
            'role' => ['required', 'string', 'in:admin,user'],
            'ecole_id' => ['required', 'string', 'max:8', 'min:8', 'exists:ecoles,identifiant_de_l_etablissement'],
            'civilite' => ['required', 'string'],
            'name' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'emailondomain.required' => 'Veuillez indiquer si votre adresse de courrier électronique est sur le domaine académique ou un service tiers.',
            'role.required' => 'Fonction manquante.',
            'role.in' => 'Fonction invalide.',
            'ecole_id.required' => 'Identifiant établissement manquant.',
            'ecole_id.exists' => 'Identifiant établissement introuvable.',
            'civilite.required' => 'La civilité est obligatoire.',
            'name.required' => 'Le nom est obligatoire.',
            'name.max' => 'Le nom est limité à 255 caractères.',
            'prenom.required' => 'Le prénom est obligatoire.',
            'prenom.max' => 'Le prénom est limité à 255 caractères.',
            'email.required' => 'Adresse mail obligatoire.',
            'email.max' => 'Adresse mail limitée à 255 caractères.',
            'email.unique' => 'Un compte existe déjà pour cette adresse mail.',
            'password.required' => 'Mot de passe obligatoire.',
            'password.confirmed' => 'La confirmation du mot de passe a échouée.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',

        ]);

        // test si email sur domaine académique dans le cas d'un user
        if($request->role == 'user') {
            if($request->emailondomain == '1') {                
                $domain = Str::after($request->email, '@');
                if($domain != $request->domain) {
                    return Redirect::back()->withInput()->withErrors(['msg' => "L'adresse email ne correspond pas au domain académique : $domain"]);
                }
            }
        }

        $token = md5(microtime(TRUE)*100000);

        $user = User::create([
            'role' => $request->role,
            'ecole_identifiant_de_l_etablissement' => $request->ecole_id,
            'civilite' => $request->civilite,
            'name' => $request->name,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'validation_key' => $token,
        ]);

        // Envoi d'un email de vérification
        $verificationLink = route('registration.validation', ['token' => $token]);
        if($request->role == 'user') {
            Mail::to($request->email)->send(new UserEmailVerificationSelfRegistration($verificationLink, $request->prenom));
        }
        if($request->role == 'admin') {
            Mail::to('contact.clickweb@gmail.com')->send(new UserEmailVerificationSelfRegistration($verificationLink, $request->prenom));
        }
        //Mail::to($request->email)->send(new UserEmailVerificationSelfRegistration($url, $request->prenom));

        // si probleme envoi mail
        // php artisan config:cache
        // php artisan config:clear
        // php artisan cache:clear

        return redirect()->route('registration.step4')->with('email', $request->email);
    }

    public function registrationStep4()
    {
        return view('registration.step4');
    }

    /*
    public function registrationStep4(Request $request)
    {
        // verification Token
        if($request->token != md5($request->role.$request->ecole_id.env('HASH_SECRET'))) {
            return redirect()->route('registration.start');
        }
        $ecole = Ecole::where('identifiant_de_l_etablissement', $request->ecole_id)->first();
        return view('registration.step4')
            ->with('email', $ecole->mail);
    }
    */

    public function valideUser(Request $request): View
    {
        // appelé depuis lien dans email
        $user = User::where('validation_key', $request->token)->first();
        if($user) {
            $user->actif = 1;
            //$user->validation_key = null;
            $user->save();
            // Auth::login($user);  // A VOIR si on log automatiquement à la validation
        }
        return view("registration.validation_self")
            ->with('user', $user);
    }

    /** Fin fonctions création de compte Admin / User */

}
