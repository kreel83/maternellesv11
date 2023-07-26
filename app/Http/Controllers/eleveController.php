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

class eleveController extends Controller
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


    public function removeEleve(Request $request) {
        
            $e = Enfant::find($request->eleve);
            if ($request->prof == 'null') {
                $e->delete();
            } else {
                $e->user_id = null;
                $e->save();

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
        $user = Auth::user();
        $datas = $request->except(['_token']);
        $datas['mail'] = join(';', $datas['mail']);
        $datas['user_id'] = Auth::id();
        $datas['nom'] = mb_strtoupper($datas['nom']);
        $datas['prenom'] = ucfirst($datas['prenom']);
        if ($request->file('photo')) {
            $folder = $user->repertoire.'/photos/'.uniqid().'.jpg';
            $path = Storage::path($folder);
            $photo = $request->file('photo');
            $img = Image::make($photo)->encode('jpg', 75);;
            $img->fit(200, 200, function ($constraint) {
                $constraint->upsize();
            });
            $img->save($path);
            $datas['photo'] = $folder;
        }

        $datas['annee_scolaire'] = Auth::user()->calcul_annee_scolaire();

        Enfant::updateOrCreate(['id' => $datas['id']], $datas);
        return redirect()->back();
    }
}
