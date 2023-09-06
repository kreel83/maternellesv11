<?php

namespace App\Http\Controllers;

use App\Models\Enfant;
use App\Models\Resultat;
use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use File;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class EleveController extends Controller
{
    public function photos() {
        $user = Auth::user();

        $degrades = Enfant::DEGRADE;
        $files = File::files(public_path('img/animaux'));
        $liste = array();
        foreach ($files as $file) {
            $liste[] = $file->getFileName();
        }

        return view('photos.index')
            ->with('eleves',$user->liste())
            ->with('degrades',$degrades)
            ->with('files', $liste);
    }

    public function liste() {
        $user = Auth::user();
        $files = File::files(public_path('img/animaux'));
        $liste = array();
        foreach ($files as $file) {
            $liste[] = $file->getFileName();
        }
        return view('eleves.liste')
            ->with('files', $liste)
            ->with('professeur', "null")
            ->with('profs', $user->profs())
            ->with('tous', $user->tous())
            ->with('eleves',$user->liste());
    }

    public function setAnimaux(Request $request) {
       $enfant = Enfant::find($request->enfant);
       $enfant->photo = $request->animaux;
       $enfant->background = $request->background;
       $enfant->save();
       return 'ok';

    }



    public function choix_enfant_select(Request $request) {
        $enfant = Enfant::find($request->id);
        $degrades = Enfant::DEGRADE;
        return view('cards.enfant')
            ->with('degrades', $degrades)
            ->with('enfant', $enfant);

    }


    public function removeEleve(Request $request) {
               
            $e = Enfant::find($request->eleve);
            $prof = $e->user_n1_id;
            if ($prof) {
                $e->user_id = null;
                $e->save();
            } else {
                $e->delete();

            }

        
        return view('eleves.include.tableau_tous')
            ->with('tous', Auth::user()->tous())
            ->with('professeur', $request->prof)
            ->with('prof', $request->prof);

    }

    public function ajouterEleves(Request $request) {
        $eleves = array_filter($request->eleves);
        
        foreach ($eleves as $eleve) {
            $e = Enfant::find($eleve);
            $e->user_id = Auth::id();
            $e->save();
        }
        return view('eleves.include.tableau_eleves')->with('eleves', Auth::user()->liste());

    }

    public function save(Request $request) {

        /*
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'mail' => ['required', 'string', 'email', 'max:255'],
        ], [
            'nom.required' => 'Le nom est obligatoire.',
            'nom.max' => 'Le nom est limité à 255 caractères.',
            'prenom.required' => 'Le prénom est obligatoire.',
            'prenom.max' => 'Le prénom est limité à 255 caractères.',
            'email.required' => 'Adresse mail obligatoire.',
            'email.max' => 'Adresse mail limitée à 255 caractères.',
            'email.unique' => 'Un compte existe déjà pour cette adresse mail.',
        ]);
        */

        $datas = $request->except(['_token']);

        $datas['mail'] = join(';', array_filter($datas['mail']));
        $datas['user_id'] = Auth::id();
        $datas['sh'] = isset($datas['sh']) ? 1 : 0;
        $datas['nom'] = mb_strtoupper($datas['nom']);
        $degrade = Enfant::DEGRADE;
        $datas['background'] = array_rand($degrade);
        $files = File::files(public_path('img/animaux'));
        $liste = array();
        foreach ($files as $file) {
            $liste[] = $file->getFileName();
        }
        $k = array_rand($liste);
        
        $datas['photo'] = $liste[$k];
        $datas['prenom'] = ucfirst($datas['prenom']);
        $datas['annee_scolaire'] = Auth::user()->calcul_annee_scolaire();
        Enfant::updateOrCreate(['id' => $datas['id']], $datas);
        return redirect()->back();
    }

    public function voirEleve($id) {
        $user = Auth::user();
        $files = File::files(public_path('img/animaux'));
        $liste = array();
        foreach ($files as $file) {
            $liste[] = $file->getFileName();
        }
        $eleve = Enfant::find($id);
        $resultats = Resultat::resultatsPourUnEleve($id);
        return view('eleves.voir_eleve')        
            ->with('files', $liste)
            ->with('professeur', "null")
            ->with('profs', $user->profs())
            ->with('tous', $user->tous())
            ->with('role', Auth::user()->role)
            ->with('resultats', $resultats)
            //->with('sections', $sections)
            ->with('eleve',$eleve)
            ->with('eleves',$user->liste());
    }

}
