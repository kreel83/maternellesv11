<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Resultat;
use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    
    public function loginUser(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(), 
            [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'success' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'success' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();
            /*
            $sections = Section::select('id','court',)->get();
            $resultats = Resultat::select('id','item_id','enfant_id','notation','section_id','autonome')
                ->where('user_id', $user->id)
                ->get();
            $items = Item::select('id','name','section_id','lvl','st')
                ->where('user_id', null)
                ->orWhere('user_id', $user->id)
                ->get();
            */

            return response()->json([
                'success' => true,
                //'message' => 'User Logged In Successfully',
                'token' => $user->createToken("auth_token")->plainTextToken,
	            'user' => $user,
                //'sections' => $sections,
                //'resultats' => $resultats,
                //'items' => $items,
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            $user = auth('sanctum')->user();
            $tokenId = Str::before(request()->bearerToken(), '|');
            $user->tokens()->where('id', $tokenId )->delete();
            return response()->json([
                'success' => true,
                'message' => 'Utilisateur déconnecté',
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    
}
