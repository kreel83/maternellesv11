<?php

namespace App\Http\Controllers;

use App\Models\Cahier;
use App\Models\Commentaire;
use App\Models\Enfant;
use App\Models\Section;
use App\utils\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CahierController extends Controller
{

    private function format_apercu($commentaires) {
        $bloc = '';
        foreach ($commentaires as $key =>$section) {

            $nameSection = ($key == 99) ? 'Commentaire général' : Section::find($key)->name;
            $bloc .= "<br><h2>$nameSection</h2><br />";
            foreach ($section as $phrase) {
                $bloc .= $phrase->texte;
            }
        }
        return $bloc;

    }


    public function apercu($id, $periode) {
        $commentaire_enfant = Cahier::where('enfant_id', $id)->where('periode', $periode)->orderBy('section_id')->get();
        $commentaire_enfant = $commentaire_enfant->groupBy('section_id');
        return $this->format_apercu($commentaire_enfant);
    }

    public function index($id, $periode) {
        $enfant = Enfant::find($id);
        $commentaire = Commentaire::where('user_id', Auth::id())->get();
        $grouped = $commentaire->mapToGroups(function ($item, $key) {
            return [$item['section_id'] => $item];
        });



        $textes = $enfant->cahier($periode);


        return view('cahiers.index')
            ->with('enfant',$enfant)
            ->with('phrases', $grouped)
            ->with('textes', $textes)
            ->with('periode', $periode)
            ->with('sections', Section::all());
    }

    public function translate(Request $request) {
        $enfant = Enfant::find($request->enfant);
        return Utils::traitement($request->phrase, $enfant);


    }

    public function saveTexte($enfant, $periode, Request $request) {
        $cahier = Cahier::where('enfant_id', $enfant)->where('periode', $periode)->where('section_id', $request->section)->first();
        if (!$cahier) {
            $cahier = new Cahier();
            $cahier->enfant_id = $enfant;
            $cahier->section_id = $request->section;
            $cahier->periode = $periode;
            $cahier->user_id = Auth::id();
            $cahier->texte = $request->texte;

            $cahier->definitif = 0;
        } else {
            $cahier->texte = $request->texte;
        }
        $cahier->save();


        return 'ok';
    }
}
