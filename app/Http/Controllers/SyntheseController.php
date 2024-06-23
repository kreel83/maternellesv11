<?php

namespace App\Http\Controllers;

use App\Models\AcquisScolairesSection;
use App\Models\CahiersSynthese;
use App\Models\Enfant;
use App\Models\Reussite;
use App\Models\Synthese;
use Auth;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SyntheseController extends Controller
{
    public $maclasseactuelle;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {   
            // $this->maclasseactuelle = Classe::find(session()->get('id_de_la_classe'));
            $this->maclasseactuelle = session('classe_active');
            return $next($request);
            });
    }

    public function index($id) {
        $enfant = Enfant::find($id);
        $notes = Synthese::where('enfant_id', $id)->whereNotNull('acquis')->pluck('acquis','acquis_scolaires_section_id')->toArray();
        $acquis = AcquisScolairesSection::all()->groupBy('acquis_scolaire_id');

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

        $cahier_synthese = CahiersSynthese::where('enfant_id', $id)->first();
        $observations = $cahier_synthese ? $cahier_synthese->observations : [];
        $ready = $cahier_synthese ? $cahier_synthese->ready : false;
        $mail_send = $cahier_synthese && $cahier_synthese->send_at ? $cahier_synthese->send_at : null;
        
        
               
                    
        return view('synthese.index')
            ->with('acquis', $acquis)
            ->with('ready', $ready)
            ->with('mail_send', $mail_send)
            ->with('observations', $observations)
            ->with('enfant', $enfant);
    }


    public function view($enfant_id) {
        $enfant = Enfant::find($enfant_id);
        $notes = Synthese::where('enfant_id', $enfant_id)->whereNotNull('acquis')->pluck('acquis','acquis_scolaires_section_id')->toArray();
        $acquis = AcquisScolairesSection::all()->groupBy('acquis_scolaire_id');

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

        $cahier_synthese = CahiersSynthese::where('enfant_id', $enfant_id)->first();
        $observations = $cahier_synthese ? $cahier_synthese->observations : [];
        $data = [
            'acquis' => $acquis,
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

    public function syntheseManage(Request $request) {
        $ordre = $this->maclasseactuelle->ordre_pdf;
        $enfants = Enfant::where('classe_id', session('classe_active')->id)->orderBy($ordre)->get();
        $reussites = Reussite::where('user_id', session('classe_active')->user_id)->get();
        $maxPeriode = $request->user()->periodes;
        $statutCahier = array();
        $statutEmail = array();        
        $displayBtnBulk = array_fill(1, $maxPeriode, false);
        $classeEmails = session('classe_active')->isEmails();
        foreach ($enfants as $enfant) {
            
            $mails = $enfant->tableauDesMailsEnfant();

            if(count($mails) > 0) {
                $s = count($mails) > 1 ? 's' : '';
                $statutEmail[$enfant->id]['success'] = true;
                $statutEmail[$enfant->id]['msg'] = '<div title="'.implode(chr(10), $mails).'"><i class="fa-solid fa-circle-check me-2"></i>'.count($mails).' email'.$s.'</div>';
                $statutEmail[$enfant->id]['textcolor'] = 'green';
            } else {
                $statutEmail[$enfant->id]['success'] = false;
                $statutEmail[$enfant->id]['msg'] = '<i class="fa-solid fa-triangle-exclamation me-2"></i>Aucun email';
                $statutEmail[$enfant->id]['textcolor'] = 'orange';
            }

            for ($periode=1; $periode<=$maxPeriode; $periode++) {
                $r = $reussites->where('periode', $periode)->where('enfant_id', $enfant->id)->first();
                if(!empty($r->send_at)) {
                    $statutCahier[$enfant->id][$periode]['msg'] = 'Envoyé le '.Carbon::parse($r->send_at)->format('d/m/Y');
                    $statutCahier[$enfant->id][$periode]['status'] = 'ENVOYE';
                    $statutCahier[$enfant->id][$periode]['textcolor'] = 'black';
                    $statutCahier[$enfant->id][$periode]['downloaded'] = 'Téléchargé le '.Carbon::parse($r->downloaded_at)->format('d/m/Y H:i:s');
                } else {
                    // différents états du cahier
                    if(!empty($r)) {
                        // cahier crée
                        if($r->definitif == 1) {
                            // cahier prêt
                            $statutCahier[$enfant->id][$periode]['msg'] = '<i class="fa-regular fa-paper-plane fa-lg"></i> Envoyer';
                            $statutCahier[$enfant->id][$periode]['status'] = 'PRET';
                            $statutCahier[$enfant->id][$periode]['textcolor'] = 'green';
                            $statutCahier[$enfant->id][$periode]['title'] = 'Le cahier est prêt à être envoyé';
                            $displayBtnBulk[$periode] = $classeEmails & count($mails) > 0;
                        } else {
                            // cahier non terminé
                            $statutCahier[$enfant->id][$periode]['msg'] = '<i class="fa-solid fa-circle-exclamation"></i>';
                            $statutCahier[$enfant->id][$periode]['status'] = 'PASPRET';
                            $statutCahier[$enfant->id][$periode]['textcolor'] = 'orange';
                            $statutCahier[$enfant->id][$periode]['title'] = 'Le cahier n\'est pas encore prêt à l\'envoi';
                        }
                    } else {
                        // cahier non crée
                        $statutCahier[$enfant->id][$periode]['msg'] = '<i class="fa-solid fa-circle-question"></i>';
                        $statutCahier[$enfant->id][$periode]['status'] = 'INCONNU';
                        $statutCahier[$enfant->id][$periode]['textcolor'] = 'red';
                        $statutCahier[$enfant->id][$periode]['title'] = 'Le cahier n\'est pas encore créé pour la période';
                    }
                }
            }
        }

        return view('synthese.manage')
            ->with('maxPeriode', $maxPeriode)
            ->with('statutCahier', $statutCahier)
            ->with('statutEmail', $statutEmail)
            ->with('enfants', $enfants)
            ->with('displayBtnBulk', $displayBtnBulk)
            ->with('reussites', $reussites);
    }
}
