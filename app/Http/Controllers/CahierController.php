<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Commentaire;
use App\Models\Enfant;
use App\Models\Image;
use App\Models\Item;
use App\Models\ReussiteSection;
use App\Models\Phrase;
use App\Models\Resultat;
use App\Models\ClasseUser;
use App\Models\Ecole;
use App\Models\Reussite;
use App\Models\Section;
use App\Models\User;
use App\utils\Utils;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PDF;
use Browser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CahierController extends Controller
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

    public function toto() {
        return true;
    }

    private function format_apercu($resultats, $enfant) {
        $bloc = '';
        $sections = Section::orderBy('ordre')->pluck('id')->toArray();
        
        $sections[] = 99;

        foreach ($sections as $section) {

            $nameSection = ($section == 99) ? 'Commentaire général' : Section::find($section)->name;
            if ((isset($resultats[$section])) || (isset($commentaires[$section]))) {
                $bloc .= "<h2 contenteditable='false'>$nameSection</h2>".PHP_EOL;

            }
            if (isset($resultats[$section])) {                
                    $bloc .= $resultats[$section].PHP_EOL.PHP_EOL;               
            }


        }
      

        return $bloc;

    }




    private function getPeriode($enfant) {

       
            
            $periodes = $this->maclasseactuelle->periodes;
            $periode_actuelle = $enfant->periode;



            switch ($periodes) {
                case 1: $title = 'Année entière';break;
                case 2:
                    if ($periode_actuelle == 1) $title = 'Premier semestre';
                    if ($periode_actuelle == 2) $title = 'Second semestre';
    
                    break;
                case 3:
                    if ($periode_actuelle == 1) $title = 'Premier trimestre';
                    if ($periode_actuelle == 2) $title = 'Deuxième trimestre';
                    if ($periode_actuelle == 3) $title = 'Troisième trimestre';
                    break;
            }
         
            return [$title, $periode_actuelle];
       


    }


    private function garcon($reussite, $enfant) {
        $prenom = $enfant->prenom;        
        
        
        // $reussite = str_replace("l'élève", 'il', $reussite);
        $liste = explode(PHP_EOL, $reussite);
        foreach ($liste as $key=>$phrase) {
            if ($key != 0) {                         
                $liste[$key] = str_replace($prenom.' ', 'Il ',  $liste[$key]);                
            }            
        }


        $result = join(PHP_EOL, $liste);
       
        
        return $result;
    }

    private function fille($reussite, $enfant) {
        $prenom = $enfant->prenom;
        $liste = explode(PHP_EOL, $reussite);
        foreach ($liste as $key=>$phrase) {
            if ($key != 0) {                         
                $liste[$key] = str_replace($prenom.' ', 'Elle ',  $liste[$key]);                
            }            
        }
        $result = join(PHP_EOL, $liste);
       
        
        return $result;
    }




    // private function chatpht($reussite, $enfant) {
    //     $genre = ($enfant->genre == 'F') ? 'une fille' : 'un garçon';
    //     $content = 'Remplace le terme "élève" par "il" ou "elle" de '.$enfant->prenom.' qui est '.$genre.". Le texte à traiter est : ".$reussite;
    //     $result = OpenAI::chat()->create([
    //         'model' => 'gpt-3.5-turbo',
    //         'messages' => [
    //             ['role' => 'user', 
    //             'content' => $content],
    //         ],
           
    //     ]);
        
    //     return $result['choices'][0]['message']['content'];
    // }

    public function reactualiser($enfant_id, Request $request) {

        
        $enfant = Enfant::find($enfant_id);
        $reussite = $this->apercu($enfant);  
       
        
        $r = Reussite::where('enfant_id', $enfant_id)->first();
        if (!$r) {
            $r = new Reussite();
            $r->enfant_id = $enfant_id;
            $r->user_id = Auth::id();
            $r->definitif = 0;
        }
        $r->periode = $this->getPeriode($enfant)[1];
        $r->texte_integral = $reussite;
        $r->save();
        
        return $reussite;

    }


    // public function reformuler($enfant_id, Request $request) {
    //     $enfant = Enfant::find($enfant_id);
        
    //     $genre = ($enfant->genre == 'F') ? 'une fille' : 'un garçon';
    //     $variable = $request->quill;
    //     $result = OpenAI::chat()->create([
    //         'model' => 'gpt-3.5-turbo',
    //         'messages' => [
    //             ['role' => 'user', 
    //             'content' => "Sachant qu'un tag h2 correspond à un paragraphe et qu'il n'est pas modifiable et sachant que ".$enfant->prenom." est ".$genre.", peux-tu me récrire le texte suivant en utilisant le prénom de l'élève qu'en début de texte. l'élève est '.$genre.'. le texte : ".$variable.'"'],
    //         ],
           
    //     ]);
    //     return $result['choices'][0]['message']['content'];

    // }
    
    public function seepdf(Request $request, $token, $enfant_id = null, $periode = null, $state = 'see') {
        // si enfant_id contient l'ID de l'enfant alors token doit avoir la valeur 0 dans la route
        // WARNING !!! PDF pour Parent pas de Auth:: ni de session

        if(!is_null($enfant_id)) {
            // Fonction appelée depuis le compte user
            if(!in_array($state, ['see', 'download'])) {
                return redirect()->route('error')->with('msg', 'Fonction invalide');
            }
            $classe = session('classe_active');
            $enfant = Enfant::where('id', $enfant_id)->where('user_id', session('classe_active')->user_id)->first();
            if($enfant && filter_var($periode, FILTER_VALIDATE_INT) !== false) {
                $id = $enfant->id;
            } else {
                return redirect()->route('error')->with('msg', 'Données incorrectes.');
            }
        } else {
            // Fonction appelée depuis l'espace parent            
            $enfant = Enfant::where('token', $token)->first();
            //$classe = Classe::find($enfant->classe_id);
            if($enfant) {
                $state = $request->state;
                if(!in_array($state, ['see', 'download'])) {
                    return redirect()->route('cahier.predownload', ['token' => $token])
                    ->withErrors(['msg' => 'Fonction invalide']);
                }
                $classe = Classe::find($enfant->classe_id);
                $id = $enfant->id;
                $periode = Str::substr($token, 0, 1);
            } else {
                return redirect()->route('cahier.predownload', ['token' => $token])
                    ->withErrors(['msg' => 'Token error']);
            }
        }

        // sous cette forme pour ne pas declencher d'event
        $user = DB::table('users')->select('civilite', 'prenom', 'name')->find($classe->user_id);

        $resultats = Resultat::select('categories.section2','items.*','resultats.*','sections.name as name_section','sections.color','sections.texte')
            ->join('items','items.id','resultats.item_id')
            ->leftJoin('categories','categories.id', '=', 'items.categorie_id')
            ->join('sections','sections.id','resultats.section_id')
            ->where('enfant_id', $id)
            ->where('periode', '<=', $periode)
            ->orderBy('sections.ordre')
            ->orderBy('resultats.section_id')
            ->orderBy('items.categorie_id')
            ->get();

        foreach ($resultats as $resultat) {
            $p = Image::find($resultat->image_id);
            $resultat->image = null;
            if ($p) {
                $resultat->image = 'storage/items/'.$resultat->section_id.'/'.$p->name;
            }
        }

        $ecole = Ecole::where('identifiant_de_l_etablissement', $classe->ecole_identifiant_de_l_etablissement)->first();

        $resultats = $resultats->groupBy('section_id')->toArray();

        // Recherche de cotitulaires / suppléants
        $classeUsers = ClasseUser::select('civilite', 'name', 'prenom', 'classe_users.role')
            ->where('classe_users.classe_id', $classe->id)
            ->rightJoin('users', 'users.id', '=', 'classe_users.user_id')
            ->get();

        $reussite = Reussite::select('id', 'commentaire_general', 'equipes')
            ->where('enfant_id', $id)
            ->where('periode', $periode)
            ->first();

        // Chargement des textes par section
        $reussiteSections = ReussiteSection::select('section_id', 'description')
            ->where('reussite_id', $reussite->id)
            ->get();   

        $sections = Section::orderBy('ordre')->get()->toArray();

        $s = array();
        $rs = array();
        foreach ($sections as $section) {
            $s[$section['id']] = $section;
            if(mb_strlen($s[$section['id']]['name']) > 70) {
                $s[$section['id']]['name'] = str_replace(': ', ':<br>', $s[$section['id']]['name']);
                $s[$section['id']]['class'] = 'titre-page-2-lignes titre'.$section['id'];
            } else {
                $s[$section['id']]['class'] = 'titre-page-1-ligne titre'.$section['id'];
            }
            // on met les textes dans un tableau pour affichage plus pratique dans la vue
            $reussiteSection = $reussiteSections->firstWhere('section_id', $section['id']);
            $rs[$section['id']] = $reussiteSection ? $reussiteSection->description : '';
        }

        $name = $enfant->prenom.' '.$enfant->nom;
        $n = explode(' ', $name);
        $n = join('-', $n);

        $equipes = $reussite->equipes;
      
        if ($equipes) {
            $equipes = json_decode($equipes, true);
        } else {
            $equipes = array();
        }

        $customClass = array();
        foreach ($resultats as $resultat) {
            foreach ($resultat as $item) {
                $class = '.titre'.$item['section_id'].' {color: '.$item['texte'].'; background-color: '.$item['color'].'}';
                if(!in_array($class, $customClass)) {
                    $customClass[] = $class;
                }
            }
        }

        $class = ".titre0 {color: #000; background-color: #f5e342}";
        $customClass[] = $class;

        $utils = new Utils;
        $periode = $utils->periode($enfant, $periode);

        $annee_scolaire = Utils::calcul_annee_scolaire_formated();


        $pdf = PDF::loadView('pdf.reussite5', [
            'reussiteSections' => $rs,
            'customClass' => implode(' ', $customClass),
            'reussite' => $reussite,
            'resultats' => $resultats,
            'sections' => $s,
            'enfant' => $enfant,
            'equipes' => $equipes,
            'user' => $user,
            'classeUsers' => $classeUsers,
            'periode' => $periode,
            'classe' => $classe,
            'ecole' => $ecole,
        ]);

        $pdf->add_info('Title', 'Cahier de réussites de '.ucfirst($enfant->prenom).' - '.$enfant->section().' - '.$periode.' '.$annee_scolaire);
        if($state == 'see') {
            return $pdf->stream('Cahier de réussites de '.ucfirst($enfant->prenom).' - '.$enfant->section().' - '.$periode.' '.$annee_scolaire.'.pdf');
        } else {
            return $pdf->download('Cahier de réussites de '.ucfirst($enfant->prenom).' - '.$enfant->section().' - '.$periode.' '.$annee_scolaire.'.pdf');
        }

    }

    public function editerPDF($enfant_id) {

        $enfant = Enfant::find($enfant_id);
        $reussite = $this->apercu($enfant);
        $prenom = $enfant->prenom;
        $pronom = $enfant->genre == 'F' ? 'elle' : 'il';
        $mots = explode(' ', $reussite);

        $flag = true;
        foreach ($mots as $k=>$mot) {
            if (str_contains($mot, 'h2')) $flag = false;

            if (str_contains($mot, $prenom)) {
                if ($flag) {
                    $mots[$k] =  (str_contains($mot, '>')) ? str_replace($prenom,ucfirst($pronom), $mots[$k]) : str_replace($prenom,$pronom, $mots[$k]);
                } else {
                    $flag = true;

                }
            }

        }
        $commentaires = Commentaire::where('user_id', Auth::id())->where('section_id', 99)->get();
        $reussite = join(' ', $mots);

        $r = Reussite::where('enfant_id', $enfant->id)->where('periode', $enfant->periode)->first();

        $definitif = ($r) ? $r->definitif : null;
        return view('cahiers.apercu')
            ->with('enfant', $enfant)
            ->with('reussite', $reussite)
            ->with('isChrome', Browser::isChrome())
            ->with('definitif', $definitif)
            ->with('title', $this->getPeriode($enfant)[0])
            ->with('commentaires', $commentaires)
            ->with('isreussite', $r);
    }


    public function redoPdf($enfant_id) {
        $enfant = Enfant::find($enfant_id);
        return view('cahiers.pdfview')
            ->with('sections', Section::all()->orderBy('ordre'))
            ->with('title', "coucou")
            ->with('section', Section::first())
            ->with('enfant', $enfant) ;
    }
    public function pdfview($enfant_id) {
        $enfant = Enfant::find($enfant_id);
        return view('cahiers.pdfview')
            ->with('sections', Section::all()->orderBy('ordre'))
            ->with('title', "coucou")
            ->with('section', Section::first())
            ->with('enfant', $enfant) ;
    }

    public function saveCommentaireGeneral($enfant_id, Request $request) {

        $r = Reussite::where('enfant_id', $enfant_id)->where('user_id', Auth::id())->first();
        if (!$r) {
            $r = new Reussite();
            
        } 
        $r->user_id = Auth::id();
        $r->enfant_id = $enfant_id;
        $r->texte_integral = $request->reussite;
        $r->commentaire_general = $request->commentaireGeneral;
        $r->definitif = true;
        $r->save();

        return true;
    }

    public function savePDF($enfant_id) {

        $resultats = Resultat::select('items.*','resultats.*','sections.name as name_section','sections.color')->join('items','items.id','resultats.item_id')
            ->join('sections','sections.id','resultats.section_id')
            ->where('enfant_id', $enfant_id)->orderBy('resultats.section_id')->get();

        $resultats = $resultats->groupBy('section_id')->toArray();

        $sections = Section::all();
        $rep = Auth::user()->repertoire;
        $enfant = Enfant::find($enfant_id);
        $name = $enfant->prenom.' '.$enfant->nom;
        $n = explode(' ', $name);
        $n=join('-', $n);
        $user = Auth::user();
        $equipes = Auth::user()->equipes();



        $reussite = Reussite::where('enfant_id', $enfant_id)->first()->texte_integral;
        $pdf = PDF::loadView('pdf.reussite', ['reussite' => $reussite, 'resultats' => $resultats, 'sections' => $sections, 'enfant' => $enfant, 'user' => $user, 'equipes' => $equipes]);
        $result = Storage::disk('public')->put($rep.'/pdf/'.$n.'.pdf', $pdf->output());

        return redirect()->back()->with('success','le fichier a bine été enregistré');

        $pdf = PDF::loadView('pdf.reussite', ['reussite' => $reussite, 'resultats' => $resultats, 'sections' => $sections, 'enfant' => $enfant]);
    }

    public function definitif($reussite_id, Request $request)
    {
        $reussite = Reussite::find($reussite_id);
        if(!$reussite->isUserCanUpdate()) {
            return redirect()->route('error')->with('msg', 'Aucun élève trouvé.');
        }
        $reussite->definitif = $request->state == "true" ? true : false;
        $reussite->equipes = session('classe_active')->equipes;
        $reussite->save();
        return 'ok';
    }

    public function get_apercu($enfant_id) {
        $enfant = Enfant::find($enfant_id);
        $reussite = Reussite::where('enfant_id', $enfant_id)->first();
        if ($reussite && $reussite->texte_integral != null) {
            return $reussite->texte_integral;
        }
        $reussite = $this->apercu($enfant);
        ;
        $r = Reussite::where('enfant_id', $enfant_id)->first();
        if (!$r) {
            $r = new Reussite();
            $r->enfant_id = $enfant_id;
            $r->user_id = Auth::id();
            $r->definitif = 0;
        }
        $r->periode = $this->getPeriode($enfant)[1];
        $r->texte_integral = $reussite;
        $r->save();
        return $reussite;
    }


    // Normalement remplacé par un appel a seepdf
    public function apercu($enfant, $calcul = true) {

        $reussite = Reussite::where('enfant_id', $enfant->id)->first();

        $resultats = array();
        $r = Resultat::where('enfant_id', $enfant->id)->orderBy('section_id')->get();
        $r = $r->groupBy('section_id');
        

        foreach ($r as $key=>$fiches) {
            $resultats[$key] = '';
            foreach ($fiches as $fiche) {  
                $c= Item::find($fiche->item_id);
                if ($enfant->genre == 'F') {
                    Utils::commentaire($c, $enfant->prenom, $enfant->genre);
                    $resultats[$key] .= $c->phrase_feminin.PHP_EOL;

                               
                } else {
                    Utils::commentaire($c, $enfant->prenom, $enfant->genre);
                    $resultats[$key] .= $c->phrase_masculin.PHP_EOL;
                              
                }

            }    
            $resultats[$key] .= PHP_EOL;
        
        }
        
        $phrases = Phrase::where('enfant_id', $enfant->id)->get();
        $phrases = $phrases->groupBy('section_id');
        foreach ($phrases as $key=>$liste) {
            $resultats[$key] =  isset($resultats[$key]) ? $resultats[$key] : '' ;
            foreach ($liste as $phrase) {                               
                $resultats[$key] .= $phrase->commentaire($enfant).PHP_EOL;                
            }

        }
        if (!$calcul) return strlen(join('',$resultats));


        
        if ($enfant->genre == "F") {
            $r = array();
            foreach ($resultats as $key=>$resultat) {
                $r[$key] = $this->fille($resultat, $enfant);
            } 

        } else {
            $r = array();
            foreach ($resultats as $key=>$resultat) {
                $r[$key] = $this->garcon($resultat, $enfant);
            }   
        }

        return $this->format_apercu($r, $enfant);
    }

    public function add_phrase($enfant_id, $commentaire_id) {
        $enfant = Enfant::find($enfant_id);
        $commentaire = Commentaire::find($commentaire_id);
        Utils::commentaire($commentaire, $enfant->prenom, $enfant->genre);
        $phrase = Phrase::create([
            'commentaire_id' => $commentaire_id,
            'enfant_id' => $enfant_id,
            'order' => 1,
            'section_id' => $commentaire->section_id,

        ]);
        $texte = $enfant->genre == 'F' ? $commentaire->phrase_feminin : $commentaire->phrase_masculin;
        return '<li class="badge_phrase_selected" data-phrase="'.$phrase->id.'">'.$texte.'</li>' ;       
    }
    
    public function remove_phrase($enfant_id, $phrase_id) {
        $enfant = Enfant::find($enfant_id);
        $phrase = Phrase::find($phrase_id);
        $commentaire = Commentaire::find($phrase->commentaire_id);
        Utils::commentaire($commentaire, $enfant->prenom, $enfant->genre);
        $phrase->delete();  
        $texte = $enfant->genre == 'F' ? $commentaire->phrase_feminin : $commentaire->phrase_masculin;      
        return '<li class="badge_phrase" data-value="'.$commentaire->id.'">'.$texte.'</li>' ;       
    }

    public function indexV2($enfant_id) {

        $enfant = Enfant::find($enfant_id);

        $resultats = $enfant->resultats();

        $commentaires = Commentaire::where(function($query) {
            $query->where('user_id', Auth::id())->orWhereNull('user_id');})->get();

        $sections = Section::orderBy('ordre')->get();

        $s = array();
        $s = new Section();
        $s->id = 99;
        $s->color = "red";
        $s->name = "Commentaire général";
        $s->logo = "99.png";
        $sections->push($s);



        $r = array();
        foreach ($resultats as $key=>$result) {
            $s = "";            
            foreach($result as $rr) $s .= '<p>'.$rr->item($enfant).'<p>';
            $r[$key] = Utils::formatWithPrenom($s, $enfant);
        }


        
        
        $commentaires = $commentaires->groupBy('section_id');
        foreach ($commentaires as $key=>$commentaire) {

            Utils::commentaires($commentaires[$key], $enfant->prenom, $enfant->genre);
        }

        $search_reussite = Reussite::where('enfant_id', $enfant->id)->where('periode',$enfant->periode)->first();

        if (!$search_reussite) {
            $search_reussite = new Reussite();
            $search_reussite->enfant_id = $enfant_id;
            $search_reussite->user_id = Auth::id();
            $search_reussite->commentaire_general = null;
            $search_reussite->definitif = 0;
            $search_reussite->periode = $enfant->periode;
            $search_reussite->created_at = Carbon::now();
            $search_reussite->updated_at = Carbon::now();
            $search_reussite->save();

        }
        foreach ($r as $key=>$result) {
                $rel =  ReussiteSection::where('reussite_id', $search_reussite->id)->where('section_id', $key)->first();
                if (!$rel) {
                    $rel = new ReussiteSection();
                    $rel->section_id = $key;
                    $rel->reussite_id = $search_reussite->id;
                    $rel->description = $result;
                    $rel->created_at = Carbon::now();
                    $rel->updated_at = Carbon::now();
                    $rel->save();
                }            
        } 
     

        $r = $search_reussite->reussitesListe();
        
        return view('cahiers.indexV2')
            ->with('titre','Cahier')
            ->with('isChrome',Browser::isChrome())
            ->with('enfant',$enfant)
            ->with('isChrome', Browser::isChrome())
            ->with('commentaires',$commentaires)
            ->with('reussite',$search_reussite)
            ->with('isreussite',$r)
            ->with('resultats',$r)  
            ->with('type', 'reussite')
            ->with('page', 'reussite')
            ->with('periode', $this->getPeriode($enfant)[1])
            ->with('title', $this->getPeriode($enfant)[0])
            ->with('sections', $sections);
    }

    public function index($enfant_id) {

        $enfant = Enfant::find($enfant_id);

        $phrases = Phrase::where('enfant_id', $enfant_id)->get();
        $exclusion = $phrases->pluck('commentaire_id');
        
        $phrases_selection = $phrases->mapToGroups(function ($item, $key) {
            return [$item['section_id'] => $item];
        });

        $commentaire = Commentaire::where(function($query) {
            $query->where('user_id', Auth::id())->orWhereNull('user_id');
        })->whereNotIn('id', $exclusion)->get();

        Utils::commentaires($commentaire, $enfant->prenom, $enfant->genre);
    

        $grouped = $commentaire->mapToGroups(function ($item, $key) {
            return [$item['section_id'] => $item];
        });

        $resultats = $enfant->resultats();
        $reussite = Reussite::where('enfant_id', $enfant_id)->orderBy('periode', 'DESC')->first();

        $commentaires = Commentaire::where(function($query) {
            $query->where('user_id', Auth::id())->orWhereNull('user_id');})->where('section_id', 99)->get();
        Utils::commentaires($commentaire, $enfant->prenom, $enfant->genre);   
        $textes = $enfant->cahier($this->getPeriode($enfant)[1]);
        $r = Reussite::where('enfant_id', $enfant->id)->first();
       
        $textes['carnet'] = $r ? $r->commentaire_general : null;
        

        $phrases = Phrase::where('enfant_id', $enfant_id)->get();        
        $phrases_selection = $phrases->mapToGroups(function ($item, $key) {
            return [$item['section_id'] => $item];
        });

        $sections = Section::orderBy('ordre')->get();

        $s = array();
        $s = new Section();
        $s->id = 99;
        $s->color = "red";
        $s->name = "Commentaire général";
        $s->logo = "99.png";
        $sections->push($s);
        
        return view('cahiers.index')
            ->with('titre','Cahier')
            ->with('isChrome',Browser::isChrome())
            ->with('enfant',$enfant)
            ->with('commentaires',$commentaires)
            ->with('reussite',$reussite)
            ->with('isreussite',$r)
            ->with('phrases_selection',$phrases_selection)
            ->with('resultats',$resultats)           
            ->with('phrases', $grouped)
            ->with('section', Section::first())
            ->with('textes', $textes)
            ->with('type', 'reussite')
            ->with('page', 'reussite')
            ->with('periode', $this->getPeriode($enfant)[1])
            ->with('title', $this->getPeriode($enfant)[0])
            ->with('sections', $sections);
    }

    public function get_liste_phrase($section_id, $enfant_id) {
        $enfant = Enfant::find($enfant_id);
        $phrases = Phrase::where('enfant_id', $enfant->id)->get();
        $exclusion = $phrases->pluck('commentaire_id');
        if ($section_id == 99) {
            $section = null;
            $phrases = Commentaire::where(function($query) {
                $query->where('user_id', Auth::id())->orWhereNull('user_id');})
                ->whereNotIn('id', $exclusion)
                ->where('section_id', 99)->get();
            Utils::commentaires($phrases, $enfant->prenom, $enfant->genre);

            return view('cahiers.liste_phrases')
                ->with('phrases', $phrases)
                ->with('section', $section)
                ->with('enfant', $enfant)
                ->with('type','carnet');

        } else {
            $section = Section::find($section_id);
            if($section) {
                $commentaire = Commentaire::where(function($query) {
                    $query->where('user_id', Auth::id())->orWhereNull('user_id');})
                    ->whereNotIn('id', $exclusion)
                    ->get();
                Utils::commentaires($commentaire, $enfant->prenom, $enfant->genre);   
                $grouped = $commentaire->mapToGroups(function ($item, $key) {
                    return [$item['section_id'] => $item];
                });

                return view('cahiers.liste_phrases')
                    ->with('phrases', $grouped)
                    ->with('section', $section)
                    ->with('enfant', $enfant)
                    ->with('type','reussite'); 
            } else {
                abort(404);
            }
        }

    }

    public function translate(Request $request) {
        $enfant = Enfant::find($request->enfant);
        return Utils::traitement($request->phrase, $enfant);
    }

    public function deleteReussite($enfant_id) {
        $enfant = Enfant::find($enfant_id);
        $reussite = $enfant->hasReussite();
        $reussite->delete();
        return $this->index($enfant->id);
    }


    public function saveTexte($enfant_id, $section_id,  Request $request) {
        
        // if (!$request->texte) return 'ko';
        $enfant = Enfant::find($enfant_id);
        $reussite = $enfant->hasReussite();
        if (!$reussite) {
            $reussite = new Reussite();
            $reussite->enfant_id = $enfant->id;
            $reussite->user_id = Auth::id();
            $reussite->periode = $enfant->periode;
            $reussite->definitif = 0;
            $reussite->save();
        } 

        if ($section_id == 99) {

            $reussite->commentaire_general = trim(strip_tags($request->texte)) == "" ? null   : $request->texte;
            $reussite->save();
        } else {
            $rel = ReussiteSection::where('reussite_id', $reussite->id)->where('section_id', $section_id)->first();

            if (!$rel) {
                $rel = new ReussiteSection();
                $rel->section_id = $section_id;
                $rel->reussite_id = $reussite->id;
                $rel->created_at = Carbon::now();
            }

            $rel->description = $request->texte;
            $rel->updated_at = Carbon::now();
            if (!$request->texte || trim(strip_tags($request->texte)) == '') {
                $rel->delete();
                $rel = ReussiteSection::where('reussite_id', $reussite->id)->where('section_id', $section_id)->first();
                if (!$rel) {
                    $reussite->delete();
                }
            } else {
                $rel->save();
            }            
        }
        return 'ok';            
    }

}
