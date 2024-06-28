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
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\URL;

class EnfantController extends Controller
{

    public $maclasseactuelle;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {   
            
            // $this->maclasseactuelle = Classe::find(session()->get('id_de_la_classe'));
            $this->maclasseactuelle = session('classe_active');
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


    public function removeGroupe($enfant_id) {
        $enfant = Enfant::find($enfant_id);        
        $enfant->groupe = null;
        $enfant->save();
        return 'ok';
    }

    public function parent_mdp(Request $request) {
        $enfant = Enfant::where('mdp', $request->mdp)->first();
        if ($enfant) return view('parent.pdf');
        return redirect()->back()->withError('non non non ');
    }


    public function import() {
        $ecole = $this->maclasseactuelle->ecole_identifiant_de_l_etablissement;
        $users = User::where('ecole_identifiant_de_l_etablissement', $ecole)->pluck('id');

        $enfants = Enfant::whereNull('classe_id')->whereIn('classe_n1_id', $users)->get();
        $classes = Classe::where('ecole_identifiant_de_l_etablissement', $ecole)->get();
        $classes_array = Classe::where('ecole_identifiant_de_l_etablissement', $ecole)->pluck('id');
        $enfants = Enfant::whereIn('classe_n1_id', $classes_array)->whereNull('classe_id')->get();
       
        
        return view('eleves.import')
            ->with('classes', $classes)
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

        if (!in_array($request->type, ["evaluation", "reussite", "avatar", "affectation_groupe", "synthese"])) {
            abort(404);
        }
       
        if (in_array($request->type, ["synthese"])) {
            $enfants = Enfant::where('classe_id', session('classe_active')->id)->where("psmsgs","gs");
        } 
        if (in_array($request->type, ["evaluation", "reussite"])) {
            $enfants = Enfant::where('classe_id', session('classe_active')->id)->where("reussite_disabled",0);
        } 
        if (in_array($request->type, ['avatar','affectation_groupe'])) {
            $enfants = Enfant::where('classe_id', session('classe_active')->id);
            if (!$this->maclasseactuelle->groupes && $request->type == 'affectation_groupe') {
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
            $classe = $e->classe_n1_id;
            if ($classe) {
                $e->user_id = null;
                $e->classe_id = null;
                $e->psmsgs = $e->prevSection($e->psmsgs);
                $e->save();
                session(['is_enfants' => Classe::is_enfants()]);
                return redirect()->route('maclasse')
                    ->with('message', "L'élève a été retiré de votre classe")
                    ->with('alert-class', 'alert-danger');
            } else {
                $e->delete();
                session(['is_enfants' => Classe::is_enfants()]);
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
            $e->classe_id = $this->maclasseactuelle->id;
            $e->psmsgs = $e->nextSection($e->psmsgs);
            $e->save();
        }
        session(['is_enfants' => Classe::is_enfants()]);
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

    public function enregistre(Request $request) {

        $request->validate([
            'genre' => ['required'],
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'ddn' => ['required', 'date'],
            'psmsgs' => ['required'],
            'mail1' => ['email:rfc,dns','nullable'],
            'mail2' => ['email:rfc,dns','nullable'],
            'mail3' => ['email:rfc,dns','nullable'],
            'mail4' => ['email:rfc,dns','nullable'],
            'periode' => 'required_if:eleveCoursAnnee,1'
        ], [
            'genre.required' => 'Le genre est obligatoire.',
            'nom.required' => 'Le nom est obligatoire.',
            'nom.max' => 'Le nom est limité à 255 caractères.',
            'prenom.required' => 'Le prénom est obligatoire.',
            'prenom.max' => 'Le prénom est limité à 255 caractères.',
            'ddn.required' => 'La date de naissance est obligatoire',
            'psmsgs.required' => 'La section est obligatoire',
            'mail1.email' => 'Le mail principal ne semble pas correct',
            'mail2.email' => 'Le mail secondaire ne semble pas correct',
            'mail3.email' => 'Le mail additionnel ne semble pas correct',
            'mail4.email' => 'Le mail additionnel ne semble pas correct',
            'periode' => "La période n'est pas renseignée",
        ]);

        $datas = $request->except(['_token']);
        $datas['user_id'] = Auth::id();

        $datas['mail'] = join(';', array_filter([$datas['mail1'],$datas['mail2'],$datas['mail3'],$datas['mail4']]));
        $datas['mail'] = $datas['mail'] == '' ? null : $datas['mail'];
        $datas['sh'] =  (Arr::exists($datas, 'sh')) ? 1 : 0;
        //$datas['sh'] = $datas['sh'] == 'true' ? 1 : 0;
        $datas['nom'] = mb_strtoupper($datas['nom']);
        $datas['prenom'] = ucfirst($datas['prenom']);
        // $datas['classe_id'] = session()->get('id_de_la_classe');
        $datas['classe_id'] = session('classe_active')->id;
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

        Enfant::updateOrCreate(['id' => $datas['id']], $datas);

        session(['is_enfants' => Classe::is_enfants()]);
        if($request->backUrl) {
            return redirect($request->backUrl);
        } else {
            return redirect()->route('maclasse');
        }
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
            'periode' => 1
        );
        $resultats = new Resultat();
        $sections = Section::all();
       
        return view('eleves.fiche')
            ->with('flag', 'disabled')
            ->with('periodes', $this->getPeriode($this->maclasseactuelle->periodes))        
            ->with('files', $liste)
            ->with('professeur', "null")
            ->with('profs', $user->profs())
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
            'mail1' => $enfant->mail1,
            'mail2' => $enfant->mail2,
            'mail3' => $enfant->mail3,
            'mail4' => $enfant->mail4,
            'classe_n1_id' => $enfant->classe_n1_id,
            'periode' => $enfant->periode
        );
        $resultats = Resultat::resultatsPourUnEleve($enfant_id);
        $sections = Section::all();
        session(['backUrl' => URL::previous()]);
        return view('eleves.fiche')
            ->with('flag', 'disabled')
            ->with('periodes', $this->getPeriode($this->maclasseactuelle->periodes))        
            ->with('files', $liste)
            ->with('professeur', "null")
            ->with('role', Auth::user()->role)
            ->with('resultats', $resultats)
            ->with('sections', $sections)
            ->with('backUrl', URL::previous())
            ->with('eleve', $datas)
            ->with('eleves',$user->liste());
    }

    public function impression(Request $request) {
        switch ($request->type) {
            case 'alpha' : $liste = $this->maclasseactuelle->classe()->orderBy('prenom')->get();break;
            case 'date' : $liste = $this->maclasseactuelle->classe()->orderBy('ddn')->get();break;
            case 'groupe' : $liste = $this->maclasseactuelle->classe()->orderBy('prenom')->get();$liste = $liste->groupBy('groupe');$liste = $liste->flatten();break;
        }


        $annee = Auth::user()->calcul_annee_scolaire();

        $maitresse = $this->maclasseactuelle->maitresse->prenom.' '.$this->maclasseactuelle->maitresse->name;
        $data = [
            'students' => $liste,
            'classe' => $this->maclasseactuelle,
            'maitresse' => $maitresse,
            'annee' => $annee.' / '.($annee + 1 )
        ];
        

       
       

        // Load the view and pass the data
        $pdf = PDF::loadView('pdf.liste_eleve', $data);

        // Download the PDF file
        return $pdf->download('pdf.liste_eleve');

    }

    public function maclasse() {
        $listeDesEleves = Enfant::listeDesEleves();                
        $is_creator = Auth::id() == $this->maclasseactuelle->user_id;
        $middle = (int) $listeDesEleves->count() / 2;
       
        return view('maclasse.index')
            ->with('middle', $middle)
            ->with('is_creator', $is_creator)
            ->with('listeDesEleves', $listeDesEleves);
    }
}
