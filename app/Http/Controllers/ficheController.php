<?php

namespace App\Http\Controllers;

use App\Models\Fiche;
use App\Models\Item;
use App\Models\Personnel;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Intervention\Image\ImageManager;

class ficheController extends Controller
{
    public function index(Request $request) {
        
            $section = Section::first();
        
        if (!isset($request->type)) $request->type = "mesfiches";

        $fiches = Auth::user()->mesfiches();
        $universelles = Auth::user()->items();

     

        $itemactuel = (isset($request->item)) ? Item::find($request->item) : null;

        return view('fiches.index')
            ->with('type', $request->type)
            ->with('section', $section)
            ->with('fiches', $fiches)
            ->with('itemactuel', $itemactuel)
            ->with('universelles', $universelles)
            ->with('user', Auth::id())
            ->with('sections', Section::all());
    }

    public function orderFiche(Request $request) {   

        foreach ($request->pos as $key=>$id) {
            $fiche = Fiche::find($id);
            $fiche->order = $key+1;
            $fiche->user_id = Auth::id();
            $fiche->save();
        }
        return 'ok';

    }

    public function retirerChoix(Request $request) {
        $fiche = Fiche::find($request->fiche);
        $fiche->delete();
        return 'deleted';
    }
    public function choix(Request $request) {

{
            $fiche = Fiche::where('user_id', Auth::id())->where('section_id',$request->section)->orderBy('order', 'DESC')->first();
            $order =  ($fiche) ? $fiche->order + 1 : 1;
            $fiche = new Fiche();
            $fiche->item_id = $request->fiche;
            $fiche->order = $order;
            $fiche->parent_type = $request->table;
            $fiche->section_id = $request->section;
            $fiche->user_id = Auth::id();
            $fiche->save();
            $t = $fiche->id;
        }

        return $t;
    }

    public function choisirSelection(Request $request) {
        $fiche = Fiche::where('user_id', Auth::id())->where('section_id',$request->section)->orderBy('order', 'DESC')->first();
        $order =  ($fiche) ? $fiche->order + 1 : 1;
        $tableau = json_decode($request->tableau);

        foreach ($tableau as $fiche) {

            $new = new Fiche();
            $new->item_id = $fiche->item;
            $new->user_id = Auth::id();
            $new->order = $order;
            $new->section_id = $request->section;
            $new->parent_type = $fiche->test;
            $new->save();
        }
        return 'ok';
    }

    private function set_last_id() {
        $item = Item::orderBy('id','DESC')->first()->id;
        $personnel = Personnel::orderBy('id','DESC')->first()->id;
        return ($item > $personnel) ? $item +1 : $personnel +1;
    }


    public function save_fiche(Request $request) {


        function set_lvl($request) {
            $lvl = '';
            $lvl .= isset($request->ps) ? '1' : '0';
            $lvl .= isset($request->ms) ? '1' : '0';
            $lvl .= isset($request->gs) ? '1' : '0';
            return $lvl;
        }


        $name_file = uniqid().'.jpg';
        $rep = Auth::user()->repertoire;
        if ($request->submit == 'modif')
        {
            $item = Personnel::find($request->personnel_id);
            $item->name = $request->name;
            if ($request->file) $item->image = 'storage/'.$rep.'/personnels/'.$name_file;
            $item->section_id = $request->section_id;
            $item->lvl = set_lvl($request);
            $item->st = $request->st;
            $item->user_id = Auth::id();
            $item->phrase = $request->phrase;
            $item->save();


        } else {
            $id = $this->set_last_id();


            $item = new Personnel();
            $item->id = $id;
            $item->name = $request->name;
            if ($request->file) $item->image = 'storage/'.$rep.'/personnels/'.$name_file;
            $item->section_id = $request->section_id;
            $item->lvl = set_lvl($request);
            $item->st = $request->st;
            $item->user_id = Auth::id();
            $item->phrase = $request->phrase;
            $item->save();

            if ($request->submit == 'save_and_select') {
                $fiche = new Fiche();
                $fiche->item_id = $id;
                $fiche->order = Fiche::lastOrder();
                $fiche->perso = 1;
                $fiche->user_id = Auth::id();
                $fiche->section_id = $request->section_id;
                $fiche->parent_type = "personnels";
                $fiche->save();


            }
        }









        //$r = $request->except(['_token','ps','fichems','gs', 'file', 'fiche_id', 'personnel_id' ]);

        //$name_file = uniqid().'.jpg';
        //$rep = Auth::user()->repertoire;
        $last_id = ($request->personnel_id) ? $request->personnel_id : $this->set_last_id();


//        $r['lvl'] = set_lvl($request);
//        if ($request->personnel_id) {
//            $p = Personnel::find($request->personnel_id);
//            $r['image'] = $p->image;
//        } else {
//            $r['image'] = null;
//        }
//        if ($request->file) $r['image'] = 'storage/'.$rep.'/personnels/'.$name_file;
//        $r['id'] = $last_id;
//        $r['status'] = Auth::id();
//
//        $path = storage_path($rep.'/personnels');
//        $personel = ($request->fiche_id) ? Personnel::find($request->personnel_id) : new Personnel();
//        $personel->updateOrCreate(['id' => $r['id']], $r);
//        $fiche = Fiche::where('user_id', Auth::id())->where('section_id',$request->section)->orderBy('order', 'DESC')->first();
//        $order =  ($fiche) ? $fiche->order + 1 : 1;
//
//        $search = Fiche::where('item_id', $request->personnel_id)->where('user_id', Auth::id())->first();
//
//        if (!$search) {
//            $fiche = new Fiche();
//            $fiche->parent_type = 'personnels';
//            $fiche->item_id = $last_id;
//            $fiche->order = $order;
//            $fiche->user_id = Auth::id();
//            $fiche->section_id = $request->section_id;
//            $fiche->save();
//        }

        if ($request->file) {
            $image = Image::make($request->file);
            $image->resize(null,250, function ($constraint) {
                $constraint->aspectRatio();
            })->encode('jpg', 75);
            $t = Storage::put($rep.'/personnels/'.$name_file, $image);
        }

        return redirect()->back();

    }




    public function duplicate(Request $request) {

        $last_id = $this->set_last_id();
        $item = Item::find($request->item)->toArray();
        $item['id'] = $this->set_last_id();


        Personnel::create($item);


//        if ($request->provenance == "fiche") {
//            $fiche = new Fiche();
//            $fiche->parent_type = 'personnels';
//            $fiche->item_id = $last_id;
//            $fiche->order = Fiche::lastOrder();
//            $fiche->user_id = Auth::id();
//            $fiche->section_id = $request->section;
//            $fiche->save();
//        }




        return 'ok';

    }
}
