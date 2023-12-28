<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\SectionEvent;
use Illuminate\Support\Facades\Auth;

/**
 * @mixin IdeHelperSection
 */
class Section extends Model
{
    use HasFactory;

    protected $dispatchesEvents = [
        'retrieved' => SectionEvent::class,
    ];




    const COLOR = [

        'section0' => "#3fbafe",



        "section1" => "#fa99b2",




        "section2" => "#b69efe",




        "section3" => "#58d5c9",




        "section4" =>  "#c0a3e5",



        "section5" => "#e5dd62",



        "section6" => "rgba(86, 88, 84, 0.98)",


        "section7" => "rgba(202, 126, 49, 0.98)"
    ];

    public function items() {
        return $this->hasmany('App\Models\Item');
    }

    public function nbSection() {
        // return Fiche::where('section_id', $this->id)->where('classe_id', session()->get('id_de_la_classe'))->count();
        return Fiche::where('section_id', $this->id)->where('classe_id', session('classe_active')->id)->count();
    }

    public function commentaires() {
        return $this->hasMany('App\Models\Commentaire');
    }

    public function getCommentaires() {
        return $this->commentaires()->get();
    }

    public static function getColor($id) {
        $sections = Section::all()->pluck('id')->toArray();
        $s = array_flip($sections)[$id];
        return self::COLOR['section'.$s];

    }
}
