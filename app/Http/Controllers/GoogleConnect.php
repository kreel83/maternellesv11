<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\utils\Google;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoogleConnect extends Controller
{
    public function connect(Request $request) {
        //dd($request);
        $client = new Google();
        $endpoint_token = $client->endpoint('token');
        $endpoint_userinfo = $client->endpoint('userinfo');


//dd($endpoint_userinfo);
        $code = $request->code;




        $token = $client->token($endpoint_token, $code);


        $userinfo = $client->userinfo($endpoint_userinfo, $token);
        if ($userinfo->email_verified) {
            $user = User::where('email', $userinfo->email)->first();
            if ($user) {
                Auth::login($user);
                return redirect()->route('eleves');
            } else {
                dd('no prof');
            }
        } else {
            dd('erreur');
        }


    }
}
