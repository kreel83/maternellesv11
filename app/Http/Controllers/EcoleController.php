<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ecole;

class EcoleController extends Controller
{
    public function index() {
        $user = Auth::user();
        $ecole = null;
        if ($ecole = $user->ecole) {
            $url = "https://data.education.gouv.fr/api/records/1.0/search/?dataset=fr-en-adresse-et-geolocalisation-etablissements-premier-et-second-degre&q=&rows=50&facet=numero_uai&facet=appellation_officielle&facet=secteur_public_prive_libe&facet=code_postal_uai&facet=localite_acheminement_uai&facet=libelle_commune&facet=localisation&facet=nature_uai&facet=nature_uai_libe&facet=code_departement&facet=code_region&facet=code_academie&facet=code_commune&refine.numero_uai=$ecole";
            $r = file_get_contents($url);
            $ecole = json_decode($r)->records[0];

        }
        return view('ecole.index')->with('ecole', $ecole);
    }

    public function chercheCommune(Request $request) {
        $search = $request->search;
        if (is_numeric($search)) {
            
            switch (strlen($search)) {
                case 2 :    $communes = Ecole::select('nom_commune', 'adresse_3','code_departement','code_commune')->groupBy('nom_commune')->where('code_departement', '0'.$search );
                            break;
                case 5 :    $communes = Ecole::select('nom_commune', 'adresse_3','code_departement','code_commune')->groupBy('nom_commune')->where('code_postal', $search );
                            break;
            
            }
        } else {
            $communes = Ecole::select('nom_commune', 'adresse_3','code_departement','code_commune')->groupBy('nom_commune')->where('nom_etablissement','LIKE', '%'.$search.'%' )->orWhere('nom_commune','LIKE','%'.$search.'%');
        }
        $communes = $communes->orderBy('nom_commune')->get();
        return view('ecole.include.communes')->with('communes', $communes);
    }

    public function chercheEcoles(Request $request) {
        $commune = $request->commune;
        $ecoles = Ecole::where('code_commune', $commune);
        $listes['Ecoles Maternelles'] = Ecole::where('code_commune', $commune)->where('ecole_maternelle','1')->where('ecole_elementaire','0')->get()->toArray();
        $listes['Ecoles Primaires'] = Ecole::where('code_commune', $commune)->where('ecole_elementaire','1')->get()->toArray();

        return view('ecole.include.ecoles')
            ->with('ecoles', $listes);
    }

    public function confirmationEcole(Request $request) {
        $ecole = Ecole::where('identifiant_de_l_etablissement',$request->ecole)->first();
        return view('ecole.confirmation')->with('ecole', $ecole);
    }

    public function choixEcole(Request $request) {
       $user = Auth::user();
       $ecole = Ecole::where('identifiant_de_l_etablissement',$request->ecole)->first();

       $user->ecole_identifiant_de_l_etablissement = $request->ecole;
       $user->academie = $ecole->code_academie;       
       $user->save();
       return 'ok';
    }
    
}
