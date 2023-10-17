<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enfant;
use App\Models\Configuration;
use App\Models\Section;
use App\Models\Resultat;
use App\Models\Item;
use App\Models\Fiche;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{

    public $periode_actuelle;
    public function __construct() {
        $this->middleware(function ($request, $next) {
            $conf = Configuration::where('user_id', Auth::id())->first();
            $this->periode_actuelle = $conf->periode;    
            return $next($request);
        });

    }

    public function mesfiches() {
        $items = Item::whereNull('user_id')->orWhere('user_id', Auth::id())->orderBy('section_id')->get();
        $sections = Section::all();
        return view('mesfiches.index')->with('items', $items)->with('sections', $sections);
    }

    public function index($id, Request $request) {

        if($request->sectionID) {
            $section = Section::skip((int)$request->sectionID)->take(1)->first();
        } else {
            $section = Section::first();
        }
        
        $enfant = Enfant::find($id);
        $sections = Section::orderBy('ordre')->get();
        $fiches = Auth::user()->mesfiches();

        foreach ($fiches as $fiche) {
            $resultat = $fiche->resultat($enfant->id);
            if ($resultat) {
                // dd($fiche->resultat($enfant->id));
                $fiche->notation = $fiche->resultat($enfant->id)[0];
                $fiche->autonome = $fiche->resultat($enfant->id)[1];
                $fiche->textnote = $fiche->resultat($enfant->id)[2];
            }            
        }

        return view('items.index')
                ->with("user", Auth::user())
                ->with('fiches', $fiches)
                ->with('sections',$sections)
                ->with('enfant', $enfant)
                ->with('type', 'evaluation')
                ->with('section', $section);
    }

    public function saveResultat(Request $request) {
        $autonome = 0;
        if ($request->note == 3) {
            $request->note = 2;
            $autonome = 1;
        }
        $search = Resultat::where('enfant_id', $request->enfant)->where('item_id', $request->item)->first();
        if ($search && $request->note == 0) {
            $search->delete();
            return 'deleted';
        }
        if ($search) {
            $search->notation = $request->note;
            $search->autonome = $autonome;
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
            $search->periode = $this->periode_actuelle;


        }
        $search->save();
        return 'super';
    }
}
