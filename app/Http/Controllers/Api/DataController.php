<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Enfant;
use App\Models\Item;
use App\Models\Resultat;
use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DataController extends Controller
{
    
    public function chargerLaClasse() {
        try {
            $user = auth('sanctum')->user();
            $groupes = $user->configuration->groupes;
            $groupes = json_decode($groupes);
            foreach ($groupes as $key=>$groupe) {
                $groupe->id = $key;
                $groupes[$key] = $groupe;
            }
            $all['name']='Tous';
            $all['backgroundColor'] = '#cccccc';
            $all['textColor'] = '#000000';
            $all['id'] = -1;
            $groupes[$key+1] = json_decode(json_encode($all));

	        $user->setVisible(['id','name','prenom']);
            
            $dispatcher = Enfant::getEventDispatcher();
            Enfant::unsetEventDispatcher();
            $enfants = Enfant::select('id','nom','prenom','photo','genre','groupe')->where('user_id', $user->id)->get();
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
	            'groupes' => $groupes,
                'user' => $user,
                'enfants' => $enfants,
                'sections' => $sections,
                'resultats' => $resultats,
                'items' => $items,
            ], 200);

        } catch (\Throwable $th) {
            dd($th);
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function ajouterUnResultat(Request $request) {
        try {
            //Log::info($request);
            $user = auth('sanctum')->user();
            $enfant = Enfant::find($request->enfant_id);
            $resultat = Resultat::create([
                'item_id' => $request->item_id,
                'enfant_id' => $request->enfant_id,
                'notation' => $request->notation,
                'section_id' => $request->section_id,
                'user_id' => $user->id,
                'groupe' => $request->groupe,
                'autonome' => $request->autonome,
                'periode' => $enfant->periode,
                //'periode' => $user->configuration->periode,
            ]);

            return response()->json([
                'success' => true,
                'resultat' => $resultat,
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function modifierUnResultat(Request $request) {
        try {
            //Log::info($request);
            $resultat = Resultat::find($request->id);
            $resultat->notation = $request->notation;
            $resultat->autonome = $request->autonome;
            $resultat->save();
            
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
