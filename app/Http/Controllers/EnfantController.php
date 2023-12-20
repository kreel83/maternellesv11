<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Enfant;
use App\Models\Resultat;
use App\Models\Section;
use App\Models\Classe;
use PDF;
use Illuminate\Http\Request;
use App\Models\Reussite;
use Illuminate\Support\Facades\Auth;
use File;
//use Illuminate\Support\Facades\Storage;
//use Intervention\Image\Facades\Image;
use Illuminate\Support\Arr;
//use Illuminate\Support\Collection;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
//use Illuminate\View\View;

class EnfantController extends Controller

{

    public $maclasseactuelle;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {   
            
            $this->maclasseactuelle = Classe::find(session()->get('id_de_la_classe'));
            return $next($request);
            });
    }
    private  function generateRandomString($length1, $length2) {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numbers = '0123456789';
        $charactersLength = strlen($characters);
        $numbersLength = strlen($numbers);
        $randomString = '';
        for ($i = 0; $i < $length1; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        for ($i = 0; $i < $length2; $i++) {
            $randomString .= $numbers[rand(0, $numbersLength - 1)];
        }
        return $randomString;
    }


    public function parent() {
        return view('parent.parent');
    }


    public function parent_mdp(Request $request) {
        $enfant = Enfant::where('mdp', $request->mdp)->first();
        if ($enfant) return view('parent.pdf');
        return redirect()->back()->withError('non non non ');
    }


    public function import() {
        $ecole = $this->maclasseactuelle->ecole_identifiant_de_l_etablissement;
        $enfants = Enfant::whereNull('user_id')->get();
        $profs = User::where('ecole_identifiant_de_l_etablissement', $ecole)->get();
        return view('eleves.import')
            ->with('profs', $profs)
            ->with('enfants', $enfants);
    }

    public function reussite(Request $request) {

        $enfants = Enfant::where('user_id', Auth::id())->get();
        $ordre = $request->ordre ?? 'alpha';
        switch($ordre) {
            case 'age' : $enfants = Enfant::where('user_id', Auth::id())->orderBy('ddn','DESC')->get();break;
            case 'alpha' : $enfants = Enfant::where('user_id', Auth::id())->orderBy('prenom')->get();break;
            case 'groupe' : $enfants = Enfant::where('user_id', Auth::id())->get();$enfants = $enfants->groupBy('groupe');break;
        }
        

        // Verifie les cahiers de reussite pour savoir si ils sont tous faits
        // non existant dans la table / definitif = 0
        // Ok si nombre de cahiers avec defintif = 1 est égal au nombre d'enfants dans la classe
        $nbEnfants = Enfant::where([
            ['user_id', Auth::id()],
            ['reussite_disabled', 0]
        ])->count();
        $nbReussite = Reussite::where([
            ['user_id', Auth::id()],
            ['definitif', 1],
        ])->count();
        // bool flag pour autoriser l'envoi des PDFs
        $canSendPDF = ($nbEnfants == $nbReussite);

    // foreach ($enfants as $enfant) {
    //     $degrade = Enfant::DEGRADE;
    //     $enfant->background = array_rand($degrade);
    //     $files = File::files(public_path('img/animaux'));
    //     $liste = array();
    //     foreach ($files as $file) {
    //         $liste[] = $file->getFileName();
    //     }
    //     $k = array_rand($liste);
        
    //     $enfant->photo = $liste[$k];
    //     $enfant->save();
    // }

        $avatar = '/storage/'.Auth::user()->repertoire.'/photos/avatarF.jpg';
        
        return view('reussite.index')
            ->with('canSendPDF', $canSendPDF)
            ->with('ordre', $ordre )
            ->with('enfants', $enfants)
            ->with('avatar', $avatar);
    }

    public function index(Request $request) {
        
        
        
        if (in_array($request->type,["evaluation","reussite"])) {

            $enfants = Enfant::where('classe_id', session()->get('id_de_la_classe'))->where("reussite_disabled",0);
        } else {
            $enfants = Enfant::where('classe_id', session()->get('id_de_la_classe'));
            
            
            if ($this->maclasseactuelle->groupes && $request->type == 'affectation_groupe') {
                return view('enfants.no_groupes')->with('type', $request->type);
            }

        }
        $ordre = $request->ordre ?? 'alpha';
        switch($ordre) {
            case 'age' : $enfants = $enfants->orderBy('ddn','DESC')->get();break;
            case 'alpha' : $enfants = $enfants->orderBy('prenom')->get();break;
            case 'groupe' : $enfants = $enfants->get();$enfants = $enfants->groupBy('groupe');break;
        }
        $nbEnfants = Enfant::where([
            ['user_id', Auth::id()],
            ['reussite_disabled', 0]
        ])->count();
        $nbReussite = Reussite::where([
            ['user_id', Auth::id()],
            ['definitif', 1],
        ])->count();
        $canSendPDF = ($nbEnfants == $nbReussite);
        $avatar = '/storage/'.Auth::user()->repertoire.'/photos/avatarF.jpg';
       
       
        
        return view('enfants.index')
            ->with('type', $request->type)
            ->with('ordre', $ordre)
            ->with('canSendPDF', $canSendPDF)
            ->with('enfants', $enfants)
            ->with('avatar', $avatar);
    }


    public function password() {
        $user = Auth::user();
        $enfants = $user->liste();
        return view('password.index')->with('enfants', $enfants);
    }

    public function password_operation(Request $request) {
        $datas = $request->except(['_token']);
        $enfants = Enfant::whereIn('id', $datas['enfants'])->get();
        if ($datas['submit'] == 'password') {
            foreach ($enfants as $enfant) {
                $enfant->mdp = $this->generateRandomString(6,2);
                $enfant->save();
            }
        } else {
            $pdf = PDF::loadView('pdf.mdp', ['enfants' => $enfants]);
            return $pdf->stream('liste_mots_de_passe.pdf');
        }


        return redirect()->back();
    }


    public function password_pdf() {
        dd('coucou');
    }

    //***************************************************************************** */
    // Ci-dessous ANCIENNEMENT eleveController.php
    //***************************************************************************** */

    public function avatarEleve($enfant_id) {
        $user = Auth::user();
        $enfant = Enfant::find($enfant_id);

        $degrades = Enfant::DEGRADE;
        $files = File::files(public_path('img/animaux'));
        $liste = array();
        foreach ($files as $file) {
            $liste[] = $file->getFileName();
        }

        return view('photos.index')
            ->with('enfant',$enfant)
            ->with('degrades',$degrades)
            ->with('type','avatar')
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

    public function liste(Request $request) {
        if ($request->enfant_id) {
            $e = Enfant::find($request->enfant_id);
            if (!$e || $e->user_id != Auth::id()) {
                return dd('false');
            }
        }
        $user = Auth::user();
        $files = File::files(public_path('img/animaux'));
        $liste = array();
        foreach ($files as $file) {
            $liste[] = $file->getFileName();
        }


        return view('eleves.liste')
            ->with('periodes', $this->getPeriode($this->maclasseactuelle->periodes))
            ->with('files', $liste)
            ->with('modif', $request->enfant_id)
            ->with('professeur', "null")
            ->with('profs', $user->profs())
            ->with('tous', $user->tous())
            ->with('eleves',$user->liste())
            ->with('eleve', new Enfant());
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
                $e->psmsgs = $e->prevSection($e->psmsgs);
                $e->save();
                return redirect()->route('maclasse')
                    ->with('message', "L'élève a été retiré de votre classe")
                    ->with('alert-class', 'alert-danger');
            } else {
                $e->delete();
                return redirect()->route('maclasse')
                    ->with('message', "La fiche de l'élève a été supprimée")
                    ->with('alert-class', 'alert-danger');
            }

        

    }

    public function toggleInactiveEleve(Request $request) {
        $eleve = Enfant::find($request->id);
        $eleve->reussite_disabled = $eleve->reussite_disabled == 1 ? 0 : 1;
        $eleve->save();
        return 'ok';


    }

    public function ajouterEleves(Request $request) {
        $eleves = array_filter($request->eleves);
        
        foreach ($eleves as $eleve) {
            $e = Enfant::find($eleve);
            $e->user_id = Auth::id();
            $e->psmsgs = $e->nextSection($e->psmsgs);
            $e->save();
        }
        return view('eleves.include.tableau_eleves')->with('eleves', Auth::user()->liste());

    }

    private function getPeriode($a) {

       
        
        $periodes = $this->maclasseactuelle->periodes;

        $periode = 
        [ 1 => [
           'Année entière' 
        ], 2 => ['Premier semestre','Second semestre'], 
        3 => ['Premier trimestre','Deuxième trimestre','Troisième trimestre']];



     
        return $periode[$a];
   


}


    public function getAnneeEnCours() {
        
        $periodes = $this->maclasseactuelle->periodes;

        return view('eleves.include.getAnneeEnCours')->with('periodes', $this->getPeriode($periodes));
    }




    // public function save(Request $request) {       

   
    //     $rules = [
    //         'nom' => ['required', 'string', 'max:255'],
    //         'prenom' => ['required', 'string', 'max:255'],
    //         'ddn' => ['required', 'date'],
            
    //         'mail1' => ['email:rfc,dns','nullable'],
    //         'mail2' => ['email:rfc,dns','nullable'],
    //         'mail3' => ['email:rfc,dns','nullable'],
    //         'mail4' => ['email:rfc,dns','nullable']
            
    //     ];
    //     $messages = [
            
    //         'nom.required' => 'Le nom est obligatoire.',
    //         'nom.max' => 'Le nom est limité à 255 caractères.',
    //         'prenom.required' => 'Le prénom est obligatoire.',
    //         'prenom.max' => 'Le prénom est limité à 255 caractères.',
    //         'ddn.required' => 'La date de naissance est obligatoire',
    //         'mail.*.email' => 'Ce mail semble ne pas etre correct',
    //         'mail1.email' => 'Ce mail semble ne pas etre correct',
    //         'mail2.email' => 'Ce mail semble ne pas etre correct',
    //         'mail3.email' => 'Ce mail semble ne pas etre correct',
    //         'mail4.email' => 'Ce mail semble ne pas etre correct'

    //     ];

    //     $validator = Validator::make($request->all(), $rules, $messages);

    //     if ($validator->fails()) {
    //         return ['state'=>false,'error_description'=>'validator failed','errors'=>$validator->errors()];
            
    //     }

    //     $datas = $request->except(['_token']);


    //     $datas['mail'] = join(';', array_filter([$datas['mail1'],$datas['mail2'],$datas['mail3'],$datas['mail4']]));
    //     $datas['mail'] = $datas['mail'] == '' ? null : $datas['mail'];

    //     $datas['user_id'] = Auth::id();
    //     $datas['sh'] = $datas['sh'] == 'true' ? 1 : 0;
    //     $datas['nom'] = mb_strtoupper($datas['nom']);
    //     $degrade = Enfant::DEGRADE;
    //     $datas['background'] = array_rand($degrade);
    //     $files = File::files(public_path('img/animaux'));
    //     $liste = array();
    //     foreach ($files as $file) {
    //         $liste[] = $file->getFileName();
    //     }
    //     $k = array_rand($liste);
        
    //     $datas['photo'] = $liste[$k];
    //     $datas['prenom'] = ucfirst($datas['prenom']);
    //     $datas['annee_scolaire'] = Auth::user()->calcul_annee_scolaire();
    //     unset($datas['mail1']);
    //     unset($datas['mail2']);
    //     unset($datas['mail3']);
    //     unset($datas['mail4']);
    //     Enfant::updateOrCreate(['id' => $datas['id']], $datas);

    //     return ['state'=>true];
    // }

    public function enregistre(Request $request) {

        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'ddn' => ['required', 'date'],
            'psmsgs' => ['required'],
            'mail1' => ['email:rfc,dns','nullable'],
            'mail2' => ['email:rfc,dns','nullable'],
            'mail3' => ['email:rfc,dns','nullable'],
            'mail4' => ['email:rfc,dns','nullable'],
        ], [
            'nom.required' => 'Le nom est obligatoire.',
            'nom.max' => 'Le nom est limité à 255 caractères.',
            'prenom.required' => 'Le prénom est obligatoire.',
            'prenom.max' => 'Le prénom est limité à 255 caractères.',
            'ddn.required' => 'La date de naissance est obligatoire',
            'psmsgs.required' => 'La section est obligatoire',
            'mail1.email' => 'Le mail principal ne semble pas correct',
            'mail2.email' => 'Le mail secondaire ne semble pas correct',
            'mail3.email' => 'Le mail additionnel ne semble pas correct',
            'mail4.email' => 'Le mail additionnel ne semble pas correct'
        ]);

        $datas = $request->except(['_token']);
        //dd($datas);
        $datas['user_id'] = Auth::id();

        $datas['mail'] = join(';', array_filter([$datas['mail1'],$datas['mail2'],$datas['mail3'],$datas['mail4']]));
        $datas['mail'] = $datas['mail'] == '' ? null : $datas['mail'];
        $datas['sh'] =  (Arr::exists($datas, 'sh')) ? 1 : 0;
        //$datas['sh'] = $datas['sh'] == 'true' ? 1 : 0;
        $datas['nom'] = mb_strtoupper($datas['nom']);
        $datas['prenom'] = ucfirst($datas['prenom']);
        $datas['classe_id'] = session()->get('id_de_la_classe');
        $degrade = Enfant::DEGRADE;
        $datas['background'] = array_rand($degrade);
        $files = File::files(public_path('img/animaux'));
        $liste = array();
        foreach ($files as $file) {
            $liste[] = $file->getFileName();
        }
        $k = array_rand($liste);
        $datas['photo'] = $liste[$k];
        $datas['annee_scolaire'] = Auth::user()->calcul_annee_scolaire();
        unset($datas['mail1']);
        unset($datas['mail2']);
        unset($datas['mail3']);
        unset($datas['mail4']);
        unset($datas['backUrl']);
        //dd($datas);
        Enfant::updateOrCreate(['id' => $datas['id']], $datas);
        //return ['state'=>true];
        return redirect()->route('maclasse');
    }

    public function addEleve() {
        $user = Auth::user();
        $files = File::files(public_path('img/animaux'));
        $liste = array();
        foreach ($files as $file) {
            $liste[] = $file->getFileName();
        }
        $datas = array(
            'id' => 'new',
            'genre' => null,
            'sh' => null,
            'psmsgs' => null,
            'nom' => null,
            'prenom' => null,
            'ddn' => null,
            'comment' => null,
            'mail1' => null,
            'mail2' => null,
            'mail3' => null,
            'mail4' => null,
        );
        $resultats = new Resultat();
        $sections = Section::all();
        return view('eleves.fiche')
            ->with('flag', 'disabled')
            ->with('periodes', $this->getPeriode($this->maclasseactuelle->periodes))        
            ->with('files', $liste)
            ->with('professeur', "null")
            ->with('profs', $user->profs())
            ->with('tous', $user->tous())
            ->with('role', Auth::user()->role)
            ->with('resultats', $resultats)
            ->with('sections', $sections)
            ->with('backUrl', URL::previous())
            ->with('eleve', $datas)
            ->with('eleves',$user->liste());
    }

    public function voirEleve($enfant_id) {
        $user = Auth::user();
        $files = File::files(public_path('img/animaux'));
        $liste = array();
        foreach ($files as $file) {
            $liste[] = $file->getFileName();
        }        
        $enfant = Enfant::find($enfant_id);
        $datas = array(
            'id' => $enfant->id,
            'genre' => $enfant->genre,
            'sh' => $enfant->sh,
            'psmsgs' => $enfant->psmsgs,
            'nom' => $enfant->nom,
            'prenom' => $enfant->prenom,
            'ddn' => $enfant->ddn,
            'comment' => $enfant->comment,
            'user_n1_id' => $enfant->user_n1_id,
            'mail1' => $enfant->mail1,
            'mail2' => $enfant->mail2,
            'mail3' => $enfant->mail3,
            'mail4' => $enfant->mail4,
        );
        $resultats = Resultat::resultatsPourUnEleve($enfant_id);
        $sections = Section::all();
        session(['backUrl' => URL::previous()]);
        return view('eleves.fiche')
            ->with('flag', 'disabled')
            ->with('periodes', $this->getPeriode($this->maclasseactuelle->periodes))        
            ->with('files', $liste)
            ->with('professeur', "null")
            ->with('profs', $user->profs())
            ->with('tous', $user->tous())
            ->with('role', Auth::user()->role)
            ->with('resultats', $resultats)
            ->with('sections', $sections)
            ->with('backUrl', URL::previous())
            ->with('eleve', $datas)
            ->with('eleves',$user->liste());
    }
    /*
    public function voirEleve($enfant_id) {
        $user = Auth::user();
        $files = File::files(public_path('img/animaux'));
        $liste = array();
        foreach ($files as $file) {
            $liste[] = $file->getFileName();
        }
        $eleve = Enfant::find($enfant_id);
        $resultats = Resultat::resultatsPourUnEleve($enfant_id);
        return view('eleves.voir_eleve')
            ->with('flag', 'disabled')
            ->with('periodes', $this->getPeriode($user->configuration->periodes))        
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
    */

    public function maclasse() {
        $listeDesEleves = Enfant::listeDesEleves();                

        $middle = (int) $listeDesEleves->count() / 2;
        return view('maclasse.index')
                    ->with('middle', $middle)
                    ->with('listeDesEleves', $listeDesEleves);
    }
}
