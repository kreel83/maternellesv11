<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $commune = $request->commune;

        $url = "https://geo.api.gouv.fr/communes?nom=$commune&boost=population&limit=15";

        $r = file_get_contents($url);
        $r = json_decode($r);
        return view('ecole.include.communes')->with('communes', $r);

    }


    public function chercheEcoles(Request $request) {
        $commune = $request->commune;

        $url1 = "https://data.education.gouv.fr/api/records/1.0/search/?dataset=fr-en-adresse-et-geolocalisation-etablissements-premier-et-second-degre&q=&rows=50&facet=numero_uai&facet=appellation_officielle&facet=secteur_public_prive_libe&facet=code_postal_uai&facet=localite_acheminement_uai&facet=libelle_commune&facet=localisation&facet=nature_uai&facet=nature_uai_libe&facet=code_departement&facet=code_region&facet=code_academie&facet=code_commune&refine.code_commune=$commune&refine.nature_uai_libe=ECOLE+MATERNELLE";
        $url2 = "https://data.education.gouv.fr/api/records/1.0/search/?dataset=fr-en-adresse-et-geolocalisation-etablissements-premier-et-second-degre&q=&rows=50&facet=numero_uai&facet=appellation_officielle&facet=secteur_public_prive_libe&facet=code_postal_uai&facet=localite_acheminement_uai&facet=libelle_commune&facet=localisation&facet=nature_uai&facet=nature_uai_libe&facet=code_departement&facet=code_region&facet=code_academie&facet=code_commune&refine.code_commune=$commune&refine.nature_uai_libe=ECOLE+DE+NIVEAU+ELEMENTAIRE";

        $r = file_get_contents($url1);
        $maternelles = json_decode($r);

        $r = file_get_contents($url2);
        $primaires = json_decode($r);
        return view('ecole.include.ecoles')
            ->with('primaires', $primaires->records)
            ->with('maternelles', $maternelles->records);
    }

    public function choixEcole(Request $request) {
       $user = Auth::user();
       $user->ecole = $request->num;
       $user->academie = $request->academie;
       $user->save();
       return 'ok';
    }
}
