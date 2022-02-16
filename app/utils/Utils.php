<?php
namespace App\utils;

use App\Models\Enfant;

class Utils {


    private function array_flatten($array)
    {
        if (!is_array($array)) {
            return false;
        }
        $result = array();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result = array_merge($result, self::array_flatten($value));
            } else {
                $result = array_merge($result, array($key => $value));
            }
        }
        return $result;
    }

        public static function traitementPronom($comment, $enfant)
    {
        $enfant = Enfant::find($enfant);
        if ($enfant->genre == 'G') {
            $pronom = 'Il';
        } else {
            $pronom = 'Elle';
        }
        $prenom = $enfant->prenom;
        $pos = strpos($comment, $prenom);
        if ($pos !== false) {
            $start = $pos + strlen($prenom);
            $c = substr($comment, 0, strlen($prenom)) . str_replace($prenom, $pronom, substr($comment, $start, -1));
        }
        //dd($c);
        return $c;
    }

    public static function traitement($commentaire, $enfant)
    {
        $genre = $enfant->genre;
        preg_match_all("/\*\w+\*/", $commentaire, $etoiles);
        if ($genre === 'F') {
            $commentaire = str_replace('*', '', $commentaire);
        } else {
            $commentaire = str_replace($etoiles[0], '', $commentaire);
        }
        preg_match_all("/@\w+@/", $commentaire, $matches);
        $modify = $commentaire;

        if (in_array('@name@', self::array_flatten($matches))) {
            $modify = str_replace('@name@', $enfant->prenom, $commentaire);
        }
        if (in_array('@ilelle@', self::array_flatten($matches))) {
            if ($genre == 'G') {
                $modify = str_replace('@ilelle@', "il", $modify);
            } else {
                $modify = str_replace('@ilelle@', "elle", $modify);
            }
        }
        if (in_array('@lela@', self::array_flatten($matches))) {
            if ($genre == 'G') {
                $modify = str_replace('@lela@', "le", $modify);
            } else {
                $modify = str_replace('@lela@', "la", $modify);
            }
        }
        if (in_array('@luielle@', self::array_flatten($matches))) {
            if ($genre == 'G') {
                $modify = str_replace('@luielle@', "lui", $modify);
            } else {
                $modify = str_replace('@luielle@', "elle", $modify);
            }
        }
        if (in_array('@pronom@', self::array_flatten($matches))) {
            if ($genre == 'G') {
                $modify = str_replace('@pronom@', "lui", $modify);
            } else {
                $modify = str_replace('@pronom@', "elle", $modify);
            }
        }
        preg_match_all("/%.+%/", $modify, $matches);

        foreach (self::array_flatten($matches) as $match) {
            $m = explode('-', $match);
            $modify = str_replace($match, "%%", $modify);
            if ($genre == 'G') {
                $modify = str_replace('%%', str_replace('%', '', $m[0]), $modify);
            } else {
                $modify = str_replace('%%', str_replace('%', '', $m[1]), $modify);

            }
        }

        return $modify;

    }



}
