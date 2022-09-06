<?php

namespace App\Http\Controllers;

use App\Models\Myperiode;
use App\utils\Utils;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendrierController extends Controller
{


    public function calendrier() {
        $month = Carbon::parse('9/1/'.Utils::calcul_annee_scolaire());

        $c = Utils::calcul_annee_scolaire().'-'.((int)Utils::calcul_annee_scolaire()+1);
        $start_year = $month->year;
        $start_year_nb_days = $month->daysInYear;
        $user = Auth::user();
        $academie = $user->academie;

        $url = "https://data.education.gouv.fr/api/records/1.0/search/?dataset=fr-en-calendrier-scolaire&q=&facet=description&facet=population&facet=start_date&facet=end_date&facet=location&facet=zones&refine.annee_scolaire=$c&refine.location=$academie";
        $r = file_get_contents($url);
        $r = json_decode($r);
        $conges = array();


        foreach ($r->records as $key=>$record) {
            Utils::jour_dans_anneee($record->fields->end_date);
            $conges[$key]['end_date'] = $record->fields->end_date;
            $conges[$key]['start_date'] = $record->fields->start_date;
            $conges[$key]['end'] = Utils::jour_dans_anneee($record->fields->end_date);
            $conges[$key]['start'] = Utils::jour_dans_anneee($record->fields->start_date);
            $conges[$key]['libele'] = $record->fields->description;
            if ($conges[$key]['end'] == $conges[$key]['start']) {
                $r = Carbon::parse($conges[$key]['end_date'])->addMonths(1)->endOfMonth()->format('Y-m-dT22:00:00+00:00');
                $conges[$key]['end_date'] = $r;
                $conges[$key]['end'] = Utils::jour_dans_anneee($r);
            }

        }

        $anniversaires = array();
        $enfants = Auth::user()->liste();
        foreach ($enfants as $key=>$enfant) {
            $anniversaires[$key]['nom'] = $enfant->prenom.' '.$enfant->nom;
            $exp = explode("-", $enfant->ddn);
            $annee = (int) Utils::calcul_annee_scolaire();

            if (!in_array($exp[1],[9,10,11,12])) $annee = $annee + 1;
            $ddn = Carbon::parse($annee.'-'.$exp[1].'-'.$exp[2]);
            $anniversaires[$key]['ddn'] =  Utils::jour_dans_anneee($ddn);
            $anniversaires[$key]['genre'] =  $enfant->genre == 'G' ? 'masculin' : 'feminin';

        }
        $ddj = Utils::jour_dans_anneee(Carbon::now());




        return view('calendrier.index')
            ->with('month', $month)
            ->with('conges', json_encode($conges))
            ->with('anniversaires', json_encode($anniversaires))
            ->with('ddj', $ddj)
            ->with('start_year_nb_days', $start_year_nb_days)
            ->with('start_year', $start_year);
    }

    public function index() {
        $month = Carbon::parse('9/1/'.Utils::calcul_annee_scolaire());
        $start_year = $month->year;
        $start_year_nb_days = $month->daysInYear;




        return view('calendar.index')
            ->with('month', $month)
            ->with('start_year_nb_days', $start_year_nb_days)
            ->with('start_year', $start_year);
    }

    public function init(Request $request) {
        $user = Auth::id();
        $datas = Myperiode::where('user_id', $user)->where('annee', $request->annee)->get()->toArray();

        return $datas;
    }

    public function savePeriode(Request $request) {

        $user = Auth::id();
        Myperiode::where('user_id', $user)->where('annee', $request->annee)->delete();
        $actual = 1;
        foreach ($request->periode as $key=>$p) {

            if ($p) {

                $data = json_decode($p);
                $new = new Myperiode();
                $new->start = $data->start;
                $new->end = $data->end;
                $new->date_start = Carbon::createFromFormat('d/m/Y',$data->datestart);
                $new->date_end = Carbon::createFromFormat('d/m/Y',$data->dateend);
                $new->annee = $request->annee;
                $new->periode = $actual;
                $new->user_id = $user;
                $new->save();
                $actual++;
            }
        }


    }
}
