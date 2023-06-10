<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
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
//        dd($ecole);
        return view('ecole.index')->with('ecole', $ecole);
    }

    public function chercheCommune(Request $request) {
        $commune = $request->commune ? $request->commune : null;
        $dpt = ($request->dpt)  ? '0'.$request->dpt : null;
        $communes = new Ecole();
        $communes = $communes->selectRaw('commune, code_postal, code_commune');
        if ($commune) {
            $communes = $communes->where('commune', 'LIKE', '%'.$commune.'%');
        }
        if ($dpt) {
            $communes = $communes->where('code_departement',  $dpt);
        }
        $communes = $communes->distinct('code_commune')->orderBy('code_commune')->get();

        // $communes = $commune->distinct('commune')->selectRaw('commune, code_postal, code_commune')->where('commune', 'LIKE', '%'.$request->commune.'%')->orderBy('commune')->get();
        // dd($communes);
        // $ecoles = Ecole::where('commune', 'LIKE', '%'.$request->commune.'%')->where('code_departement', $dpt)->get();
        
        // $ecoles = $ecoles->groupBy('nature')->toArray();
        // return view('ecole.include.ecoles')
        //     ->with('ecoles', $ecoles);
            

        return view('ecole.include.communes')->with('communes', $communes);

    }


    public function chercheEcoles(Request $request) {
        $commune = $request->commune;
        $ecoles = Ecole::where('code_commune', $commune)->get();
        $ecoles = $ecoles->groupBy('nature')->toArray();
        return view('ecole.include.ecoles')
            ->with('ecoles', $ecoles);
    }

    public function choixEcole(Request $request) {
       $user = Auth::user();
       $user->ecole_code_etablissement = $request->num;
       
       $user->save();
       return 'ok';
    }
}
