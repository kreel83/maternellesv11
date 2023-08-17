<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\Ecole;
use App\Models\Enfant;
use App\Models\Equipe;
use App\Models\Resultat;
use App\Models\Section;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Intervention\Image\Facades\Image;
use OpenAI\Laravel\Facades\OpenAI;


class ParametreController extends Controller
{

    public function aidematernelle() {
        $equipes = Auth::user()->equipes();
        $photo = asset('img/avatar/avatarF.jpg');

        return view('aidematernelle.index')->with('equipes', $equipes)->with('photo', $photo);
    }

    public function saveaidematernelle(Request $request) {

        
        $liste = array();
        for($i=0; $i<4; $i++) {

            if ($request->prenom[$i] && $request->name[$i]) {
                $arr = array();
                $arr[] = $request->prenom[$i];
                $arr[] = $request->name[$i];
                $arr[] = $request->fonction[$i];
                $liste[$i] = $arr;
            }

        }
        $liste = json_encode($liste);
        

        $user = Auth::user();
        $user->equipes = $liste;
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


    public function monprofil() {

        $variable = "<h2>titre 1</h2>
        Magali prend la <b>parole</b> et s'exprime de manière claire.
        Magali a des difficulté à s'exprimer par lui-meme.        
        MAgali utilise des formes verbales adaptées.        
        MAgali s'exprime dans un langage syntaxiquement correct.
        <h2>titre 2</h2>
        Magali est super.
        Magali sais bien chanter.
        Magali ecrit pas mal.";

        $result = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => "Sachant qu'un tag h2 correspond à un paragraphe et qu'il n'est pas modifiable, peux-tu me reformuler le texte suivant en utilisant le prénom qu'en début de pargraphe: ".$variable],
            ],
           
        ]);
         
        dd($result['choices']);

        $user = Auth::user();
        $equipes = json_decode($user->equipes, true);
        
        
        $ecole = Ecole::select('nom_etablissement','adresse_1','adresse_2','adresse_3','telephone')
            ->where('identifiant_de_l_etablissement', $user->ecole_identifiant_de_l_etablissement)
            ->first();
        $adresseEcole = $ecole->nom_etablissement;
        if($ecole->adresse_1 != '') { $adresseEcole .= ', '.$ecole->adresse_1; }
        if($ecole->adresse_2 != '') { $adresseEcole .= ', '.$ecole->adresse_2; }
        if($ecole->adresse_3 != '') { $adresseEcole .= ', '.$ecole->adresse_3; }
        $user->photo = Storage::url($user->photo);
        return view('monprofil.index')
            ->with('user', $user)
            ->with('equipes', $equipes)
            ->with('adresseEcole', $adresseEcole);
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
        $commentaires = Commentaire::where('user_id', Auth::id())->where('section_id',$section)->get();
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
        $phrase->texte = strip_tags($request->quill);
        $phrase->save();
        $commentaires = Commentaire::where('user_id', Auth::id())->where('section_id', $request->section)->get();
        return view('parametres.phrases.__tableau_des_phrases')->with('commentaires', $commentaires);
    }

    /**
     * Changer le mot de passe de l'adminsitrateur
     *
     * @return View
     */
    function changerLeMotDePasse(): View
    {
        return view('monprofil.motdepasse');
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
        return redirect()->back()->with('result', 'success');
    }
}
