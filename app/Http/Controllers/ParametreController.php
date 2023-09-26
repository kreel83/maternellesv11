<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\Ecole;
use App\Models\Enfant;
use App\Models\Equipe;
use App\Models\Resultat;
use App\Models\Configuration;
use App\Models\Section;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Intervention\Image\Facades\Image;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Validation\Rules;



class ParametreController extends Controller
{

    public function aidematernelle() {
        $equipes = Auth::user()->configuration->equipes;
        $photo = asset('img/avatar/avatarF.jpg');

        return view('aidematernelle.index')->with('equipes', $equipes)->with('photo', $photo);
    }

    public function saveaidematernelle(Request $request) {

        $aide = array();

        for($i=0; $i<4; $i++) {   
            
            $aide[$i] = array_filter($request->aide[$i]);

            if (sizeof($aide[$i]) > 0) {
                if (sizeof($aide[$i]) == 3) {
                    $arr = array();
                    $arr[] = ucfirst($aide[$i]['prenom']);
                    $arr[] = strtoupper($aide[$i]['name']);
                    $arr[] = $aide[$i]['fonction'];
                    $liste[$i] = $arr;
                } else {
                   session()->flash('error'.$i, 'Les 3 champs sont obligatoires');
                   return redirect()->back()->withInput();
                }                
            }


        }
        $liste = json_encode($liste);
        

        $user = Auth::user();
        $config = Configuration::where('user_id', $user->id)->first();
        if (!$config) {
            $config = new Configuration();
            $config->user_id = $user->id;            
        }


        $config->equipes = $liste;
        $config->save();
        // if ($request->id) {
        //     $equipe = Equipe::find($request->id);

        // } else {
        //     $equipe = new Equipe();
        //     $equipe->user_id = $user->id;
        //     $equipe->created_at = Carbon::now();
        //     $equipe->updated_at = Carbon::now();
        // }
        // $equipe->prenom = ucfirst($request->prenom);
        // $equipe->name = strtoupper($request->nom);
        // $equipe->fonction = ucfirst($request->fonction);


        // $equipe->save();
        return redirect()->back()->withInput();
    }


    private function chatpht($reussite) {            
        $content = "Met au féminin la phrase suivante : ".$reussite;
        $result = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 
                'content' => $content],
            ],
           
        ]);
        
        return $result['choices'][0]['message']['content'];
    }

    public function monprofil(Request $request) {


        // $coms = Item::all();
        // foreach ($coms as $com) {
        //     if (($com->phrase_feminin == null) && ($com->phrase_masculin != null)) {
        //         $com->phrase_feminin = $com->phrase_masculin;
        //         $com->save();

        //     }
        // }


        // $cs = Item::all();
        // foreach($cs as $item) {
        //     $r = $item->phrase;
        //     $r = str_replace("@pronom@","il", $r);
            
        //     $item->phrase = $r;
        //     $item->save();
        // }

        $user = Auth::user();
        $equipes = json_decode($user->equipes, true);
        
        
        $ecole = Ecole::select('nom_etablissement','adresse_1','adresse_2','adresse_3','telephone')
            ->where('identifiant_de_l_etablissement', $user->ecole_identifiant_de_l_etablissement)
            ->first();
        $adresseEcole[] = $ecole->nom_etablissement;
        if($ecole->adresse_1 != '') { $adresseEcole[] = $ecole->adresse_1; }
        if($ecole->adresse_2 != '') { $adresseEcole[] = $ecole->adresse_2; }
        if($ecole->adresse_3 != '') { $adresseEcole[] = $ecole->adresse_3; }
        $user->photo = Storage::url($user->photo);
        $conf = Configuration::where('user_id', Auth::id())->first();

        return view('monprofil.index')
            ->with('request', $request->all() ?? [])
            ->with('periodes', $conf->periodes)
            ->with('user', $user)
            ->with('equipes', $equipes)
            ->with('adresseEcole', join(PHP_EOL,$adresseEcole));
    }


    public function get_phrases(Request $request) {
        $c = Commentaire::find($request->id);
        $c->phrase_masculin = str_replace("L'élève","Léon", $c->phrase_masculin);
        $c->phrase_feminin = str_replace("L'élève","Lucie", $c->phrase_feminin);
        return[$c->phrase_masculin, $c->phrase_feminin];
    }

    public function savedirecteur(Request $request) {

        $validated = $request->validate([
            'directeur_prenom' => 'required',
            'directeur_nom' => 'required',
        ],[
            'directeur_prenom.required' => 'Le prénom est obligatoire.',
            'directeur_nom.required' => 'Le nom est obligatoire.'
        ]);

        
        $user = Auth::user();
        $user->directeur_prenom = ucfirst($request->directeur_prenom);
        $user->directeur_nom = strtoupper($request->directeur_nom);
        $user->directeur_civilite = $request->directeur_civilite;
        $user->save();
        return redirect()->back()->withInput();
    }

    public function savemonprofil(Request $request) {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'phone' => ['max:10'],
        ], [
            'name.required' => 'Le nom est obligatoire.',
            'name.max' => 'Le nom est limité à 255 caractères.',
            'prenom.required' => 'Le prénom est obligatoire.',
            'prenom.max' => 'Le prénom est limité à 255 caractères.',
            'phone.max' => 'Le numéro de mobile est limité à 10 caractères.',
        ]);


        $user = Auth::user();
        $user->name = strtoupper($request->name);
        $user->prenom = strtoupper($request->prenom);
        $user->phone = $request->phone;
        //$user->nom_ecole = ucfirst($request->nom_ecole);
        //$user->adresse_ecole = ucfirst($request->adresse_ecole);
        // $user->nom_directeur = ucfirst($request->nom_directeur);
        // $user->directeur = (int) $request->directeur;


        $user->save();
        return redirect()->back()->withInput();

    }

    public function welcome(): View
    {

        // mise à jour des variables session pour gérer le menu abonnement
        UserController::setMenuAbonnement();


        // Check for a subscription and calculate end date
        // dd(Auth::user()->subscription('default')->asStripeSubscription());
        if (Auth::user()->subscribed('default')) {
            $finsouscription = Auth::user()->subscription('default')->asStripeSubscription()->current_period_end;
        } else {
            $finsouscription = null;
        }
        // ----

        $date = Carbon::now();
        $mois = $date->locale('fr')->monthName;
        $nb = $date->month;
        $enfants = Auth::user()->liste();
        $anniversaires = $enfants->filter(function ($enfant) use ($nb) {
            if ($enfant->ddn) {
                $m = explode('-', $enfant->ddn);
                return ($m[1] == $nb);
            }
        })->values();

        $resultat = new Resultat;
        $top5ElevesLesPlusAvances = $resultat->top5ElevesLesPlusAvances();
        // dd($top5ElevesLesPlusAvances);
        $top5ElevesLesMoinsAvances = $resultat->top5ElevesLesMoinsAvances();
        $top5DisciplinesLesPlusAvances = $resultat->top5DisciplinesLesPlusAvances();
        $top5DisciplinesLesMoinsAvances = $resultat->top5DisciplinesLesMoinsAvances();
        $listeDesEleves = Enfant::listeDesEleves();

        //dd($top5AdvancedKids);
        $anniversaires = $anniversaires->sortBy('jour');
        return view('welcome')
            ->with('listeDesEleves', $listeDesEleves)
            ->with('top5DisciplinesLesPlusAvances', $top5DisciplinesLesPlusAvances)
            ->with('top5DisciplinesLesMoinsAvances', $top5DisciplinesLesMoinsAvances)
            ->with('top5ElevesLesPlusAvances', $top5ElevesLesPlusAvances)
            ->with('top5ElevesLesMoinsAvances', $top5ElevesLesMoinsAvances)
            ->with('finsouscription', $finsouscription)
            ->with('anniversaires', $anniversaires)
            ->with('moisActuel', $mois);
    }

    public function index() {
        return view('home.parametres');
    }

    public function deletePhrase($id) {
        Commentaire::find($id)->delete();
        return 'ok';
    }

    public function phrases(Request $request) {

        $com = null;
        if ($request->section) {
            if ($request->section == 99) {
                $section = 99;               
            } else {   
                 $section = Section::find($request->section)->id;
               
            } 
        } else {
            $section = Section::first()->id;
        }
        $user = Auth::id();
        $commentaires = Commentaire::where(function($query) use($user) {
            $query->where('user_id', $user)->orWhereNull('user_id');
        })->where('section_id',$section)->get();
        $sections = Section::all();

        return view('parametres.phrases.index')
            ->with('sections', $sections)
            ->with('section', $section)
            ->with('commentaires', $commentaires);
            
    }

    public function savePhrases(Request $request) {

        if ($request->id == 'new') {
            $phrase = new Commentaire();
            $phrase->user_id = Auth::id();
            $phrase->section_id = $request->section;
            $phrase->court = '';
        } else {
            $phrase = Commentaire::find($request->id);
        }
        $phrase->phrase_masculin = strip_tags($request->quill);
        $phrase->phrase_feminin = $this->chatpht($phrase->phrase_masculin);

        $phrase->save();
        $commentaires = Commentaire::where(function($query) use($user) {
            $query->where('user_id', $user)->orWhereNull('user_id');
        })->where('section_id',$section)->get();
        return view('parametres.phrases.__tableau_des_phrases')->with('commentaires', $commentaires);
    }

    /**
     * Changer le mot de passe de l'adminsitrateur
     *
     * @return View
     */
    function changerLeMotDePasse(): View
    {

        return view('parametres.reset-password');
        // return view('monprofil.motdepasse');
    }

    public function sauverLeMotDePasse(Request $request)
    {

        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'password.required' => 'Mot de passe obligatoire.',
            'password.confirmed' => 'La confirmation du mot de passe a échouée.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();
        // session()->flash('success', 'Le mot de passe a bien été réinitalisé');
        session()->flash('message', 'Le mot de passe a bien été réinitalisé'); 
        session()->flash('alert-class', 'alert-success'); 
        return redirect()->route('depart');
    }



        /**
     * Changer le mot de passe de l'adminsitrateur
     *
     * @return View
     */
    function password_change(): View
    {

        return view('parametres.motdepasse');
    }

    public function password_save(Request $request)
    {
        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'password.required' => 'Mot de passe obligatoire.',
            'password.confirmed' => 'La confirmation du mot de passe a échouée.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
        ]);
 

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->back()->with('result', 'success');
    }
}
