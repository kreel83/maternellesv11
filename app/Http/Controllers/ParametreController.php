<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\Equipe;
use App\Models\Section;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
        return redirect()->back();
    }


    public function monprofil() {
        $user = Auth::user();
        $user->photo = Storage::url($user->photo);

        return view('monprofil.index')->with('user', $user);
    }


    public function savemonprofil(Request $request) {

        $user = Auth::user();
        $user->name = strtoupper($request->nom);
        $user->prenom = strtoupper($request->prenom);
        $user->nom_ecole = ucfirst($request->nom_ecole);
        $user->adresse_ecole = ucfirst($request->adresse_ecole);
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
        return redirect()->back()->with('success',"'c'est fait");

    }

    public function welcome() {
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

        $anniversaires = $anniversaires->sortBy('jour');
        return view('welcome')
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
        if ($request->section) {
            $section = Section::find($request->section);
        } else {
            $section = Section::first();
        }
        $sections = Section::all();

        return view('parametres.phrases.index')->with('sections', $sections)->with('section', $section);
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
        return view('parametres.phrases.__tableau_des_phrases')->with('section', Section::find($request->section));
    }
}
