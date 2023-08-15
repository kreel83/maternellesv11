<?php

namespace App\Http\Controllers;

use App\Models\Enfant;
use App\Models\Resultat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use File;

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

        $datas = $request->except(['_token']);
        
        $datas['mail'] = join(';', array_filter($datas['mail']));
        $datas['user_id'] = Auth::id();
        $datas['nom'] = mb_strtoupper($datas['nom']);
        $datas['prenom'] = ucfirst($datas['prenom']);
        $datas['annee_scolaire'] = Auth::user()->calcul_annee_scolaire();
        Enfant::updateOrCreate(['id' => $datas['id']], $datas);
        return redirect()->back();
    }
}
