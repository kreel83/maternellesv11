<?php

namespace App\Http\Controllers;

use App\Models\AcquisScolairesSection;
use App\Models\CahiersSynthese;
use App\Models\Enfant;
use App\Models\Synthese;
use Auth;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SyntheseController extends Controller
{
    public function index($id) {
        $enfant = Enfant::find($id);
        
        [$acquis, $autres] = $this->calcul_synthese($id);
        

        $cahier_synthese = CahiersSynthese::where('enfant_id', $id)->first();
        $observations = $cahier_synthese ? $cahier_synthese->observations : [];
        $ready = $cahier_synthese ? $cahier_synthese->ready : false;
        $mail_send = $cahier_synthese && $cahier_synthese->send_at ? $cahier_synthese->send_at : null;
        
               
                    
        return view('synthese.index')
            ->with('acquis', $acquis)
            ->with('autres', $autres)
            ->with('ready', $ready)
            ->with('mail_send', $mail_send)
            ->with('observations', $observations)
            ->with('enfant', $enfant);
    }

    private function calcul_synthese($id) {
        $enfant = Enfant::find($id);
        $notes = Synthese::where('enfant_id', $id)->whereNull('observation')->whereNotNull('acquis')->pluck('acquis','acquis_scolaires_section_id')->toArray();
        $acquis = AcquisScolairesSection::where('type','boolean')->get()->groupBy('acquis_scolaire_id');
        $autres = AcquisScolairesSection::where('type','string')->get()->groupBy('acquis_scolaire_id');
        $obs = Synthese::where('enfant_id', $id)->whereNull('acquis')->whereNotNull('observation')->pluck('observation','acquis_scolaires_section_id')->toArray();
        
        // Transformer le résultat en tableau avec les rôles comme clés
        $acquis = $acquis->mapWithKeys(function ($items, $key) {
            
            return [$key => $items->toArray()];
        })->toArray();
        foreach ($acquis as $k1=>$arr) {
            foreach ($arr as $k2=>$aa) {
                if (array_key_exists($aa['id'], $notes)) {                    
                    $acquis[$k1][$k2]['note'] = $notes[$aa['id']];
                    } else {
                    $acquis[$k1][$k2]['note'] = null;
                }                    
            }                    
        }

        // Transformer le résultat en tableau avec les rôles comme clés (observations)
        $autres = $autres->mapWithKeys(function ($items, $key) {
            
            return [$key => $items->toArray()];
        })->toArray();
        foreach ($autres as $k1=>$arr) {
            foreach ($arr as $k2=>$aa) {
                if (array_key_exists($aa['id'], $obs)) {                    
                    $autres[$k1][$k2]['observation'] = $obs[$aa['id']];
                    } else {
                    $autres[$k1][$k2]['observation'] = null;
                }                    
            }                    
        }

        return [$acquis, $autres];
    }


    public function view($enfant_id) {
        $enfant = Enfant::find($enfant_id);
        
        [$acquis, $autres] = $this->calcul_synthese($enfant_id);
        

        $cahier_synthese = CahiersSynthese::where('enfant_id', $enfant_id)->first();
        $observations = $cahier_synthese ? $cahier_synthese->observations : [];
        $data = [
            'acquis' => $acquis,
            'autres' => $autres,
            'observations' => $observations,
            'enfant' => $enfant,
            'ecole' => Auth::user()->name_ecole()->nom_etablissement
        ];
        
        $pdf = PDF::loadView('pdf.synthese', $data);

        // Download the PDF file
        return $pdf->download('pdf.synthese');
    }

    public function save_observation($enfant_id, Request $request) {
        $field = array();
        $field[$request->section] = $request->texte;
        $search = CahiersSynthese::where('enfant_id', $enfant_id)->first();
        if (!$search) {
            $search = new CahiersSynthese();
            $search->enfant_id = $enfant_id;
            $search->observations = $field;
            $search->save();
        } else {
            $arr = $search->observations;
            foreach ($field as $cle => $valeur) {
                $arr[$cle] = $valeur;
            }
            $search->observations = $arr;
            $search->save();
        }

        return 'ok';
    }

    public function save_observation_seule($enfant_id, Request $request) {
        
        foreach ($request->liste as $ligne) {
            $search = Synthese::where('enfant_id', $enfant_id)->where('acquis_scolaires_section_id', $ligne['id'])->first();
            if ($search) {
                if ($ligne['observation']) {
                    $search->observation = $ligne['observation'];
                    $search->updated_at = Carbon::now();
                    $search->save();
                } else {    
                    $search->delete();
                }

            } else {
                $search = new Synthese();
                $search->acquis_scolaires_section_id = $ligne['id'];
                $search->enfant_id = $enfant_id;
                $search->acquis = null;
                $search->observation = $ligne['observation'];
                $search->created_at = Carbon::now();
                $search->updated_at = Carbon::now();
                $search->save();
            
            }
                
        }
        return 'done';
    }

    public function save_ready($enfant_id, Request $request) {
        // dd($request);
        $search = CahiersSynthese::where('enfant_id', $enfant_id)->first();
        if (!$search) {
            $search = new CahiersSynthese();
            $search->enfant_id = $enfant_id;
            $search->ready = $request->ready == "true" ? 1 : 0;
            $search->save();
        } else {       
            $search->ready = $request->ready == "true" ? 1 : 0;
            $search->save();
        }

        return 'ok';
    }
    public function save_synthese($enfant_id, Request $request) {
        $result = explode('-', $request->result);
        $search = Synthese::where('enfant_id', $enfant_id)->where('acquis_scolaires_section_id', $result[0])->whereNull('observation')->first();

        if ($search) {
            $search->acquis = $result[1];
            $search->updated_at = Carbon::now();
            $search->save();
        } else {
            $search = new Synthese();
            $search->enfant_id = $enfant_id;
            $search->acquis_scolaires_section_id = $result[0];
            $search->acquis = $result[1];
            $search->observation = null;
            $search->created_at = Carbon::now();
            $search->save();
        }
        return 'ok';
    }
}
