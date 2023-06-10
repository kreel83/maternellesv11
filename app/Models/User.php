<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use Billable;

     /**
     * @param string $role
     * @return bool
     */
    public function hasRole(string $role): bool
    {
        return $this->getAttribute('role') === $role;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'role',
        'name',
        'prenom',
        'email',
        'password',
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
    ];



    public function nom_complet() {
        return $this->prenom.' '.$this->name;
    }

    public function notations() {

        return $this->hasmany('App\Models\Notation');
    }

    public function mesfiches() {
        //$items = Item::join('fiches','fiches.item_id','id')->where('fiches.section_id', $section->id)->where('user_id', Auth::id())->orderBy('order')->get();
        //dd($items);
        

        $fiches = Fiche::where('user_id', Auth::id())->pluck('item_id');

        $mesfiches = Item::selectRaw('items.*, fiches.id as fiche_id, fiches.user_id')->join('fiches','fiches.item_id', 'items.id')->where('fiches.user_id', Auth::id())->orderBy('fiches.order')->get();

        return $mesfiches;

        return Item::whereIn('id', $fiches)->get();

    }

    public function autresfiches($section) {
        $user = Auth::id();
        $mesfiches = Fiche::where('user_id', $this->id)->where('section_id', $section->id)->get();
        $ll = $mesfiches->pluck('item_id');
        $items = Item::whereNotIn('id', $ll)->where('section_id', $section->id)->where(function($query) use($user) {
            $query->whereNull('status')->orWhere('status', $user);
        })->get();
        //$perso = Personnel::whereNotIn('id', $ll)->where('section_id', $section->id)->get();
        //$return =  $items->merge($perso);
        $return = $items;
        return $return;

    }

    public function equipes() {
        return Equipe::where('user_id', $this->id)->get();
    }


    public function liste() {
        return Enfant::where('user_id', $this->id)->get();
    }

    public function profs() {
        $ecole = Auth()->user()->ecole_code_etablissement;
        return User::where('ecole_code_etablissement', $ecole)->get();
    }

    public function tous() {
        $ecole = Auth()->user()->ecole_code_etablissement;
        $users = User::where('ecole_code_etablissement', $ecole)->pluck('id');
        return Enfant::whereNull('user_id')->whereIn('user_n1_id', $users)->get();
    }

    public function calcul_annee_scolaire() {

        $year = (int) Carbon::now()->format('Y');
        $month = (int) Carbon::now()->format('m');
        if ($month < 7) return $year - 1;
        return $year;

    }

    public function items() {
        $fiches = Fiche::where('user_id', Auth::id())->orderBy('order')->pluck('item_id');

        $result = Item::where(function($query) {
            $query->where('user_id', $this->id)->orWhereNull('user_id');
        })->whereNotIn('id', $fiches)->get();
        
        return $result;
    }
}
