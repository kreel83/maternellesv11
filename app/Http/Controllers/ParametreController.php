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
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Intervention\Image\Facades\Image;

class ParametreController extends Controller
{

    public function aidematernelle() {
        $equipes = Auth::user()->equipes();
        $photo = asset('img/avatar/avatarF.jpg');

        return view('aidematernelle.index')->with('equipes', $equipes)->with('photo', $photo);
    }

    public function saveaidematernelle(Request $request) {

        $user = Auth::user();
        if ($request->id) {
            $equipe = Equipe::find($request->id);

        } else {
            $equipe = new Equipe();
            $equipe->user_id = $user->id;
            $equipe->created_at = Carbon::now();
            $equipe->updated_at = Carbon::now();
        }
        $equipe->prenom = ucfirst($request->prenom);
        $equipe->name = strtoupper($request->nom);
        $equipe->fonction = ucfirst($request->fonction);

        if ($request->file('photo')) {
            $folder = $user->repertoire.'/equipe/'.uniqid().'.jpg';
            $path = Storage::path($folder);
            $photo = $request->file('photo');
            $img = Image::make($photo)->encode('jpg', 75);;
            $img->fit(200,200, function ($constraints) {
                $constraints->upsize();
            });
            $img->save($path);
            $equipe->photo = $folder;
        }
        $equipe->save();
        return $this->aidematernelle();
    }


    public function monprofil() {
        $user = Auth::user();
        $ecole = Ecole::select('nom_etablissement','adresse_1','adresse_2','adresse_3','telephone')
            ->where('identifiant_de_l_etablissement', $user->ecole_id)
            ->first();
        $adresseEcole = $ecole->nom_etablissement;
        if($ecole->adresse_1 != '') { $adresseEcole .= ', '.$ecole->adresse_1; }
        if($ecole->adresse_2 != '') { $adresseEcole .= ', '.$ecole->adresse_2; }
        if($ecole->adresse_3 != '') { $adresseEcole .= ', '.$ecole->adresse_3; }
        $user->photo = Storage::url($user->photo);
        return view('monprofil.index')
            ->with('user', $user)
            ->with('adresseEcole', $adresseEcole)
            ->with('telephoneEcole', $ecole->telephone);
    }


    public function savemonprofil(Request $request) {

        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'mobile' => ['max:20'],
        ], [
            'nom.required' => 'Le nom est obligatoire.',
            'nom.max' => 'Le nom est limité à 255 caractères.',
            'prenom.required' => 'Le prénom est obligatoire.',
            'prenom.max' => 'Le prénom est limité à 255 caractères.',
            'mobile.max' => 'Le numéro de mobile est limité à 20 caractères.',
        ]);

        $user = Auth::user();
        $user->name = strtoupper($request->nom);
        $user->prenom = strtoupper($request->prenom);
        $user->mobile = $request->mobile;
        //$user->nom_ecole = ucfirst($request->nom_ecole);
        //$user->adresse_ecole = ucfirst($request->adresse_ecole);
        $user->nom_directeur = ucfirst($request->nom_directeur);
        $user->directeur = (int) $request->directeur;

        if ($request->file('photo')) {
            $folder = $user->repertoire.'/equipe/'.uniqid().'.jpg';
            $path = Storage::path($folder);
            $photo = $request->file('photo');
            $img = Image::make($photo)->encode('jpg', 75);;
            $img->fit(300,300, function ($constraint) {
                $constraint->upsize();
            });
            $img->save($path);
            $user->photo = $folder;
        }
        $user->save();
        return redirect()->back()->with('result', 'success');

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
}
