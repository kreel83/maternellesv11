<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Fiche;
use App\Models\Item;
use App\Models\Resultat;
use App\Models\Personnel;
use App\Models\Section;
use App\Models\Classification;
use App\Models\Image as ImageTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Intervention\Image\ImageManager;
use SebastianBergmann\Type\TrueType;
use OpenAI\Laravel\Facades\OpenAI;

class ficheController extends Controller
{
    public function index(Request $request) {
        
        if ($request->section) {

            $section = Section::find($request->section);
        } else {

            $section = Section::first();
        }
        
        if (!isset($request->type)) $request->type = "mesfiches";

        $fiches = Auth::user()->mesfiches();
        $universelles = Auth::user()->items();
        
        $itemactuel = (isset($request->item)) ? Item::find($request->item) : null;
        $classifications = Classification::all();
        $classifications = $classifications->groupBy('section_id')->toArray();
        $categories = Categorie::where('section_id', $section->id)->get();
        $categories = $categories->groupBy('section1');


        

  

        return view('fiches.index')
            ->with('type', $request->type)
            ->with('categories', $categories)
            ->with('section', $section)
            ->with('fiches', $fiches)
            ->with('itemactuel', $itemactuel)
            ->with('classifications', $classifications)
            ->with('universelles', $universelles)
            ->with('user', Auth::id())
            ->with('sections', Section::orderBy('ordre')->get());
    }




    public function setNewCategories(Request $request) {
        $item = Item::find($request->fiche);
        $item->categorie_id = $request->cat;
        $item->save();
        return 'ok';
    }

    public function set_image(Request $request) {
        $item = Item::find($request->fiche);
        $nom = explode('/', $request->image)[1];
        $item->image_nom = $nom;
        $item->save();
        return 'ok';
    }

    public function get_images($section_id, Request $request) {
        $images = Storage::disk('image')->allFiles($section_id);
        
        return view('fiches.include.liste_images')->with('images', $images)->with('source', $request->source);
    }

    public function setLvl($fiche_id, Request $request) {
        $item = Item::find($fiche_id);
        
        $lvl['PS'] = substr($item->lvl,0,1);
        $lvl['MS'] = substr($item->lvl,1,1);
        $lvl['GS'] = substr($item->lvl,2,1);
        $lvl[$request->lvl] = $lvl[$request->lvl] == 1 ? 0 : 1;
        $item->lvl = $lvl['PS'].$lvl['MS'].$lvl['GS'];
        $item->save();
        return 'ok';



    }

    public function setClassification(Request $request) {
        $item = Item::find($request->item);
        $item->classification_id = $request->classe;
        $item->save();
        return 'ok';
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


    public function createFiche(Request $request) {
        
        if ($request->section)      {
            $section = Section::find($request->section);
        } else {
            //$section = Section::first();
            $section = null;
            $request->item = 'new';
        }

        if ($request->item == 'new') {
            $fiche = new Item();
            $categories = Categorie::all();
            $classifications = Classification::all();
            $new = true;
        } else {
            $fiche = Item::find($request->item);
            $categories = Categorie::where('section_id', $fiche->section_id)->get();
            $classifications = Classification::where('section_id', $fiche->section_id)->get();
            $new = false;
        }

        if ($request->duplicate == 'true') {
            $new = false;
            $fiche->id = null;
        }

        
        return view('fiches.create')
            ->with('sections', Section::all())
            ->with('new', $new)
            ->with('duplicate', $request->duplicate == "true" ? $request->item : false)            
            ->with('itemactuel', $fiche)
            ->with('menu', $request->duplicate == 'true' ? 'duplicate_item' : 'create_item')
            ->with('section', $section)
            ->with('categories', $categories)
            ->with('classifications', $classifications);
    }

    public function deselectionne() {
        Fiche::where('user_id', Auth::id())->delete();
        Resultat::where('user_id', Auth::id())->delete();
        return 'ok';
    }

    public function populateCategorie(Request $request) {
        $categories = Categorie::where('section_id', $request->section_id)->get();
        $categories = $categories->groupBy('section1');
       
        
        return view('fiches.include.categories')->with('categories', $categories);
        
    }

    public function populateClassification(Request $request) {
        $classifications = Classification::where('section_id', $request->section_id)->get();
        return json_encode($classifications);
    }


    public function retirerChoix(Request $request) {
        $fiche = Fiche::find($request->fiche);
        $fiche->delete();
        return 'deleted';
    }
    public function choix(Request $request) {


  
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
            $new->parent_type = null;
            $new->save();
            $order++;
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

        function chatpht($reussite) {            
            $content = "Met au féminin la phrase suivante : ".$reussite;
            $result = OpenAI::chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'user', 
                    'content' => $content],
                ],
               
            ]);
            
            return $result['choices'][0]['message']['content'];
        }

        


        // $name_file = uniqid().'.jpg';
        //dd($request);

        $img = null;
        if ($request->duplicate) {
            $item = Item::find($request->duplicate);
            $img = $item->image_nom;
        }
        
        if ($request->submit == 'modif')
        {
            Item::$FIRE_EVENTS = false;

            $item = Item::find($request->fiche_id);
            Item::$FIRE_EVENTS = true;

            $item->name = $request->name;
            if ($img) {
                $item->image_nom = $img;
            }
            if ($request->file) {
                $image = Image::make($request->file);
                $image->resize(null,250, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode('jpg', 75);
                $filename = Auth::id().'_'.uniqid().'.jpg';
                Storage::disk('image')->put($request->section_id.'/'.$filename, $image);
                // Storage::move($filename, 'public/img/items/' . $filename);
                // $image->move(public_path('img/items'), $name_file);
                $new = new ImageTable();
                $new->name = $filename;
                $new->save();
                $item->image_nom = $filename;
                $request->imageName = null;
            }  

            if ($request->imageName) {
                $item->image_nom = explode('/',$request->imageName)[1]; 
            }
            
            $item->section_id = $request->section_id;
            $item->categorie_id = $request->categorie_id;
            //$item->classification_id = $request->classification_id;
            $item->lvl = set_lvl($request);
            $item->st = $request->st;
            $item->user_id = Auth::id();
            $item->phrase_masculin = $request->phrase;
            if(trim($request->phrase_feminin) == '') {
                $item->phrase_feminin = chatpht($item->phrase_masculin);
            } else {
                $item->phrase_feminin = $request->phrase_feminin;
            }
            //$item->phrase_feminin = chatpht($item->phrase_masculin);
            
            $item->save();
        } 
        
        if (in_array($request->submit,['save','save_and_select'])) {
            $item = new Item();
            $item->name = $request->name;
            if ($request->file) {
                $image = Image::make($request->file);
                $image->resize(null,250, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode('jpg', 75);
                $filename = Auth::id().'_'.uniqid().'.jpg';
                Storage::disk('image')->put($request->section_id.'/'.$filename, $image);
                // Storage::move($filename, 'public/img/items/' . $filename);
                // $image->move(public_path('img/items'), $name_file);
                $new = new ImageTable();
                $new->name = $filename;
                $new->save();
                $item->image_nom = $filename;
                $request->imageName = null;
            } else {
                if ($request->imageName) {
                    $item->image_nom = $request->imageName; 
                } else {
                    $item->image_nom = $img; 

                }
            }
            $item->section_id = $request->section_id;
            $item->categorie_id = $request->categorie_id;
            //$item->classification_id = $request->classification_id;
            $item->lvl = set_lvl($request);
            $item->st = $request->st;
            $item->user_id = Auth::id();
            $item->phrase_masculin = $request->phrase;
            if(trim($request->phrase_feminin) == '') {
                $item->phrase_feminin = chatpht($item->phrase_masculin);
            } else {
                $item->phrase_feminin = $request->phrase_feminin;
            }
            $item->save();

            if ($request->submit == 'save_and_select') {
                $fiche = new Fiche();
                $fiche->item_id = $item->id;
                $fiche->order = Fiche::lastOrder();
                $fiche->perso = 1;
                $fiche->user_id = Auth::id();
                $fiche->section_id = $request->section_id;
                $item->categorie_id = $request->categorie_id;
                //$item->classification_id = $request->classification_id;
                $fiche->save();
            }
        }




        session()->flash('message', 'La fiche a bien été enregistrée'); 
        session()->flash('alert-class', 'alert-success'); 
        session()->flash('section', $request->section_id); 
        return redirect()->back()->withInput();
        
        

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
