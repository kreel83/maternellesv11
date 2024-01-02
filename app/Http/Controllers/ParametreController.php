<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\Commentaire;
use App\Models\Ecole;
use App\Models\Enfant;
use App\Models\Equipe;
use App\Models\Classe;
use App\Models\Resultat;
use App\Models\Fiche;
use App\Models\Image;
use App\Models\Section;
use App\Models\Phrase;
use App\Models\Item;
use App\Models\Event;
use App\Models\Vacance;
use Carbon\Carbon;
use App\utils\Utils;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
// use Intervention\Image\Facades\Image;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;



class ParametreController extends Controller
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

    // public function aidematernelle() {
    //     $equipes = Auth::user()->configuration->equipes;
    //     $photo = asset('img/avatar/avatarF.jpg');

    //     return view('aidematernelle.index')->with('equipes', $equipes)->with('photo', $photo);
    // }

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
        // dd($e->formatPDF());

        // $items = Item::all();
        // foreach ($items as $item) {
        //     $id = $item->image_id;
        //     $image = Image::find($id);
        //     if ($image) {
        //         $item->image_nom = $image->name;
        //         $item->save();
        //     }
        // }
        // dd('coucou', $id, $image->nom);


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
        //                     'Authorization' => 'Bearer '.env('OPENAI_API_KEY'),
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
        //                 dd($data);
        
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
            'phone' => ['max:10'],
        ], [
            'civilite.required' => 'La civilité est obligatoire.',
            'name.required' => 'Le nom est obligatoire.',
            'name.max' => 'Le nom est limité à 255 caractères.',
            'prenom.required' => 'Le prénom est obligatoire.',
            'prenom.max' => 'Le prénom est limité à 255 caractères.',
            'phone.max' => 'Le numéro de mobile est limité à 10 caractères.',
        ]);


        if ($validator->fails()) {
            session()->flash('error_profil', 'Les 3 champs sont obligatoires');
            session()->flash('error_profil_message', $validator->errors()->first());
            return redirect()->back()->withInput();
            
        }


        $user = Auth::user();
        $user->name = strtoupper($request->name);
        $user->prenom = ucfirst($request->prenom);
        $user->phone = $request->phone;
        $user->civilite = $request->civilite;
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
        // if (session()->get('id_de_la_classe') !== null) {
        if (session()->get('classe_active') !== null) {

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
            //dd($top5Eleves);
            $top5ElevesLesPlusAvances = $top5Eleves->sortByDesc('total')->take(5);
            $top5ElevesLesMoinsAvances = $top5Eleves->sortBy('total')->take(5);
            //dd($top5ElevesLesPlusAvances);
            // $top5ElevesLesPlusAvances = $resultat->top5ElevesLesPlusAvances();
            // $top5ElevesLesMoinsAvances = $resultat->top5ElevesLesMoinsAvances();

            $top5Disciplines = $resultat->top5Disciplines();
            $top5DisciplinesLesPlusAvances = $top5Disciplines->sortByDesc('total')->take(5);
            $top5DisciplinesLesMoinsAvances = $top5Disciplines->sortBy('total')->take(5);
            // $top5DisciplinesLesPlusAvances = $resultat->top5DisciplinesLesPlusAvances();
            // $top5DisciplinesLesMoinsAvances = $resultat->top5DisciplinesLesMoinsAvances();

            $listeDesEnfantsSansNote = $resultat->listeDesEnfantsSansNote();
            //$listeDesEleves = Enfant::listeDesEleves();

            //dd($top5AdvancedKids);
            $anniversaires = $anniversaires->sortBy('jour');

            $fiches = Fiche::select('section_id')->where('classe_id', session('classe_active')->id)->get();

            // $info[1] = Enfant::where('classe_id', session()->get('id_de_la_classe'))->count();
            // $info[2] = Resultat::join('enfants', 'enfants.id' ,'enfant_id')->where('notation',2)->where('enfants.classe_id', session()->get('id_de_la_classe'))->count();        
            // $info[22] = Resultat::join('enfants', 'enfants.id' ,'enfant_id')->where('autonome',0)->where('enfants.classe_id', session()->get('id_de_la_classe'))->where('notation',2)->count();        
            // $info[3] = Fiche::where('classe_id', session()->get('id_de_la_classe'))->count();
            
            // $info[1] = Enfant::where('classe_id', session('classe_active')->id)->count();
            $info[1] = $listeDesEleves->count();

            $res = Resultat::select('notation', 'autonome')
                ->join('enfants', 'enfants.id' ,'enfant_id')
                ->where('enfants.classe_id', session('classe_active')->id)
                ->get();
            $info[2] = $res->where('notation',2)->count();
            $info[22] = $res->where('notation',2)->where('autonome',0)->count();
            //dd($info[22]);
            // $info[2] = Resultat::join('enfants', 'enfants.id' ,'enfant_id')->where('notation',2)->where('enfants.classe_id', session('classe_active')->id)->count();        
            // $info[22] = Resultat::join('enfants', 'enfants.id' ,'enfant_id')->where('notation',2)->where('autonome',0)->where('enfants.classe_id', session('classe_active')->id)->count();        
            
            // $info[3] = Fiche::where('classe_id', session('classe_active')->id)->count();
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
            
            return view('welcome')
                ->with('is_abonne', session('is_abonne'))
                ->with('sections', $sections)
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
            return view('classes.createclasse')
                ->with('title','Création de ma classe');
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
        $search = Phrase::where('commentaire_id', $commentaire_id)->first();
        if ($search) return 'ko';
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
}
