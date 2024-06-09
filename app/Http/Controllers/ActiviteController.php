<?php

namespace App\Http\Controllers;

use App\Models\Enfant;
use App\Models\Item;
use App\Models\Resultat;
use App\Models\Reussite;
use App\Models\Section;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
class ActiviteController extends Controller
{
    public function activites() {
        $fiches = Auth::user()->mesfiches();  
        $sections = $sections = Section::orderBy('ordre')->get();      
        return view('items.liste')
        ->with('fiches', $fiches)
        ->with('section', Section::first())
        ->with('sections', $sections);
    }
    
    public function activite(Request $request) {
        $id = $request->item_id;
        $item = Item::find($id);
        $mesgroupes = json_decode(Auth::user()->groupes, true);
        
        $listeDesEleves = Auth::user()->liste();
        $sections = $sections = Section::orderBy('ordre')->get();      
        $middle = (int) $listeDesEleves->count() / 2;
        $degrades = Enfant::DEGRADE;
        
        return view('items.liste_enfants')
        ->with('section', Section::first())
        ->with('fiche', $item)
        ->with('degrades', $degrades)
        ->with('mesgroupes', $mesgroupes)
        ->with('sections', $sections)
        ->with('middle', $middle)
        ->with('listeDesEleves', $listeDesEleves);
    }

    public function activite_post(Request $request) {
        $item = Item::find($request->fiche);
        
        foreach ($request->liste as $enfant) {
            $enfant = Enfant::find($enfant);
            $periode = $enfant->periode;
            $resultat = Resultat::where('item_id', $item->id)
                            ->where('enfant_id', $enfant->id)
                            ->where('user_id', Auth::id())
                            ->where('periode', $periode)
                            ->first();
            if (!$resultat) {
                $resultat = new Resultat();
                $resultat->item_id = $item->id;
                $resultat->enfant_id =$enfant->id;
                $resultat->section_id =$item->section_id;
                $resultat->user_id = Auth::id();
                $resultat->periode = $periode;
            }
            $resultat->notation= 2;
            $resultat->autonome = 1;                        
            $resultat->updated_at = Carbon::now();                        
            $resultat->created_at = Carbon::now();                        
            $resultat->save();
        }
        return 'done';
    }
}
