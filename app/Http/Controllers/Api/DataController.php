<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\ClasseUser;
use App\Models\Enfant;
use App\Models\Item;
use App\Models\Resultat;
use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use function PHPUnit\Framework\isNull;

class DataController extends Controller
{
    
    public function chargerLaClasse() {
        try {
            $user = auth('sanctum')->user();

            $i = Classe::where('user_id', $user->id)->pluck('id');
            $t = ClasseUser::where('user_id', $user->id)->pluck('classe_id');
            $merged = $i->merge($t);
            $classes = Classe::whereIn('id', $merged)->get();
            //$classes = Classe::where('user_id', $user->id)->get();

            $groupes = array();
            foreach ($classes as $classe) {
                if($classe->id == $user->classe_id) {
                    if(!is_null($classe->groupes)) {
                        $groupes = $classe->groupes;
                        $groupes = json_decode($groupes);
                        if(count($groupes) > 0) {
                            $all['name']='Tous';
                            $all['backgroundColor'] = '#cccccc';
                            $all['textColor'] = '#000000';
                            $all['id'] = -1;
                            //$groupes[] = json_decode(json_encode($all));
                            $groupes[] = $all;
                        }
                    }
                    break;
                }
            }

	        $user->setVisible(['id', 'classe_id', 'name', 'prenom']);
            $classes->setVisible(['id', 'description']);
            
            $dispatcher = Enfant::getEventDispatcher();
            Enfant::unsetEventDispatcher();
            $enfants = Enfant::select('id','nom','prenom','photo','genre','groupe','periode')
                ->where('classe_id', $user->classe_id)
                ->get();
            Enfant::setEventDispatcher($dispatcher);

            $sections = Section::select('id','court')->get();

            $resultats = Resultat::select('id','item_id','enfant_id','notation','section_id','autonome')
                ->where('user_id', $user->id)
                ->get();

            $items = Item::select('items.id','items.name','items.section_id','items.lvl','items.st')
	            ->join('fiches', 'fiches.item_id', '=', 'items.id')
                ->where('fiches.user_id', $user->id)
                ->get();
                
            return response()->json([
                'success' => true,
                'is_abonne' => $user->is_abonne(),
                'evaluations_gratuites' => (int)config('app.custom.evaluations_gratuites'),
                'classes' => $classes,
	            'groupes' => $groupes,
                'user' => $user,
                'enfants' => $enfants,
                'sections' => $sections,
                'resultats' => $resultats,
                'items' => $items,
            ], 200);
            //], 200)->setEncodingOptions(JSON_NUMERIC_CHECK);

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

	public function nouvelleClasseParDefaut(Request $request) {
		try {
            $user = auth('sanctum')->user();
            $user->classe_id = $request->classe_id;
            $user->save();
            return response()->json([
                'success' => true,
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
            'message' => $th->getMessage()
            ], 500);
        }
	}

    public function ajouterUnResultat(Request $request) {
        try {
            Log::info($request);
            $user = auth('sanctum')->user();
            $resultat = new Resultat();
            $resultat->item_id = $request->item_id;
            $resultat->enfant_id = $request->enfant_id;
            $resultat->notation = $request->notation;
            $resultat->section_id = $request->section_id;
            $resultat->user_id = $user->id;
            $resultat->autonome = $request->autonome;
            $resultat->periode = $request->periode;
            $resultat->save();

            return response()->json([
                'success' => true,
                'resultat' => $resultat,
            ], 200);
            //->setEncodingOptions(JSON_NUMERIC_CHECK);

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'ajouteresultat'.$th->getMessage()
            ], 500);
        }
    }

    public function modifierUnResultat(Request $request) {
        try {
            Log::info($request);
            $resultat = Resultat::find($request->id);
            if($resultat) {
                
                if($request->notation != '0') {
                    $resultat->notation = $request->notation;
                    $resultat->autonome = $request->autonome;
                    $resultat->save();
                } else {
                    $resultat->delete();
                }
                
                return response()->json([
                    'success' => true,
                ], 200);
            } else {
                return response()->json([
                        'success' => false,
                        'message' => 'Erreur : impossible de changer le résultat de l\'activité'
                    ], 500);
            }

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function chargerLesSections() {
        try {
            $user = auth('sanctum')->user();
            $sections = Section::select('id','court')->get();
            //return $sections->toJson();
	
            return response()->json([
                'success' => true,
                'sections' => $sections,
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

}
