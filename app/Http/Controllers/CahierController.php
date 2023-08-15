<?php

namespace App\Http\Controllers;

use App\Models\Cahier;
use App\Models\Commentaire;
use App\Models\Enfant;
use App\Models\Equipe;
use App\Models\Image;
use App\Models\Myperiode;
use App\Models\Resultat;
use App\Models\Reussite;
use App\Models\Section;
use App\utils\Utils;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PDF;
use Browser;

class CahierController extends Controller
{



    private function format_apercu($commentaires, $resultats, $enfant) {
        $bloc = '';
        $sections = Section::all()->pluck('id')->toArray();

        foreach ($sections as $section) {

            $nameSection = ($section == 99) ? 'Commentaire général' : Section::find($section)->name;
            if ((isset($resultats[$section])) || (isset($commentaires[$section]))) {
                $bloc .= "<br><h2 contenteditable='false'>$nameSection</h2><br />";

            }
            if (isset($resultats[$section])) {
                foreach ($resultats[$section] as $resultat) {
                    $bloc .= $resultat->item()->phrase($enfant).'</br>';
                }
            }
            if (isset($commentaires[$section])) {
                foreach ($commentaires[$section] as $phrase) {
                    $bloc .= $phrase->texte.'</br>';
                }
            }
        }

        return $bloc;

    }


    protected $title;
    protected $periode;

    public function __construct() {

        $this->middleware(function ($request, $next) {
            $date = Carbon::now()->format('Ymd');
            $periodes = Myperiode::where('user_id', Auth::id())->orderBy('periode','DESC')->get();

            $p = 3;
            foreach ($periodes as $periode) {
                if ($date < Carbon::parse($periode->date_end)->format('Ymd')) $p = $periode->periode;
            }
            $periode = $p;
            $nbperiode = $periodes->count();

            switch ($nbperiode) {
                case 1: $title = 'Année entière';break;
                case 2:
                    if ($periode == 1) $title = 'Premier semestre';
                    if ($periode == 2) $title = 'Second semestre';
    
                    break;
                case 3:
                    if ($periode == 1) $title = 'Premier trimestre';
                    if ($periode == 2) $title = 'Deuxième trimestre';
                    if ($periode == 3) $title = 'Troisième trimestre';
                    break;
            }
            $this->periode = $periode;
            $this->title = $title;         
            return $next($request);
        });



    }


    public function seepdf($id, $state = 'see') {




        $rep = Auth::user()->repertoire;
        $resultats = Resultat::select('items.*','resultats.*','sections.name as name_section','sections.color')->join('items','items.id','resultats.item_id')
           ->join('sections','sections.id','resultats.section_id')
            ->where('enfant_id', $id)->orderBy('resultats.section_id')->get();
         

        // $resultats_personnels = Resultat::select('personnels.*','resultats.*','sections.name as name_section','sections.color')->join('personnels','personnels.id','resultats.item_id')
        //    ->join('sections','sections.id','resultats.section_id')
        //     ->where('enfant_id', $id)->orderBy('resultats.section_id')->get();
        //     $resultats = $resultats_items->merge($resultats_personnels);

        foreach ($resultats as $resultat) {
            $p = Image::find($resultat->image_id);
            $resultat->image = null;
            if ($p) {
                $resultat->image = 'storage/items/'.$p->name;
            }
        }

        $resultats = $resultats->groupBy('section_id')->toArray();
 
        $sections = Section::all()->toArray();
        $s = array();
        foreach ($sections as $section) {
            $s[$section['id']] = $section;
        }

        $enfant = Enfant::find($id);
        $name = $enfant->prenom.' '.$enfant->nom;
        $n = explode(' ', $name);
        $n=join('-', $n);
        $equipes = Auth::user()->equipes();

        $r = Reussite::where('enfant_id', $id)->first();
        $reussite = $r->texte_integral;
        

        // dd($reussite);
        $reussite = str_replace('</p><h2>','</p><div class="page-break"></div><h2>', $reussite);


        //return view('pdf.reussite')->with('reussite', $reussite)->with('resultats', $resultats)->with('sections', $sections)->with('rep',$rep);

//dd($resultats);



        if ($state == 'see') {
            $pdf = PDF::loadView('pdf.reussite', ['reussite' => $reussite, 'resultats' => $resultats, 'sections' => $s, 'enfant' => $enfant, 'equipes' => $equipes, 'user' => Auth::user()]);
            // download PDF file with download method
            return $pdf->stream('test_cahier.pdf');            
        } else {
            $pdf = PDF::loadView('pdf.reussite', ['reussite' => $reussite, 'resultats' => $resultats, 'sections' => $s, 'enfant' => $enfant, 'user' => Auth::user(), 'equipes' => $equipes]);
            $result = Storage::disk('public')->put($rep.'/pdf/'.$n.'.pdf', $pdf->output());    
            return redirect()->back()->with('success','le fichier a bine été enregistré');
        }


    }

    public function editerPDF($enfant) {

        $enfant = Enfant::find($enfant);
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

        $r = Reussite::where('enfant_id', $enfant->id)->first();
        $definitif = ($r) ? $r->definitif : null;
        return view('cahiers.apercu')
            ->with('enfant', $enfant)
            ->with('reussite', $reussite)
            ->with('isChrome',Browser::isChrome())
            ->with('definitif', $definitif)
            ->with('title', $this->title)
            ->with('commentaires', $commentaires)
            ->with('isreussite', $r);
    }


    public function pdfview($id) {
        $enfant = Enfant::find($id);
        return view('cahiers.pdfview')
            ->with('sections', Section::all())
            ->with('title', "coucou")
            ->with('section', Section::first())
            ->with('enfant', $enfant) ;
    }

    public function saveCommentaireGeneral($id, Request $request) {

        $r = Reussite::where('enfant_id', $id)->where('user_id', Auth::id())->first();
        if (!$r) {
            $r = new Reussite();
            
        } 
        $r->user_id = Auth::id();
        $r->enfant_id = $id;
        $r->texte_integral = $request->reussite;
        $r->commentaire_general = $request->commentaireGeneral;
        $r->definitif = true;
        $r->save();

        return true;
    }

    public function savePDF($id) {

        $resultats = Resultat::select('items.*','resultats.*','sections.name as name_section','sections.color')->join('items','items.id','resultats.item_id')
            ->join('sections','sections.id','resultats.section_id')
            ->where('enfant_id', $id)->orderBy('resultats.section_id')->get();

        $resultats = $resultats->groupBy('section_id')->toArray();
//        dd($resultats, $id, $rep);
        $sections = Section::all();
        $rep = Auth::user()->repertoire;
        $enfant = Enfant::find($id);
        $name = $enfant->prenom.' '.$enfant->nom;
        $n = explode(' ', $name);
        $n=join('-', $n);
        $user = Auth::user();
        $equipes = Auth::user()->equipes();



        $reussite = Reussite::where('enfant_id', $id)->first()->texte_integral;
        $pdf = PDF::loadView('pdf.reussite', ['reussite' => $reussite, 'resultats' => $resultats, 'sections' => $sections, 'enfant' => $enfant, 'user' => $user, 'equipes' => $equipes]);
        $result = Storage::disk('public')->put($rep.'/pdf/'.$n.'.pdf', $pdf->output());

        return redirect()->back()->with('success','le fichier a bine été enregistré');

        //return view('pdf.reussite')->with('reussite', $reussite)->with('resultats', $resultats)->with('sections', $sections)->with('rep',$rep);

//dd($resultats);


        $pdf = PDF::loadView('pdf.reussite', ['reussite' => $reussite, 'resultats' => $resultats, 'sections' => $sections, 'enfant' => $enfant]);
    }

    public function definitif($id, Request $request)
    {
        $reussite = Reussite::where('enfant_id', $id)->first();
        //dd($request);
        if (!$reussite) {
            $reussite = new Reussite();
            $reussite->enfant_id = $id;
            $reussite->user_id = Auth::id();
        }

       
            $reussite->definitif = $request->state == "true" ? true : false;
            $reussite->texte_integral = $request->quill;
            $reussite->save();
            return 'ok';
    }


    public function get_apercu($id) {

        function str_replace_first($search, $replace, $subject) {
            $pos = strpos($subject, $search);
            if ($pos !== false) {
                // dd($subject, $replace, $pos, strlen($search));
                return substr_replace($subject, $replace, $pos, strlen($search));
            }
            return $subject;
        }

        
        $enfant = Enfant::find($id);
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

        $reussite = join(' ', $mots);

        $reussite .= '</br><h2 contenteditable="false">Commentaire général</h2>';
        $comm = Reussite::where('enfant_id', $enfant->id)->where('user_id', Auth::id())->first();
        if ($comm) {
            $c = $comm->commentaire_general ?? '';
            $c =  str_replace($prenom,ucfirst($pronom), $c);
            $c = str_replace_first(ucfirst($pronom), $prenom, $c);
            

        }
        $reussite .= '<br><br>'.$c;


       
        return $reussite;

        $r = Reussite::where('enfant_id', $enfant->id)->first();
        $definitif = ($r) ? $r->definitif : null;
        

        $corps = $this->apercu($enfant);
      
        dd($corps);
       
        return $this->apercu($enfant);

    }

    public function apercu($enfant) {
        $reussite = Reussite::where('enfant_id', $enfant->id)->first();

        $commentaire_enfant = Cahier::where('enfant_id', $enfant->id)->orderBy('section_id')->get();
        $commentaire_enfant = $commentaire_enfant->groupBy('section_id');
        $resultats = Resultat::where('enfant_id', $enfant->id)->orderBy('section_id')->get();
        //dd($resultats, $id);
        $resultats = $resultats->groupBy('section_id');


        return $this->format_apercu($commentaire_enfant, $resultats, $enfant);
    }

    public function index($id) {

        $enfant = Enfant::find($id);
        $commentaire = Commentaire::where('user_id', Auth::id())->get();
        $grouped = $commentaire->mapToGroups(function ($item, $key) {
            return [$item['section_id'] => $item];
        });
        $resultats = $enfant->resultats();
        $reussite = Reussite::where('enfant_id',$id)->first();
        //dd($resultats);


        $commentaires = Commentaire::where('user_id', Auth::id())->where('section_id', 99)->get();
        $textes = $enfant->cahier($this->periode);
        $r = Reussite::where('enfant_id', $enfant->id)->first();
       
        $textes['carnet'] = $r ? $r->commentaire_general : null;
        $definitif = ($r) ? $r->definitif : null;
        
        return view('cahiers.index')
            ->with('titre','Cahier')
            ->with('isChrome',Browser::isChrome())
            ->with('enfant',$enfant)
            ->with('commentaires',$commentaires)
            ->with('reussite',$reussite)
            ->with('definitif',$definitif)
            ->with('isreussite',$r)
            ->with('resultats',$resultats)           
            ->with('phrases', $grouped)
            ->with('section', Section::first())
            ->with('textes', $textes)
            ->with('periode', $this->periode)
            ->with('title', $this->title)
            ->with('sections', Section::all());
    }

    public function get_liste_phrase($section, $enfant) {
        $enfant = Enfant::find($enfant);
        if ($section == "carnet") {
            
            $phrases = Commentaire::where('user_id', Auth::id())->where('section_id', 99)->get();
            return view('cahiers.liste_phrases')->with('phrases', $phrases)->with('section', $section)->with('enfant', $enfant)->with('type','carnet'); 
        } else {
            $section = Section::find($section);
            $commentaire = Commentaire::where('user_id', Auth::id())->get();
            $grouped = $commentaire->mapToGroups(function ($item, $key) {
                return [$item['section_id'] => $item];
            });
            return view('cahiers.liste_phrases')->with('phrases', $grouped)->with('section', $section)->with('enfant', $enfant)->with('type','sections');            
        }

    }

    public function translate(Request $request) {
        $enfant = Enfant::find($request->enfant);
        return Utils::traitement($request->phrase, $enfant);


    }

    public function deleteReussite($enfant) {
        $enfant = Enfant::find($enfant);
        $reussite = $enfant->hasReussite();
        $reussite->delete();
        return $this->index($enfant->id);
    }

    public function saveTexte($enfant, Request $request) {
        if ($request->section == 'carnet') {
            $enfant = Enfant::find($enfant);
            $reussite = $enfant->hasReussite();
            if ($reussite) {
                $reussite->commentaire_general = $request->texte;
                $reussite->save();
            } else {
                $reussite = new Reussite();
                $reussite->commentaire_general = $request->texte;
                $reussite->enfant_id = $enfant->id;
                $reussite->user_id = Auth::id();
                $reussite->definitif = 0;
                $reussite->save();


            }
        } else {
            $cahier = Cahier::where('enfant_id', $enfant)->where('section_id', $request->section)->first();


            if (!$cahier) {
                $cahier = new Cahier();
                $cahier->enfant_id = $enfant;
                $cahier->section_id = $request->section;
                $cahier->user_id = Auth::id();
                $cahier->texte = $request->texte;

                $cahier->definitif = 0;
            } else {
                $cahier->texte = $request->texte;
            }
            $cahier->save();


        }
        return 'ok';            

    }
}
