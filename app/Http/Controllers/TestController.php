<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TestController extends Controller
{
    
    public function crondeleteusers()
    {
        Log::info('Cron: delete-inactive-users {id}', ['id' => Carbon::now()->subMinutes(30)->toDateTimeString()]);
        // Users et Admin self registration - le mot de passe est renseigné
        User::where([
            ['actif', '=', '0'],
            ['password', '<>', ''],
            ['created_at', '<=', Carbon::now()->subMinutes(1)->toDateTimeString()]
        ])->delete();
        // Users crées par un Admin, délai plus long - le mot de passe est vide
        User::where([
            ['actif', '=', '0'],
            ['password', '=', ''],
            ['created_at', '<=', Carbon::now()->subMinutes(30)->toDateTimeString()]
            //['created_at', '<=', Carbon::now()->subDays(7)->toDateTimeString()]
        ])->delete();
    }

    public function testemaillogo()
    {
        $logoPath = public_path('img/deco/logo.png');
        $logo = "data:image/png;base64,".base64_encode(file_get_contents($logoPath));
        //dd($logo);
        $url = "";
        Mail::to('contact.clickweb@gmail.com')->send(new UserEmailVerificationSelfRegistration($logo, $url, 'test'));
    }

}
