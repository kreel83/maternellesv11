<?php

namespace App\Http\Controllers;

use App\Models\Myperiode;
use App\Models\Event;
use App\Models\Vacance;
use App\utils\Utils;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendrierController extends Controller
{

    public $maclasseactuelle;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {   
            $this->maclasseactuelle = session('classe_active');
            return $next($request);
            });
    }

    public function periode() {
        $periodes = $this->maclasseactuelle->periodes;
        $month = Carbon::parse('9/1/'.Utils::calcul_annee_scolaire());
        $start_year = $month->year;
        $start_year_nb_days = $month->daysInYear;
        $c = Utils::calcul_annee_scolaire().'-'.((int)Utils::calcul_annee_scolaire()+1);
        $academie = Auth::user()->ecole->libelle_academie;

        $url = "https://data.education.gouv.fr/api/records/1.0/search/?dataset=fr-en-calendrier-scolaire&q=&facet=description&facet=population&facet=start_date&facet=end_date&facet=location&facet=zones&refine.annee_scolaire=$c&refine.location=$academie";
        $r = file_get_contents($url);
        $r = json_decode($r);

        $conges = array();
        $dates = json_decode($periodes);

        $p = $this->build_periodes($dates);

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

        return view('calendar.periodes')
            ->with('periodes',$p)
            ->with('periodes_json', json_encode($p))
            ->with('conges',json_encode($conges))
            ->with('start_year_nb_days', $start_year_nb_days)
            ->with('start_year', $start_year)
            ->with('start', $start_year.'-09-01')
            ->with('end', ($start_year+1).'-07-01')
            ->with('month', $month);
    }

    public function saveEvent(Request $request) {
        if ($request->id == 'new') {
           $t = new Event(); 
           $t->created_at = Carbon::now();
        } else {
            $t = Event::find($request->id);
        }
        $t->name = $request->name;
        $t->comment = $request->comment;
        $t->user_id = $request->user_id;
        $t->date = Carbon::parse($request->date);
        $t->updated_at = Carbon::now();
        $t->save();
        return redirect()->back();
    }

    public function periode_save(Request $request) {
        $this->maclasseactuelle->periodes = (int) $request->periode;
        $this->maclasseactuelle->save();
        return redirect()->back()->with('status','success')->with('msg','La configuration a été mise à jour.');
    }

    public function calendrier() {

        $month = Carbon::parse('9/1/'.Utils::calcul_annee_scolaire());
        $start_year = $month->year;
        $start_year_nb_days = $month->daysInYear;

        $vacances = Vacance::where('ecole_code_academie', $this->maclasseactuelle->ecole_code_academie)
            ->orderBy('start_date')
            ->get();

        $conges = array();
        $key = 0;
        foreach($vacances as $vacance) {
            $conges[$key] = array(
                'start_date' => $vacance->start_date,
                'end_date' => $vacance->end_date,
                'libele' => $vacance->description,
                'start' => Utils::jour_dans_anneee($vacance->start_date),
                'end' => Utils::jour_dans_anneee($vacance->end_date),
            );
            $key++;
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

        $events = array();
        $evenements = Auth::user()->evenements();
        $evenements = $evenements->selectRaw('date, count(date) as nombre')->groupBy('date')->get()->toArray();
     
        $date = Carbon::now()->format('Y-m-d');
        $events = Event::where('date', $date)->get();
        
        return view('calendrier.index')
            ->with('month', $month)
            ->with('conges', json_encode($conges))
            ->with('anniversaires', json_encode($anniversaires))
            ->with('evenements', json_encode($evenements))
            ->with('events', $events)
            ->with('ddj', $ddj)
            ->with('start_year_nb_days', $start_year_nb_days)
            ->with('start_year', $start_year);
    }

    public function deleteEvent($event_id) {
        $event = Event::find($event_id);
        $event->delete();
        return 'ok';
    }

    private function build_periodes($dates) {
        $p = array();
        if (sizeof($dates) == 2) {
            $p[0]['label'] = "Année entière";
            $p[0]['debut'] = Carbon::parse($dates[0]);
            $p[0]['fin'] = Carbon::parse($dates[1]);
            $p[0]['classe'] = 'periode1';
        }

        if (sizeof($dates) == 3) {
            $p[0]['label'] = "1er semestre";
            $p[0]['debut'] = Carbon::parse($dates[0]);
            $p[0]['fin'] = Carbon::parse($dates[1]);
            $p[0]['classe'] = 'periode1';
            $p[1]['label'] = "2eme semestre";
            $p[1]['debut'] = Carbon::parse($dates[1])->addDays(1);
            $p[1]['fin'] = Carbon::parse($dates[2]);
            $p[1]['classe'] = 'periode2';
        }
        if (sizeof($dates) == 4) {
            $p[0]['label'] = "1er trimestre";
            $p[0]['debut'] = Carbon::parse($dates[0]);
            $p[0]['fin'] = Carbon::parse($dates[1]);
            $p[0]['classe'] = 'periode1';
            $p[1]['label'] = "2eme trimestre";
            $p[1]['debut'] = Carbon::parse($dates[1])->addDays(1);
            $p[1]['fin'] = Carbon::parse($dates[2]);
            $p[1]['classe'] = 'periode2';
            $p[2]['label'] = "3eme trimestre";
            $p[2]['debut'] = Carbon::parse($dates[2])->addDays(1);
            $p[2]['fin'] = Carbon::parse($dates[3]);
            $p[2]['classe'] = 'periode3';
        }
        return $p;
    }

    public function getPeriodes(Request $request) {
        $dates = json_decode($request->dates);
        $p = $this->build_periodes($dates);
        $this->maclasseactuelle->periodes = $request->dates;
        $this->maclasseactuelle->save();
        return view('calendar.include.periodes_form')
            ->with('periodes_json', json_encode($p))
            ->with('periodes', $p);
    }

    public function getEvent(Request $request) {
        $date = Carbon::parse($request->date)->format('Y-m-d');
        $events = Event::where('date', $request->date)->get();
        return view('calendrier.include.event')->with('events', $events);
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
        dd($request);

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
