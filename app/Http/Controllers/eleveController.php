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
    public function avatarEleve($id) {
        $user = Auth::user();
        $enfant = Enfant::find($id);

        $degrades = Enfant::DEGRADE;
        $files = File::files(public_path('img/animaux'));
        $liste = array();
        foreach ($files as $file) {
            $liste[] = $file->getFileName();
        }

        return view('photos.index')
            ->with('enfant',$enfant)
            ->with('degrades',$degrades)
            ->with('files', $liste);
    }
    public function avatar() {
        $user = Auth::user();

        $degrades = Enfant::DEGRADE;
        $files = File::files(public_path('img/animaux'));
        $liste = array();
        foreach ($files as $file) {
            $liste[] = $file->getFileName();
        }

        return view('avatar.index')
            ->with('enfants',$user->liste())
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

   
        

   
        $rules = [
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'ddn' => ['required', 'date'],
            'mail1' => ['email:rfc,dns','nullable'],
            'mail2' => ['email:rfc,dns','nullable']
            
        ];
        $messages = [
            'nom.required' => 'Le nom est obligatoire.',
            'nom.max' => 'Le nom est limité à 255 caractères.',
            'prenom.required' => 'Le prénom est obligatoire.',
            'prenom.max' => 'Le prénom est limité à 255 caractères.',
            'ddn.required' => 'La date de naissance est obligatoire',
            'mail.*.email' => 'Ce mail semble ne pas etre correct',
            'mail1.email' => 'Ce mail semble ne pas etre correct !!!',
            'mail2.email' => 'Ce mail semble ne pas etre correct !!!'

        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return ['state'=>false,'error_description'=>'validator failed','errors'=>$validator->errors()];
            
        }
       

        $datas = $request->except(['_token']);

        $datas['mail'] = join(';', array_filter([$datas['mail1'],$datas['mail2']]));
        $datas['user_id'] = Auth::id();
        $datas['sh'] = $datas['sh'] == 'true' ? 1 : 0;
        $datas['reussite'] = $datas['reussite'] == 'true' ? 1 : 0;
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
        unset($datas['mail1']);
        unset($datas['mail2']);
        Enfant::updateOrCreate(['id' => $datas['id']], $datas);
        return ['state'=>true];
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
