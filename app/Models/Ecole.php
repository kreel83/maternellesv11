<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperEcole
 */
class Ecole extends Model
{
    use HasFactory;


    // public function checkcode($code)
    // {
    //     $ecole = $this->where('identifiant_de_l_etablissement', $code)->first();
    //     if(is_null($ecole)) {
    //         return json_encode([
    //             'result' => '0',
    //             'msg' => "Etablissement non trouvé !",
    //             'msgmail' => '',
    //             'mail' => ""
    //         ]);
    //     } else {
    //         $verif = User::where('ecole_id', $code)->first();
    //         if(!is_null($verif)) {
    //             return json_encode([
    //                 'result' => '0',
    //                 'msg' => "Un compte existe déjà pour cet établissement !",
    //                 'msgmail' => '',
    //                 'mail' => ""
    //             ]);
    //         } else {
    //             return json_encode([
    //                 'result' => '1',
    //                 'msg' => $ecole->nom_etablissement.', '.$ecole->adresse_1.', '.$ecole->adresse_3,
    //                 'msgmail' => 'Adresse email associée à cet établissement : <strong>'.$ecole->mail."</strong>. Assurez vous d'avoir accès à cette boite mail avant de continuer.",
    //                 'mail' => $ecole->mail
    //             ]);
    //         }
    //     }
    // }

}
