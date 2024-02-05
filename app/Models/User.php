<?php

namespace App\Models;

use App\Events\UserEvent;
use App\Mail\SendResetPasswordLink;
use Carbon\Carbon;
use Session; 
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Billable;
use App\Models\Event;
use App\Models\Configuration;
use App\Models\Resultat;
use App\Models\Classe;
use App\Models\ClasseUser;
use App\Notifications\ResetPassword;
use Illuminate\Support\Facades\Log as FacadesLog;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\HasApiTokens;


/**
 * @mixin IdeHelperUser
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use Billable, HasApiTokens;


    const SCENARIO = [
        'step1' => [
            'name' => 'Créer un directeur',
            'keyword' => 'createDirector',
            'explication' => "Nous allors créer à présent le nom de votre directeur d'établissement",
            "script" => [
                'menu_parametre' => 'Cliquez sur le menu Paramètre',
                'menu_monProfil' => 'Cliquez sur Mon profil',
            ]
        ],
        'step2' => [
            'name' => 'Créer votre périodicité',
            'keyword' => 'createPeriode',
            'explication' => "Nous allors créer à présent le nom de votre périodiicité"
        ],
        'step1' => [
            'name' => 'Créer vos groupe',
            'keyword' => 'createGroupe',
            'explication' => "Nous allors créer à présent vos groupes"
        ],
    ];

    public static function boot() {

	    parent::boot();

	    static::created(function($user) {
	        //FacadesLog::info('User Created Event:'.$user);
            // Fiche::createDemoFiche($user);
            Configuration::create(['user_id' => $user->id]);
            // Enfant::create([
            //     'nom' => 'DE LUCAS',
            //     'prenom' => 'Théo',
            //     'ddn' => '05/09/2018',
            //     'photo' => '6.png',
            //     'mail' => $user->email,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            //     'annee_scolaire' => Carbon::now()->format('Y'),
            //     'background' => 'b2',   
            //     'user_id' =>$user->id,
            //     'genre' => 'G'             
            // ]);
            // Enfant::create([
            //     'nom' => 'LAURENCE',
            //     'prenom' => 'Jennifer',
            //     'ddn' => '06/10/2018',
            //     'photo' => '32.png',
            //     'mail' => $user->email,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            //     'annee_scolaire' => Carbon::now()->format('Y'),
            //     'background' => 'b4',   
            //     'user_id' =>$user->id,
            //     'genre' => 'F'             
            // ]);
	    });

        /*
        static::deleting(function(User $user) {
	        FacadesLog::info('User Deleted Event:'.$user);
            Configuration::where('user_id', $user->id)->delete();
	    });
        */
	    
	}

     /**
     * @param string $role
     * @return bool
     */
    public function hasRole(string $role): bool
    {
        return $this->getAttribute('role') === $role;
    }

    const FONCTIONS = [
        'am' => 'Aide maternelle (ATSEM)',
        'aesh' =>'AESH'
    ];


    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'ecole_identifiant_de_l_etablissement',
        'role',
        'civilite',
        'name',
        'prenom',
        'email',
        'password',
        'validation_key',
        'licence'
    ];
    /*
    $guarded avec un tableau vide pour accepter tous les champs
    ou le nom des champs à exclure
    */

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'classe_id' => 'integer',
    ];


    protected $dispatchesEvents = [
        'retrieved' => UserEvent::class,
    ];

    public $type_groupe;
    public $groupe;
    public $groupes;
    public $periodes;
    public $equipes;

    public function groupes() {
        // if (session()->get('id_de_la_classe') == null) return null;
        // return Classe::find(session()->get('id_de_la_classe'))->groupes;
        if (session()->get('classe_active') == null) return null;
        return session('classe_active')->groupes;
    }

    public function periodes() {
        // if (session()->get('id_de_la_classe') == null) return null;
        // return Classe::find(session()->get('id_de_la_classe'))->periodes;
        if (session()->get('classe_active') == null) return null;
        return session('classe_active')->periodes;
    }

    public function classe_active() {
        // return Classe::find(session()->get('id_de_la_classe'));
        return session('classe_active');
    }

    public function directeur_civilite() {
        
        $directeur = session('classe_active')->direction;        
        $d = json_decode($directeur);
        return $d->civilite ?? null;
    
    }

    public function directeur() {
        if (session()->get('classe_active') == null) return null;
        $directeur = session('classe_active')->direction;        
        return json_decode($directeur);
    }

    public function check_partage() {
        $p = ClasseUser::where('email', $this->email)->whereNotNull('user_id')->first();
        
        if ($p) {
            $classe = Classe::find($p->classe_id);
            $this->classe_id = $p->classe_id;
            $this->save();
            Session::get(['classe_active', $classe]);
            return 'rewind';
        }

        $partage = ClasseUser::select('classe_users.id', 'users.name', 'users.prenom', 'classes.description')
            ->where('classe_users.email', $this->email)
            ->leftJoin('classes', 'classes.id', 'classe_users.classe_id')
            ->leftJoin('users', 'users.id', 'classes.user_id')
            ->whereNull('classe_users.user_id')
            ->get();
        return $partage;
    }

    public function check_is_partage_en_cours() {
        return ClasseUser::where('email', $this->email)->whereNull('user_id')->get();
    }


    public function configuration() {
        return $this->hasOne('App\Models\Configuration','user_id','id');
    }

    public function is_titulaire() {
        $c = Classe::find(session('classe_active')->id);
        if ($c->user_id == $this->id) return true;
        return false;
    }

    public function autresClasses() {
        $classe_partage = ClasseUser::where('user_id', Auth::id())->pluck('classe_id');
        $classe_perso = Classe::where('user_id', $this->id)->pluck('id');
        $classe_totale =  $classe_partage->merge($classe_perso)->toArray();
        $classe_actuelle = Auth::user()->classe_id; 
        if (($key = array_search($classe_actuelle, $classe_totale)) !== false) {
            unset($classe_totale[$key]);
        }
        return Classe::whereIn('id', $classe_totale)->get();
    }

    public function toutes_mes_classes() {
        $mesclasse = $this->autresClasses();

        return $mesclasse->push(session('classe_active'));
    }

    public function sendPasswordResetNotification($token): void
    {
        $url = route('password.reset', ['token' => $token]);
        Mail::to($this->email)->send(new SendResetPasswordLink($url, $this->prenom));
    }

    public function nom_complet() {
        return $this->prenom.' '.$this->name;
    }

    public function notations() {

        return $this->hasmany('App\Models\Notation');
    }

    public function is_abonne() {
        switch($this->licence) {
            case('admin'):
                // Licence accordée par l'école
                $licence = Licence::where([
                    ['user_id', $this->id],
                    ['actif', 1],
                ])->first();
                if($licence) {
                    return true;
                } else {
                    return false;
                }
                break;
            case('self'):
                // licence prise individuellement
                if ($this->subscribed('default')) {
                    return true;
                } else {
                    return false;
                }
                break;
        }
        return false;
    }

    public function mesfiches() {
        $mesfiches = Item::selectRaw('items.*, fiches.id as fiche_id, fiches.classe_id')
            ->join('fiches','fiches.item_id', 'items.id')
            ->where('fiches.classe_id', session('classe_active')->id)
            ->orderBy('items.categorie_id')
            ->orderBy('fiches.order')
            ->get();
        return $mesfiches;
    }

    public function items() {
        $fiches = Fiche::where('classe_id', session('classe_active')->id)->orderBy('order')->pluck('item_id');


        $result = Item::where(function($query) {
            $query->where('user_id', $this->id)->orWhereNull('user_id');
        })->whereNotIn('id', $fiches)->orderBy('categorie_id')->get();
        
        return $result;
    }

    public function autresfiches($section) {
        $user = Auth::id();
        $mesfiches = Fiche::where('classe_id', session('classe_active')->id)->where('section_id', $section->id)->get();
        $ll = $mesfiches->pluck('item_id');
        $items = Item::whereNotIn('id', $ll)->where('section_id', $section->id)->where(function($query) use($user) {
            $query->whereNull('status')->orWhere('status', $user);
        })->get();
        //$perso = Personnel::whereNotIn('id', $ll)->where('section_id', $section->id)->get();
        //$return =  $items->merge($perso);
        $return = $items;
        return $return;

    }

    // public function equipes() {
    //     return Equipe::where('user_id', $this->id)->get();
    // }

    public function evenements() {
        return Event::where('user_id', $this->id);
    }

    // public function is_enfants() {
    //     $enfant = Enfant::where('user_id', $this->id)->first();
    //     return $enfant;
    // }

    public function name_ecole() {

        $ecole = Ecole::where('identifiant_de_l_etablissement', session('classe_active')->ecole_identifiant_de_l_etablissement)->first();
        return $ecole;
    }

    public function ecole() { $ecole = $this->classe_active()->ecole_identifiant_de_l_etablissement;
        return $this->hasOne('App\Models\Ecole','identifiant_de_l_etablissement','ecole_identifiant_de_l_etablissement');
    }



    // $user->config->groupes;
    // $user->config->periodes;
    // $user->config->aides;

    public function liste() {
        // return Enfant::where('classe_id', session()->get('id_de_la_classe'))->orderBy('prenom')->get();
        return Enfant::where('classe_id', session('classe_active')->id)->orderBy('prenom')->get();
    }

    public function profs() {
        $ecole = Auth()->user()->ecole_identifiant_de_l_etablissement;
        return User::where('ecole_identifiant_de_l_etablissement', $ecole)->get();
    }

    // public function tous() {
    //     $ecole = Auth()->user()->ecole_identifiant_de_l_etablissement;
    //     $users = User::where('ecole_identifiant_de_l_etablissement', $ecole)->pluck('id');
    //     return Enfant::whereNull('user_id')->whereIn('user_n1_id', $users)->get();
    // }

    public function calcul_annee_scolaire() {

        $year = (int) Carbon::now()->format('Y');
        $month = (int) Carbon::now()->format('m');
        if ($month < 7) return $year - 1;
        return $year;

    }

    public function hasResultats() {
        return Resultat::select('notation', 'autonome')
        ->join('enfants', 'enfants.id' ,'enfant_id')
        ->where('enfants.classe_id', session('classe_active')->id)
        ->count();
         
    }

    /*
    public function getSchool() {
        $ecole = Ecole::where('identifiant_de_l_etablissement', $this->ecole_id)->first();
        return $ecole;
    }
    */

    public function maClasse() {
        return Classe::where('user_id', Auth::id())->first();
    }

}
