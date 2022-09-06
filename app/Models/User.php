<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

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

    public function mesfiches($section) {
        return Fiche::where('section_id', $section->id)->orderBy('order')->get();
    }

    public function autresfiches($section) {
        $user = Auth::id();
        $mesfiches = Fiche::where('user_id', $this->id)->where('section_id', $section->id)->get();
        $ll = $mesfiches->pluck('item_id');
        $items = Item::whereNotIn('id', $ll)->where('section_id', $section->id)->where(function($query) use($user) {
            $query->whereNull('status')->orWhere('status', $user);
        })->get();
//        $perso = Personnel::whereNotIn('id', $ll)->where('section_id', $section->id)->get();
//        $return =  $items->merge($perso);
        return $items;

    }

    public function liste() {
        return Enfant::where('user_id', $this->id)->get();
    }

    public function calcul_annee_scolaire() {

        $year = (int) Carbon::now()->format('Y');
        $month = (int) Carbon::now()->format('m');
        if ($month < 7) return $year - 1;
        return $year;

    }
}
