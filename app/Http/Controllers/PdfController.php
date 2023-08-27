<?php

namespace App\Http\Controllers;

use App\Mail\EnvoiLeLienDeTelechargementDuCahier;
use App\Models\Enfant;
use App\Models\Image;
use App\Models\Resultat;
use App\Models\Reussite;
use App\Models\Section;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use PDF;
use Browser;


class PdfController extends Controller
{
    public function genereLienVersCahierEnPdf($id) {
        $enfant = DB::select('select ddn from enfants where id = ?', [$id]);
        //dd($enfant[0]->ddn);
        $token = md5($id.$enfant[0]->ddn.env('HASH_SECRET'));
        $url = route('cahier.predownload', ['id'=>$id, 'token'=>$token]);//.'?'.'id='.$id.'&token='.$token;
        //dd($url);
        Mail::to('thierry.thevenoud@gmail.com')->send(new EnvoiLeLienDeTelechargementDuCahier($url));
    }
    
    public function telechargementDuCahierParLesParents($id, $token) {
        // $id contient le ID de l'enfant
        return view('cahiers.telechargement')
            ->with('id', $id)
            ->with('token', $token);
    }

    public function telechargementDuCahierParLesParentsPost(Request $request) {

        $request->validate([
            'jour' => ['required', 'integer', 'max:31'],
            'mois' => ['required', 'integer', 'max:12'],
            'annee' => ['required', 'integer'],
        ], [
            'jour.required' => 'Le jour de naissance est obligatoire.',
            'jour.integer' => 'Le jour de naissance a un format invalide.',
            'jour.max' => 'Le jour de naissance doit être inférieur ou égal à 31.',
            'mois.required' => 'Le mois de naissance est obligatoire.',
            'mois.integer' => 'Le mois de naissance a un format invalide.',
            'mois.max' => 'Le mois de naissance doit être inférieur ou égal à 12.',
            'annee.required' => 'L\'année de naissance est obligatoire.',
            'annee.integer' => 'L\'année de naissance a un format invalide.',
        ]);
        $date = Carbon::create($request->annee, $request->mois, $request->jour);
        $ddn = $date->format('Y-m-d');
        $token = md5($request->id.$ddn.env('HASH_SECRET'));
        if($token != $request->token) {
            return Redirect::back()->withErrors(['msg' => 'Token invalide']);
        }
        
        $enfant = DB::select('select ddn from enfants where id = ?', [$request->id]);
        if(!$enfant) {
            return Redirect::back()->withInput()->withErrors(['msg' => 'Enfant non trouvé']);
        }

        if($ddn != $enfant[0]->ddn) {
            return Redirect::back()->withInput()->withErrors(['msg' => 'Enfant non trouvé (date de naissance erronée)']);
        }

        return Redirect::back()->with(['success' => true]);
        //return redirect()->action([PdfController::class, 'telechargeLeCahier'],['id' => $request->id]);

    }

    public function telechargeLeCahier($id) {
        
        //$rep = Auth::user()->repertoire;
        $resultats = Resultat::select('items.*','resultats.*','sections.name as name_section','sections.color')->join('items','items.id','resultats.item_id')
           ->join('sections','sections.id','resultats.section_id')
            ->where('enfant_id', $id)->orderBy('resultats.section_id')->get();
         

        // $resultats_personnels = Resultat::select('personnels.*','resultats.*','sections.name as name_section','sections.color')->join('personnels','personnels.id','resultats.item_id')
        //    ->join('sections','sections.id','resultats.section_id')
        //     ->where('enfant_id', $id)->orderBy('resultats.section_id')->get();
        //     $resultats = $resultats_items->merge($resultats_personnels);

        foreach ($resultats as $resultat) {
            $p = Image::find($resultat->image_id);
            $resultat->image = null;
            if ($p) {
                $resultat->image = 'storage/items/'.$p->name;
            }
        }

        $resultats = $resultats->groupBy('section_id')->toArray();
 
        $sections = Section::all()->toArray();
        $s = array();
        foreach ($sections as $section) {
            $s[$section['id']] = $section;
        }

        $enfant = Enfant::find($id);
        $name = $enfant->prenom.' '.$enfant->nom;
        $n = explode(' ', $name);
        $n=join('-', $n);

        $user = User::find($enfant->user_id);
        $equipes = $user->equipes();
        //$equipes = Auth::user()->equipes();

        $r = Reussite::where('enfant_id', $id)->first();
        $reussite = $r->texte_integral;
        
         //dd($reussite);
        $reussite = str_replace('</p><h2>','</p><div class="page-break"></div><h2>', $reussite);

        $pdf = PDF::loadView('pdf.reussite', ['reussite' => $reussite, 'resultats' => $resultats, 'sections' => $s, 'enfant' => $enfant, 'equipes' => $equipes, 'user' => $user]);
        // download PDF file with download method
        return $pdf->stream('test_cahier.pdf');            

    }

}
