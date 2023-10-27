<?php

namespace App\Http\Controllers;

use App\Mail\EnvoiLeLienDeTelechargementDuCahier;
//use App\Models\Configuration;
use App\Models\Enfant;
//use App\Models\Image;
//use App\Models\Resultat;
use App\Models\Reussite;
//use App\Models\Section;
//use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
//use PDF;
//use Browser;
//use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

//use function PHPUnit\Framework\isEmpty;

class PdfController extends Controller
{
    public static function genereLienVersCahierEnPdf($enfant, $periode, $status = 'E') {
        // $status =  E (envoi)  R (renvoi)
        //$enfant = Enfant::find($enfant_id);
        $token = $periode.uniqid();
        $url = route('cahier.predownload', ['token' => $token]);
        $is_sent = false;
        if(filter_var($enfant->mail1, FILTER_VALIDATE_EMAIL)) {
            Mail::to($enfant->mail1)->send(new EnvoiLeLienDeTelechargementDuCahier($url));
            $is_sent = true;
        }
        if(filter_var($enfant->mail2, FILTER_VALIDATE_EMAIL)) {
            Mail::to($enfant->mail2)->send(new EnvoiLeLienDeTelechargementDuCahier($url));
            $is_sent = true;
        }
        
        if($is_sent) {
            $reussite = Reussite::where([
                ['user_id', Auth::id()],
                ['enfant_id', $enfant->id],
                ['periode', $periode],
            ])->update(['send_at' => Carbon::now()]);
            if($reussite > 0) {
                $enfant->token = $token;
                // Si renvoi ou cahier existant pour une période supérieure, on n'incrémente pas la période de l'enfant
                if($status == 'E') {
                    $checkReussite = Reussite::where([
                        ['user_id', Auth::id()],
                        ['enfant_id', $enfant->id],
                        ['periode', '>', $periode],
                    ]);
                    if($checkReussite->count() == 0) {
                        $enfant->periode = $enfant->periode + 1;
                    }
                }
                $enfant->save();
            } else {
                $is_sent = false;
            }
        }
        return $is_sent;
    }
    
    public function telechargementDuCahierParLesParents($token) {
        return view('cahiers.telechargement')
            ->with('token', $token);
    }

    public function telechargementDuCahierParLesParentsPost(Request $request) {

        $request->validate([
            'jour' => ['required', 'integer', 'max:31'],
            'mois' => ['required', 'integer', 'max:12'],
            'annee' => ['required', 'integer'],
            'token' => ['exists:enfants'],
        ], [
            'jour.required' => 'Le jour de naissance est obligatoire',
            'jour.integer' => 'Le jour de naissance a un format invalide',
            'jour.max' => 'Le jour de naissance doit être inférieur ou égal à 31',
            'mois.required' => 'Le mois de naissance est obligatoire',
            'mois.integer' => 'Le mois de naissance a un format invalide',
            'mois.max' => 'Le mois de naissance doit être inférieur ou égal à 12',
            'annee.required' => 'L\'année de naissance est obligatoire',
            'annee.integer' => 'L\'année de naissance a un format invalide',
            'token.exists' => 'Token invalide',
        ]);
        
        $date = Carbon::create($request->annee, $request->mois, $request->jour);
        $ddn = $date->format('Y-m-d');
        /*
        $token = md5($request->id.$ddn.env('HASH_SECRET'));
        if($token != $request->token) {
            return Redirect::back()->withErrors(['msg' => 'Token invalide']);
        }
        */
        
        $enfant = DB::select('select id,ddn from enfants where token = ?', [$request->token]);
        if(!$enfant) {
            return Redirect::back()->withInput()->withErrors(['msg' => 'Enfant non trouvé']);
        }

        if($ddn != $enfant[0]->ddn) {
            return Redirect::back()->withInput()->withErrors(['msg' => 'Enfant non trouvé (date de naissance erronée)']);
        }

        return Redirect::back()->with(['success' => true, 'token' => $request->token]);
        //return redirect()->action([PdfController::class, 'telechargeLeCahier'],['id' => $request->id]);

    }

    public function cahierManage(Request $request) {
        $enfants = Enfant::where('user_id', Auth::id())->get();
        $reussites = Reussite::where('user_id', Auth::id())->get();
        $maxPeriode = $request->user()->periodes;
        $statutCahier = array();
        $statutEmail = array();
        $displayBtnBulk = array_fill(1, $maxPeriode, false);
        foreach ($enfants as $enfant) {

            if (filter_var($enfant->mail1, FILTER_VALIDATE_EMAIL) || filter_var($enfant->mail2, FILTER_VALIDATE_EMAIL)) {
                $statutEmail[$enfant->id]['success'] = true;
                $contactEmails = array();
                if (filter_var($enfant->mail1, FILTER_VALIDATE_EMAIL)) {
                    $contactEmails[] = $enfant->mail1;
                }
                if (filter_var($enfant->mail2, FILTER_VALIDATE_EMAIL)) {
                    $contactEmails[] = $enfant->mail2;
                }
                $statutEmail[$enfant->id]['msg'] = implode(' ; ', $contactEmails);;
                $statutEmail[$enfant->id]['textcolor'] = 'black';
            } else {
                $statutEmail[$enfant->id]['success'] = false;
                $statutEmail[$enfant->id]['msg'] = '<i class="fa-solid fa-triangle-exclamation"></i> Aucun email défini';
                $statutEmail[$enfant->id]['textcolor'] = 'orange';
            }

            for ($periode=1; $periode<=$maxPeriode; $periode++) {
                $r = $reussites->where('periode', $periode)->where('enfant_id', $enfant->id)->first();
                if(!empty($r->send_at)) {
                    $statutCahier[$enfant->id][$periode]['msg'] = '<i class="fa-solid fa-check"></i> Envoyé le '.Carbon::parse($r->send_at)->format('d/m/Y');
                    $statutCahier[$enfant->id][$periode]['status'] = 'ENVOYE';
                    $statutCahier[$enfant->id][$periode]['textcolor'] = 'black';
                } else {
                    // différents états du cahier
                    if(!empty($r)) {
                        // cahier crée
                        if($r->definitif == 1) {
                            // cahier prêt
                            $statutCahier[$enfant->id][$periode]['msg'] = '<i class="fa-solid fa-circle-check"></i>';
                            $statutCahier[$enfant->id][$periode]['status'] = 'PRET';
                            $statutCahier[$enfant->id][$periode]['textcolor'] = 'green';
                            $displayBtnBulk[$periode] = true;
                        } else {
                            // cahier non terminé
                            $statutCahier[$enfant->id][$periode]['msg'] = '<i class="fa-solid fa-circle-exclamation"></i>';
                            $statutCahier[$enfant->id][$periode]['status'] = 'PASPRET';
                            $statutCahier[$enfant->id][$periode]['textcolor'] = 'orange';
                        }
                    } else {
                        // cahier non crée
                        $statutCahier[$enfant->id][$periode]['msg'] = '<i class="fa-solid fa-circle-question"></i>';
                        $statutCahier[$enfant->id][$periode]['status'] = 'INCONNU';
                        $statutCahier[$enfant->id][$periode]['textcolor'] = 'red';
                    }
                }
            }
        }
        return view('cahiers.manage')
            ->with('maxPeriode', $maxPeriode)
            ->with('statutCahier', $statutCahier)
            ->with('statutEmail', $statutEmail)
            ->with('enfants', $enfants)
            ->with('displayBtnBulk', $displayBtnBulk)
            ->with('reussites', $reussites);
    }

    public function cahierManagePost(Request $request) {
        //$tt=array();
        $error = array();
        $periode = $request->btnSubmit;
        $reussites = Reussite::where('user_id', Auth::id())
            ->where('definitif', 1)
            ->where('send_at', null)
            ->where('periode', $periode)
            ->get();
        foreach ($reussites as $reussite) {
            $enfant = Enfant::find($reussite->enfant_id);
            $isMailSent = $this->genereLienVersCahierEnPdf($enfant, $periode);
            if(!$isMailSent) {
                $error[] = "L'envoi a échoué pour la période $periode de $enfant->prenom $enfant->nom";
            }
            //$tt[] = $reussite->enfant_id;
        }
        if($reussites->isEmpty()) {
            $error[] = "Aucun cahier à envoyer";
        }
        //dd($tt);
        /*
        $tt=array();
        $error = array();
        $periode = $request->btnSubmit;
        $enfants = Enfant::where('user_id', Auth::id())->get();
        $reussites = Reussite::where('user_id', Auth::id())->get();
        foreach ($enfants as $enfant) {
            $r = $reussites->where('definitif', 1)
                    ->where('send_at', null)
                    ->where('periode', $periode)
                    ->where('enfant_id', $enfant->id)
                    ->first();
            if(!empty($r)) {
                $isMailSent = PdfController::genereLienVersCahierEnPdf($enfant);
                if(!$isMailSent) {
                    $error[] = "L'envoi a échoué pour la période $enfant->periode de $enfant->prenom $enfant->nom";
                }
                //$tt[] = $enfant->prenom.' '.$enfant->nom;
            }
        }
        */
        return back()->with('success', (count($error) == 0))->with('error', $error);
    }

    public function envoiCahierIndividuel(Request $request) {
        // $status : E (envoi)  R (renvoi)
        list($enfant_id, $periode, $status) = explode('-', $request->id);
        $enfant = Enfant::find($enfant_id);
        $is_sent = $this->genereLienVersCahierEnPdf($enfant, $periode, $status);
        $is_sent=true;
        if($is_sent) {
            $idtag = ($status == 'E') ? '#cahier-'.$enfant->id : '#renvoi-'.$enfant->id;
            $msg = ($status == 'E') ? '<i class="fa-solid fa-check fa-lg"></i> Envoyé le '.Carbon::now()->format('d/m/Y') : '<div class="mt-2 mb-1 alert alert-success" role="alert">Mail renvoyé</div>';
            return json_encode(array('success' => true, 'idtag' => $idtag, 'status' => $status, 'enfant_id' => $enfant->id, 'msg' => $msg));
        } else {
            $idtag = ($status == 'E') ? '#envoierror-'.$enfant->id : '#renvoierror-'.$enfant->id;
            return json_encode(array('success' => false, 'idtag' => $idtag, 'status' => $status, 'enfant_id' => $enfant->id, 'msg' => '<div class="mt-2 mb-1 alert alert-danger" role="alert">L\'envoi a échoué</div>'));
        }
    }

}
