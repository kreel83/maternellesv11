<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\Commentaire;
use App\Models\Ecole;
use App\Models\Resultat;
use App\Models\Fiche;
use App\Models\Section;
use App\Models\Phrase;
use App\Models\ClasseMail;
use App\Models\Enfant;
use App\Models\Event;
use App\Models\Help;
use App\Models\Vacance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Validation\Rules;

class ParametreController extends Controller
{

    public $maclasseactuelle;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {   
            $this->maclasseactuelle = session('classe_active');
            return $next($request);
        });
    }

    public function activeSectionDevenirEleve() {
        session('classe_active')->desactive_devenir_eleve = 0;
        session('classe_active')->save();
        return 'ok';
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
        
        $this->maclasseactuelle->equipes = $liste;
        $this->maclasseactuelle->save();

        return redirect()->back()->withInput();
    }


    private function chatpht($reussite) {            

        $content = "Can you transform the following sentence with the first name \"Lucie\" who is a girl : ".$reussite;

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

        // $e = Enfant::first();

        // $items = Item::all();
        // foreach ($items as $item) {
        //     $id = $item->image_id;
        //     $image = Image::find($id);
        //     if ($image) {
        //         $item->image_nom = $image->name;
        //         $item->save();
        //     }
        // }


        // $c = Item::all();
        // foreach ($c as $cc) {
        //     if (str_contains($cc->phrase_masculin, "Il ")) {
        //         $cc->phrase_masculin = str_replace("Il ", "Tom ", $cc->phrase_masculin);
                
        //     }
        //     if (str_contains($cc->phrase_feminin, "Elle ")) {
        //         $cc->phrase_feminin = str_replace("Elle ", "Lucie ", $cc->phrase_feminin);
        //     }
        //     $cc->save();


        // }
        // $c = Commentaire::all();
        // foreach ($c as $cc) {
        //     if (str_contains($cc->phrase_masculin, "l'élève ")) {
        //         $cc->phrase_masculin = str_replace("l'élève ", "Tom ", $cc->phrase_masculin);
                
        //     }
        //     if (str_contains($cc->phrase_feminin, "l'élève ")) {
        //         $cc->phrase_feminin = str_replace("l'élève ", "Lucie ", $cc->phrase_feminin);
        //     }
        //     $cc->save();


        // }

        //Fiche::createDemoFiche(Auth::user());



        //  $coms = Item::all();
        //  foreach ($coms as $com) {
        //      if (($com->phrase_feminin == null) && ($com->phrase_masculin != null)) {
        //          //$com->phrase_feminin = $com->phrase_masculin;
        //          $com->phrase_feminin = $this->chatpht($com->phrase_masculin);
        //          $com->save();

        //      }
        //  }

         

        // function chat($p): JsonResponse
        //     {
        //         $search = $p;
        
        //         $data = Http::withHeaders([
        //                     'Content-Type' => 'application/json',
        //                     'Authorization' => 'Bearer '.config('openai.api_key'),
        //                 ])
        //                 ->post("https://api.openai.com/v1/chat/completions", [
        //                     "model" => "gpt-3.5-turbo",
        //                     'messages' => [
        //                         [
        //                         "role" => "user",
        //                         "content" => $search
        //                     ]
        //                     ],
        //                     'temperature' => 0.5,
        //                     "max_tokens" => 200,
        //                     "top_p" => 1.0,
        //                     "frequency_penalty" => 0.52,
        //                     "presence_penalty" => 0.5,
        //                     "stop" => ["11."],
        //                 ])
        //                 ->json();
        //                 $datadd();
        
        //         return response()->json($data['choices'][0]['message'], 200, array(), JSON_PRETTY_PRINT);
        //     }


        //     dd(chat("Can you help me feminize the following sentence: l'élève parle en faisant des phrases simples (sujet, verbe, complément)."));



        // $coms = Item::all();
        // foreach ($coms as $com) {

            
        //         $com->phrase_feminin = $this->chatpht($com->phrase_masculin);
        //         $com->save();
        //         break;


        // }





        // $cs = Item::all();
        // foreach($cs as $item) {
        //     $r = $item->phrase;
        //     $r = str_replace("@pronom@","il", $r);
            
        //     $item->phrase = $r;
        //     $item->save();
        // }

        $user = Auth::user();

        
        
        $ecole = Ecole::select('nom_etablissement','adresse_1','adresse_2','adresse_3','telephone')
            ->where('identifiant_de_l_etablissement', $this->maclasseactuelle->ecole_identifiant_de_l_etablissement)
            ->first();
        $adresseEcole[] = $ecole->nom_etablissement;
        if($ecole->adresse_1 != '') { $adresseEcole[] = $ecole->adresse_1; }
        if($ecole->adresse_2 != '') { $adresseEcole[] = $ecole->adresse_2; }
        if($ecole->adresse_3 != '') { $adresseEcole[] = $ecole->adresse_3; }
        $user->photo = Storage::url($user->photo);
        
        $directeur = json_decode($this->maclasseactuelle->direction);
        $sections = Section::orderBy('ordre','ASC')->get();
        $equipes = json_decode($this->maclasseactuelle->equipes, true);


        return view('monprofil.index')
            ->with('request', $request->all() ?? [])
            ->with('periodes', $this->maclasseactuelle->periodes)
            ->with('directeur', $directeur)
            ->with('sections', $sections)
            ->with('user', $user)
            ->with('equipes', $equipes)
            ->with('adresseEcole', join(PHP_EOL,$adresseEcole));
    }


    public function activeDomaineEleve(Request $request) {

            $this->maclasseactuelle->desactive_devenir_eleve = ($request->activeDomaineEleve == 'on' ? 0 : 1);
            $this->maclasseactuelle->save();
        
        //return redirect()->back()->with('success','Le domaine a bien été désactivé');
        return redirect()->back()->with('status','success')->with('msg','La configuration a été mise à jour.');
    }

    public function activehelp(Request $request) {
        

            Auth::user()->help = $request->state == 'false' ? 0 : 1;
            Auth::user()->save();
        
        //return redirect()->back()->with('success','Le domaine a bien été désactivé');
        return redirect()->back()->with('status','success')->with('msg','La configuration a été mise à jour.');
    }

    public function activeAcquisAide(Request $request) {
        $this->maclasseactuelle->desactive_acquis_aide = ($request->activeAcquisAide == 'on' ? 0 : 1);
        $this->maclasseactuelle->save();
    
    return redirect()->back()->with('status','success')->with('msg','La configuration a été mise à jour.');
}

    public function get_phrases(Request $request) {
        $c = Commentaire::find($request->id);
        $c->phrase_masculin = str_replace("L'élève","Léon", $c->phrase_masculin);
        $c->phrase_feminin = str_replace("L'élève","Lucie", $c->phrase_feminin);
        return[$c->phrase_masculin, $c->phrase_feminin];
    }

    public function savedirecteur(Request $request) {
     

        $validated = $request->validate([
            'prenom' => 'required',
            'nom' => 'required',
        ],[
            'prenom.required' => 'Le prénom est obligatoire.',
            'nom.required' => 'Le nom est obligatoire.'
        ]);
        $r = $request->except(['_token']);
        $r = json_encode($r);

        $this->maclasseactuelle->direction = $r;
        $this->maclasseactuelle->save();
        return redirect()->back()->with('status','success')->with('msg','La configuration a été mise à jour.');
        //return redirect()->back()->withInput();
    }

    public function savemonprofil(Request $request) {
      

        $validator = Validator::make($request->all(), [
            'civilite' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            //'phone' => ['max:10'],
        ], [
            'civilite.required' => 'La civilité est obligatoire.',
            'name.required' => 'Le nom est obligatoire.',
            'name.max' => 'Le nom est limité à 255 caractères.',
            'prenom.required' => 'Le prénom est obligatoire.',
            'prenom.max' => 'Le prénom est limité à 255 caractères.',
            //'phone.max' => 'Le numéro de mobile est limité à 10 caractères.',
        ]);


        if ($validator->fails()) {
            session()->flash('error_profil', 'Les 3 champs sont obligatoires');
            session()->flash('error_profil_message', $validator->errors()->first());
            return redirect()->back()->withInput();
            
        }


        $user = Auth::user();
		$user->civilite = $request->civilite;
        $user->name = strtoupper($request->name);
        $user->prenom = ucfirst($request->prenom);
        //$user->phone = $request->phone;
        //$user->nom_ecole = ucfirst($request->nom_ecole);
        //$user->adresse_ecole = ucfirst($request->adresse_ecole);
        // $user->nom_directeur = ucfirst($request->nom_directeur);
        // $user->directeur = (int) $request->directeur;


        $user->save();
        //return redirect()->back()->withInput();
        return redirect()->back()->with('status','success')->with('msg','Votre profil a été mis à jour.');

    }

    public function welcome(): View
    {
        if (Auth::user()->classe_id) {
            $date = Carbon::now();
            $mois = $date->locale('fr')->monthName;
            $nb = $date->month;
            $listeDesEleves = Auth::user()->liste();
            $anniversaires = $listeDesEleves->filter(function ($enfant) use ($nb) {
                if ($enfant->ddn) {
                    $m = explode('-', $enfant->ddn);
                    return ($m[1] == $nb);
                }
            })->values();

            $conges = array();
            $vacances = Vacance::listeDesProchainesVacances();
           
            foreach($vacances as $vacance) {
                $conges[] = array(
                    'date' => $vacance->start_date, 
                    'description' => $vacance->description,
                    'type' => 'conges'
                );
            }
            // Récupération des prochains évènements du calendrier
            $events = Event::listeDesProchainsEvenements();
            foreach($events as $event) {
                $conges[] = array(
                    'date' => $event->date, 
                    'description' => $event->name,
                    'type' => 'event'
                );
            }
            // Mise en collection / tri par date / 5 prochains à venir
            $conges = collect($conges)->sortBy('date')->take(5);

            $resultat = new Resultat;
            $top5Eleves = $resultat->top5Eleves();
            $top5ElevesLesPlusAvances = $top5Eleves->sortByDesc('total')->take(5);
            $top5ElevesLesMoinsAvances = $top5Eleves->sortBy('total')->take(5);

            $top5Disciplines = $resultat->top5Disciplines();
            $top5DisciplinesLesPlusAvances = $top5Disciplines->sortByDesc('total')->take(5);
            $top5DisciplinesLesMoinsAvances = $top5Disciplines->sortBy('total')->take(5);

            $listeDesEnfantsSansNote = $resultat->listeDesEnfantsSansNote();

            $anniversaires = $anniversaires->sortBy('jour');

            $fiches = Fiche::select('section_id')->where('classe_id', session('classe_active')->id)->get();

            $info[1] = $listeDesEleves->count();

            $res = Resultat::select('notation', 'autonome')
                ->join('enfants', 'enfants.id' ,'enfant_id')
                ->where('enfants.classe_id', session('classe_active')->id)
                ->get();
            $info[2] = $res->where('notation',2)->count();
            $info[22] = $res->where('notation',2)->where('autonome',0)->count();
            $info[3] = $fiches->count();

            $middle = (int) $listeDesEleves->count() / 2;

            $sections = Section::select('id', 'color', 'name', 'logo', 'icone')
                ->orderBy('ordre')
                ->get();

            // Calcul le nombre de fiches par section en avance pour optimiser le blade
            $nombreDeFichesParSection = array();
            foreach ($sections as $section) {
                $n = $fiches->where('section_id', $section->id)->count();
                $nombreDeFichesParSection[$section->id] = $n;
            }

            $is_partage_en_cours = Auth::user()->check_is_partage_en_cours();

            return view('welcome')
                ->with('is_abonne', session('is_abonne'))
                ->with('sections', $sections)
                ->with('is_partage_en_cours', $is_partage_en_cours)
                ->with('nombreDeFichesParSection', $nombreDeFichesParSection)
                ->with('conges', $conges)
                ->with('middle', $middle)
                ->with('lesgroupes', $this->maclasseactuelle->groupes)
                ->with('info', $info)
                ->with('listeDesEleves', $listeDesEleves)
                ->with('top5DisciplinesLesPlusAvances', $top5DisciplinesLesPlusAvances)
                ->with('top5DisciplinesLesMoinsAvances', $top5DisciplinesLesMoinsAvances)
                ->with('top5ElevesLesPlusAvances', $top5ElevesLesPlusAvances)
                ->with('top5ElevesLesMoinsAvances', $top5ElevesLesMoinsAvances)
                ->with('listeDesEnfantsSansNote', $listeDesEnfantsSansNote)
                ->with('anniversaires', $anniversaires)
                ->with('moisActuel', $mois);
        } else {
            $check_partage = Auth::user()->check_partage();
            
            if ($check_partage == 'rewind') {
                $this->welcome();

            } 
            return view('classes.createclasse')
                ->with('title','Nouvelle Classe')
                ->with('liste', $check_partage);
        }

    }

    public function error() {
        return view('errors.error');
    }

    public function index() {
        return view('home.parametres');
    }

    public function deletePhrase($commentaire_id) {
        $c = Commentaire::find($commentaire_id);        

        $c->delete();
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
        $sections = Section::orderBy('ordre')->get();

        return view('parametres.phrases.index')
            ->with('sections', $sections)
            ->with('section', $section)
            ->with('commentaires', $commentaires);
            
    }

    public function savePhrases(Request $request) {
        $user = Auth::id();
        $section = $request->section;

        
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

        //return view('parametres.reset-password');
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
        // session()->flash('success', 'Le mot de passe a bien été réinitalisé');
        //session()->flash('message', 'Le mot de passe a bien été réinitalisé'); 
        //session()->flash('alert-class', 'alert-success'); 
        return redirect()->route('depart')->with('status','success')->with('msg','Le mot de passe a bien été modifié.');
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

    public function parametresClasse() {
        $directeur = json_decode($this->maclasseactuelle->direction);
        $sections = Section::orderBy('ordre','ASC')->get();
        $equipes = json_decode($this->maclasseactuelle->equipes, true);
        return view('classes.parametres')
            ->with('periodes', $this->maclasseactuelle->periodes)
            ->with('directeur', $directeur)
            ->with('sections', $sections)
            ->with('equipes', $equipes);
    }

    public function help($location) {
        $help = Help::where('location', $location)->first();
        if ($help) return $help->texte;
        return 'Aucune information disponible';
    }

    public function parametresMails() {
        $customMail = ClasseMail::where('classe_id', session('classe_active')->id)->first();
        return view('parametresMails.index')->with('message', $customMail->message ?? null);
    }

    public function saveCustomMail(Request $request) {
        if ($request->quill) {
            $customMail = ClasseMail::where('classe_id', session('classe_active')->id)->first();
            if($request->quill == '<p><br></p>') {
                if ($customMail) {
                    $customMail->delete();
                }
            } else {
                $customMail = ClasseMail::where('classe_id', session('classe_active')->id)->first();
                if (!$customMail) {
                    $customMail = new ClasseMail();
                }
                $customMail->classe_id = session('classe_active')->id;
                $customMail->message = $request->quill;
                $customMail->save();   
            }
        }
    }
}
