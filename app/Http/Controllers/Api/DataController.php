<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Enfant;
use App\Models\Item;
use App\Models\Resultat;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DataController extends Controller
{
    
    public function chargerLaClasse() {
        try {
            $user = auth('sanctum')->user();
            $enfants = Enfant::select('id','nom','prenom','photo','genre','groupe')->where('user_id', $user->id)->get();
            $sections = Section::select('id','court')->get();
            $resultats = Resultat::select('id','item_id','enfant_id','notation','section_id','autonome')
                ->where('user_id', $user->id)
                ->get();

            $items = Item::select('items.id','items.name','items.section_id','items.lvl','items.st')
	->join('fiches', 'fiches.item_id', '=', 'items.id')
                ->where('fiches.user_id', $user->id)
                ->get();
/*
$items = Item::select('id','name','section_id','lvl','st')
                ->where('user_id', null)
                ->orWhere('user_id', $user->id)
                ->get();
*/

            return response()->json([
                'success' => true,
                'enfants' => $enfants,
                'sections' => $sections,
                'resultats' => $resultats,
                'items' => $items,
            ], 200);

            //return $classe->toJson();
            /*
            return response()->json([
                'classe' => $classe,
            ], 200);
            */
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
	$resultat = Resultat::create([
            'item_id' => $request->item_id,
            'enfant_id' => $request->enfant_id,
            'notation' => $request->notation,
            'section_id' => $request->section_id,
            'user_id' => $user->id,
            'groupe' => $request->groupe,
	'autonome' => $request->autonome,
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
