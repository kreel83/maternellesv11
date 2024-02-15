<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enfant;
use App\Models\Section;
use App\Models\Reussite;
use App\Models\ReussiteSection;
use App\Models\Resultat;
use App\Models\Item;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{

    public $periode_actuelle;
    public function __construct() {
        // $this->middleware(function ($request, $next) {
        //     $conf = Configuration::where('user_id', Auth::id())->first();
        //     $this->periode_actuelle = $conf->periode;    
        //     $this->periode_actuelle = $conf->periode;    
        //     return $next($request);
        // });

    }

    public function mesfiches() {
        $items = Item::whereNull('user_id')->orWhere('user_id', Auth::id())->orderBy('section_id')->get();
        $sections = Section::all();
        return view('mesfiches.index')->with('items', $items)->with('sections', $sections);
    }

    public function getFiche(Request $request) {
        $resultat = Resultat::find($request->resultat);
        $fiche = Item::find($resultat->item_id);
        $section = Item::find($resultat->section_id);
        $r = $fiche->resultat($request->enfant);
        $fiche = Item::find($resultat->item_id);
        if ($resultat) {
            $fiche->notation = $fiche->resultat($request->enfant)[0];
            $fiche->autonome = $fiche->resultat($request->enfant)[1];
            $fiche->textnote = $fiche->resultat($request->enfant)[2];
        }  

        return view('cards.item')
            ->with('section', $section)
            ->with('fiche', $fiche);
        
        
    }

    public function index($enfant_id, Request $request) {

        if($request->section_id) {
            $section = Section::find($request->section_id);
        } else {
            $section = Section::first();
        }

        if(!$section) {
            return redirect()->route('error')->with('msg', 'Section introuvable.');
        }

        $enfant = Enfant::find($enfant_id);
        $sections = Section::orderBy('ordre')->get();
        $fiches = Auth::user()->mesfiches();
        

        $has_reussite = Reussite::where('enfant_id', $enfant_id)->where('periode', $enfant->periode)->first();
        if ($has_reussite) $has_reussite_section = ReussiteSection::where('reussite_id', $has_reussite->id)->groupBy('section_id')->pluck('section_id')->toArray();

        
        
        $liste_reussite_section = [];
        foreach ($sections as $sec) {
            $liste_reussite_section[$sec->id] = ($has_reussite && in_array($sec->id, $has_reussite_section)) ? 1 : 0; 
           
        }

        
 

        // $has_reussite = ($h:as_reussite) ? true : false;
         



        foreach ($fiches as $fiche) {
            $resultat = $fiche->resultat($enfant->id);
            if ($resultat) {
                $fiche->notation = $fiche->resultat($enfant->id)[0];
                $fiche->autonome = $fiche->resultat($enfant->id)[1];
                $fiche->textnote = $fiche->resultat($enfant->id)[2];
            }            
        }

        return view('items.index')
                ->with("user", Auth::user())
                ->with("listeReussiteSection", $liste_reussite_section)
                ->with('fiches', $fiches)
                ->with('sections',$sections)
                ->with('enfant', $enfant)
                ->with('type', 'evaluation')
                ->with('section', $section);
    }

    public function getReussite($enfant_id, Request $request) {
        $enfant = Enfant::find($enfant_id);

        $reussite = Reussite::where('enfant_id', $enfant_id)->where('periode', $enfant->periode)->first();
        if ($reussite) {
            $r = ReussiteSection::where('section_id', $request->section)->where('reussite_id', $reussite->id)->first();
            

        }
        return [$r->description ?? null, $r->id ?? null];
    }

    public function CommitSaveReussite(Request $request) {
        //Log::info('CommitSaveReussite (itemcontroller) '.$request);
        $r = ReussiteSection::find($request->id);
        $r->description = $request->texte;
        $r->save();
        return 'ok';
    }

    public function upgradeResultat(Request $request) {
        $resultat = Resultat::find($request->id);
        $resultat->autonome = 1;
        $resultat->save();
        return 'done';
    }




    public function saveResultat(Request $request) {
        

        $user = Auth::user();
        
        if (!$user->is_abonne()) {
            $search = Resultat::where('enfant_id', $request->enfant)->where('item_id', $request->item)->first();
            $compte = Resultat::where('user_id', $user->id)->count();
            if ($compte == config('app.custom.evaluations_gratuites') && !$search) {
                return 'demo';
            }
        }

        $autonome = 0;
        if ($request->note == 3) {
            $request->note = 2;
            $autonome = 1;
        }


        $search = Resultat::where('enfant_id', $request->enfant)->where('item_id', $request->item)->first();

        if (session('classe_active')->desactive_acquis_aide == 1) {
            $acquis = ($search && $search->notation == 2 && $search->autonome == 1) ? true : false;
        } else {
            $acquis = ($search && $search->notation == 2) ? true : false;
        }
        

        if ($search && $request->note == 0) {
            $search->delete();
            return 'modif';
           
        }

        $ancienne_note = null;
        if ($search) {
            $ancienne_note=[$search->notation, $search->autonome];
            if ($request->note != 0) {
                $search->notation = $request->note;
                $search->autonome = $autonome;                
                $search->save();
            }

        } else {
            $item = Item::find($request->item);
            $enfant = Enfant::find($request->enfant);
            $search = new Resultat();
            $search->item_id = $request->item;
            $search->enfant_id = $request->enfant;
            $search->notation = $request->note;
            $search->autonome = $autonome;
            $search->section_id = $item->section()->id;
            $search->user_id = Auth::id();
            $search->periode = $enfant->periode;
            $search->save();
        }

        if ($acquis) {
            if (session('classe_active')->desactive_acquis_aide == 0 && $request->note == 2 && $ancienne_note && $ancienne_note[0] == 2 && $ancienne_note[1] == 1) return 'super';
            return 'modif';        
        } else {
            return 'super';        

        }
    }
}
