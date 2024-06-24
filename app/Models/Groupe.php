<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupe extends Model
{
    use HasFactory;


    const BADGE = [
        'b1' => 'FF5733' ,
        'b2' => 'FF8D33' ,
        'b3' => 'FFC300' ,
        'b4' => 'DAF7A6' ,             
        'b5' => '33FF57' ,
        'b6' => '33FFC6' ,             
        'b7' => '33C6FF' ,
        'b8' => '3385FF' ,
        'b9' => '5733FF' ,
        'b10' =>  '8D33FF' ,
        'b11' => 'C300FF' ,
        'b12' => 'FF33A8' ,
        'b13' => 'FF3385' ,
        'b14' => 'FF3357' ,             
        'b15' => 'FF336E' ,
        'b16' => 'FF5733' ,             
        'b17' => 'FF6E33' ,
        'b18' => 'FFA833 ',
        'b19' => 'FFD633 ',
        'b20' => 'C6FF33 ',
        'b21' => 'linear-gradient(to top, #6495ED 0%, #6495ED 100%);',
        'b22' => 'linear-gradient(to top, #FF8C00 0%, #FF8C00 100%);',
        'b23' => 'linear-gradient(to top, #9932CC 0%, #9932CC 100%)',
        'b24' => 'linear-gradient(to top, #00CED1 0%, #00CED1 100%);',             
        'b25' => 'linear-gradient(to top, #8A2BE2 0%, #8A2BE2 100%);',
        'b26' => 'linear-gradient(to top, #8B0000 0%, #8B0000 100%);',             
        'b27' => 'linear-gradient(to top, #00FFFF 0%, #00FFFF 100%);',
        'b28' => 'linear-gradient(to top, #FFA500 0%, #FFA500 100%);',
        'b29' => 'linear-gradient(to top, #800080 0%, #800080 100%);',
        'b30' => 'linear-gradient(to top, #00FF7F 0%, #00FF7F 100%);',
        // 'b10' => '0ba360:0ba360'    // ligne degradé à créer dans eventEnfant                 
    ];
}
