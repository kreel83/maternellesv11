<?php

namespace App\Http\Controllers;

use App\Mail\CheckEnvVariables;
use App\Models\Ecole;
use App\Models\Vacance;
use App\utils\Utils;
use Artisan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SuperAdminController extends Controller
{
    
    public function chargementDesVacancesScolaires() {

        function getData($offset, $refine) {
            $url = "https://data.education.gouv.fr/api/explore/v2.1/catalog/datasets/fr-en-calendrier-scolaire/records?limit=100&offset=$offset&refine=$refine";
            $r = file_get_contents($url);
            return json_decode($r, true);
        }
        $compteur = 0;
        $offset = 0;
        $refine = urlencode('annee_scolaire:"'.Utils::calcul_annee_scolaire().'-'.((int)Utils::calcul_annee_scolaire()+1).'"');
        Vacance::truncate();
        do {
            $data = getData($offset, $refine);
            $total_count = (int)$data['total_count'];
            foreach ($data['results'] as $ligne)  {
                if(stripos($ligne['population'], 'Enseignant') === false) {
                    $end_date = Carbon::parse($ligne['end_date'])->format('Y-m-d h:i:s');  // pour le jour même
                    Vacance::create([
                        'description' => $ligne['description'],
                        'population' => $ligne['population'],
                        'start_date' => $ligne['start_date'],
                        'end_date' => $end_date,
                        'location' => $ligne['location'],
                        'zones' => $ligne['zones'],
                        'annee_scolaire' => $ligne['annee_scolaire'],
                    ]);
                }
                $compteur++;
                if($compteur % 99 == 0) {
                    $offset += 100;
                }
            }
        } while ($compteur < $total_count);
        // Mise à jour avec les codes académiques
        $academies = Ecole::distinct()->get(['libelle_academie','code_academie']);
        foreach ($academies as $academie) {
            Vacance::where('location', $academie->libelle_academie)->update(['ecole_code_academie' => $academie->code_academie]);
        }
    }

    public function checkEnvVariables() {
        if(trim(env('APP_NAME')) == '') {
            Artisan::call('config:clear');
            Mail::to('thierry.thevenoud@gmail.com')->send(new CheckEnvVariables());
            Mail::to('marc.borgna@gmail.com')->send(new CheckEnvVariables());
        }
    }

}
