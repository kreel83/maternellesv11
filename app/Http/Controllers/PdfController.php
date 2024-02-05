<?php

namespace App\Http\Controllers;

use App\Mail\EnvoiLeLienDeTelechargementDuCahier;
use App\Models\User;
use App\Models\Classe;
use App\Models\Ecole;
use App\Models\Enfant;
use App\Models\Reussite;
use App\utils\Utils;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class PdfController extends Controller
{

    public $maclasseactuelle;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {   
            $this->maclasseactuelle = session('classe_active');
            return $next($request);
        });
    }

    public static function genereLienVersCahierEnPdf(Enfant $enfant, $periode, $status = 'E') {
        // $status =  E (envoi)  R (renvoi)
        $token = $periode . md5($enfant->id.uniqid().config('app.custom.hash_secret'));
        $url = route('cahier.predownload', ['token' => $token]);
        $is_sent = false;
        // récupération mail et nom de l'école comme expéditeur du mail aux parents
        $ecole = Ecole::select('nom_etablissement', 'mail')
            ->where('identifiant_de_l_etablissement', session('classe_active')->ecole_identifiant_de_l_etablissement)
            ->first();
        // Envoi des emails aux contacts de l'enfant...
        $mails = $enfant->tableauDesMailsEnfant();
        foreach($mails as $email) {
            Mail::to($email)->send(new EnvoiLeLienDeTelechargementDuCahier($url, $ecole));
            $is_sent = true;
        }
        //$is_sent = false;
        if($is_sent) {
            $reussite = Reussite::where([
                ['user_id', session('classe_active')->user_id],
                ['enfant_id', $enfant->id],
                ['periode', $periode],
            ])->update(['send_at' => Carbon::now()]);
            if($reussite > 0) {
                $enfant->token = $token;
                // Si renvoi ou cahier existant pour une période supérieure, on n'incrémente pas la période de l'enfant
                if($status == 'E') {
                    $checkReussite = Reussite::where([
                        ['user_id', session('classe_active')->user_id],
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
        //$enfant = DB::table('enfants')->where('token', $token)->first()->prenom;
        $enfant = Enfant::where('token', $token)->first();
        $classe = Classe::find($enfant->classe_id);
        // sous cette forme pour ne pas declencher d'event
        //$user = DB::table('users')->select('civilite', 'prenom', 'name')->find($classe->user_id);
		$user = User::select('civilite', 'prenom', 'name')->find($classe->user_id);
        $ecole = Ecole::where('identifiant_de_l_etablissement', $classe->ecole_identifiant_de_l_etablissement)->first();
        // La période est le 1er caractère du Token
        $periode = Str::substr($token, 0, 1);
        $utils = new Utils;
        $periode = $utils->periode($enfant, $periode);
        if($enfant) {
            return view('cahiers.telechargement3')
                ->with('token', $token)
                ->with('periode', $periode)
                ->with('user', $user)
                ->with('ecole', $ecole)
                ->with('enfant', $enfant);
        }
    }
    // public function telechargementDuCahierParLesParents($token) {
    //     $enfant = DB::table('enfants')->where('token', $token)->first()->prenom;
    //     if($enfant) {
    //         return view('cahiers.telechargement2')
    //             ->with('token', $token)
    //             ->with('enfant', $enfant);
    //     }
    // }

    public function telechargementDuCahierParLesParentsPost(Request $request) {
        $date = Carbon::create($request->annee, $request->mois, $request->jour);
        $ddn = $date->format('Y-m-d');
        /*
        $token = md5($request->id.$ddn.config('app.custom.hash_secret'));
        if($token != $request->token) {
            return Redirect::back()->withErrors(['msg' => 'Token invalide']);
        }
        */
        
        $enfant = DB::table('enfants')->where('token', $request->token)->first();
        // $enfant = DB::select('select id,ddn from enfants where token = ?', [$request->token]);

        if(!$enfant) {
            return Redirect::back()->withInput()->withErrors(['msg' => 'Enfant non trouvé']);
        }

        // if($ddn != $enfant[0]->ddn) {
        if($ddn != $enfant->ddn) {
            return Redirect::back()->withInput()->withErrors(['msg' => 'Enfant non trouvé (date de naissance erronée)']);
        }

        return Redirect::back()->with(['success' => true, 'token' => $request->token]);

    }

    public function set_ordre(Request $request) {
        $classe = $this->maclasseactuelle;
        $classe->ordre_pdf = $request->ordre;
        $classe->save();
        return 'ok';
    }

    public function cahierManage(Request $request) {
        $ordre = $this->maclasseactuelle->ordre_pdf;
        $enfants = Enfant::where('classe_id', session('classe_active')->id)->orderBy($ordre)->get();
        $reussites = Reussite::where('user_id', session('classe_active')->user_id)->get();
        $maxPeriode = $request->user()->periodes;
        $statutCahier = array();
        $statutEmail = array();        
        $displayBtnBulk = array_fill(1, $maxPeriode, false);
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
                } else {
                    // différents états du cahier
                    if(!empty($r)) {
                        // cahier crée
                        if($r->definitif == 1) {
                            // cahier prêt
                            $statutCahier[$enfant->id][$periode]['msg'] = '<i class="fa-regular fa-paper-plane fa-lg"></i> Envoyer';
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
        Log::info($request);
        $error = array();
        $periode = $request->periode;
        $reussites = Reussite::where('user_id', session('classe_active')->user_id)
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
        }
        if($reussites->isEmpty()) {
            $error[] = "Aucun cahier à envoyer";
        }
        Session::flash('success', (count($error) == 0));
        Session::flash('error', $error);
        return route('cahierManage');
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
            $idtag = ($status == 'E') ? '#envoierror-'.$enfant->id : '#renvoi-'.$enfant->id;
            return json_encode(array('success' => false, 'idtag' => $idtag, 'status' => $status, 'enfant_id' => $enfant->id, 'msg' => '<div class="mt-2 mb-1 alert alert-danger" role="alert">L\'envoi a échoué</div>'));
        }
    }

}
