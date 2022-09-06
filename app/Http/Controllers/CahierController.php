<?php

namespace App\Http\Controllers;

use App\Models\Cahier;
use App\Models\Commentaire;
use App\Models\Enfant;
use App\Models\Myperiode;
use App\Models\Resultat;
use App\Models\Reussite;
use App\Models\Section;
use App\utils\Utils;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class CahierController extends Controller
{

    private function format_apercu($commentaires, $resultats, $enfant) {

        $bloc = '';
        $sections = Section::all()->pluck('id')->toArray();
        //dd($sections, $commentaires, $resultats);
        foreach ($sections as $section) {

            $nameSection = ($section == 99) ? 'Commentaire général' : Section::find($section)->name;
            $bloc .= "<br><h2>$nameSection</h2><br />";
            if (isset($commentaires[$section])) {
                foreach ($commentaires[$section] as $phrase) {
                    $bloc .= $phrase->texte;
                }
            }

            if (isset($resultats[$section])) {
                foreach ($resultats[$section] as $resultat) {
                    $bloc .= $resultat->item()->phrase($enfant) . PHP_EOL;
                }
            }
        }
        return $bloc;

    }




    public function seepdf($id, $periode) {

        $reussite = Reussite::where('enfant_id', $id)->where('periode', $periode)->first()->texte_integral;
        $cahier =

        $pdf = PDF::loadView('pdf.reussite', ['reussite' => $reussite]);
        // download PDF file with download method
        return $pdf->stream('test_cahier.pdf');
    }

    public function definitif($id, $periode, Request $request)
    {
        $reussite = Reussite::where('enfant_id', $id)->where('periode', $periode)->first();
        //dd($request);
        if (!$reussite) {
            $reussite = new Reussite();
            $reussite->enfant_id = $id;
            $reussite->periode = $periode;
            $reussite->user_id = Auth::id();
        }

            $reussite->definitif = $request->state == "true" ? true : false;
            $reussite->texte_integral = $request->quill;
            $reussite->save();
            return 'ok';
    }


    public function apercu($id, $periode) {
        $reussite = Reussite::where('enfant_id', $id)->where('periode', $periode)->first();

        if ($reussite) return $reussite->texte_integral;
        $enfant = Enfant::find($id);
        $commentaire_enfant = Cahier::where('enfant_id', $id)->where('periode', $periode)->orderBy('section_id')->get();
        $commentaire_enfant = $commentaire_enfant->groupBy('section_id');
        $resultats = Resultat::where('enfant_id', $id)->orderBy('section_id')->get();
        $resultats = $resultats->groupBy('section_id');

        return $this->format_apercu($commentaire_enfant, $resultats, $enfant);
    }

    public function index($id, $periode, $nbperiode) {
        $enfant = Enfant::find($id);
        $commentaire = Commentaire::where('user_id', Auth::id())->get();
        $grouped = $commentaire->mapToGroups(function ($item, $key) {
            return [$item['section_id'] => $item];
        });
        $resultats = $enfant->resultats();
        //$resultats = $resultats->groupBy('section_id');
        //dd($resultats);
        $reussite = Reussite::where('periode', $periode)->where('enfant_id',$id)->first();


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

        $textes = $enfant->cahier($periode);


        return view('cahiers.index')
            ->with('enfant',$enfant)
            ->with('reussite',$reussite)
            ->with('resultats',$resultats)
            ->with('phrases', $grouped)
            ->with('textes', $textes)
            ->with('periode', $periode)
            ->with('title', $title)
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
