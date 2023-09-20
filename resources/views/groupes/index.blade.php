@extends('layouts.mainMenu', ['titre' => "Les groupes d'élèves", 'menu' => 'groupe'])

@section('content')
@php
    use App\Models\Enfant;
@endphp
    <style>
        #myTabContent {
            background-color: var(--second-color);
        }

        .terme.selected {
            outline: 6px solid  var(--main-color);
            border-radius: 40px;
        }
        
        
        .ronds {
            padding: 2px 18px;
            font-weight: 700;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin: 4px;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            color: grey;
            font-size: 60px;
            border: 1px solid grey;
        }

        .couleur_badge_titre {
            color: var(--main-color);
            font-size: 20px;
        }
        
        .br-40 {
            cursor: pointer;
            border-radius: 40px !important;
        }

        .ronds:hover,
        .ronds.active {
            outline: 3px solid gray;
        }

        .fa-circle {
            font-size: 20px;
        }
    </style>
    @php
        // dd($groupes);
    @endphp

    <div id="page_groupes" class="row gx-0 vh-100">
        <div class="col-md-6 p-5" id="termes-tab-pane">
            <form action="{{ route('saveTermes') }}" method="POST">
                @csrf
                <div class="tuto_choix_nombre_groupe p-3 position-relative w-50" >

                    <label for="">Nombre de groupes</label>
                    <input type="number" value="{{$nbGroupe ?? 2}}"  min="2" max="4" class="form-control w-25" id="nbGroupe" name="nbGroupe">
                </div>

               <div class="tuto_selection_groupe p-3 position-relative">
                    <div class="icone-input my-4 terme " id="terme1">
                        <div class="badge_terme"  style="background-color:{{$groupes[0]['backgroundColor'] ?? Enfant::GROUPE_COLORS["1"]}}; color: {{$groupes[0]['textColor'] ?? '#FFFFFF'}}">{{ $groupes[0]['name'] ?? null }}</div>
                        <input type="hidden" class="policeColor" name="font[]"   value="#FFFFFF">
                        <input type="hidden" class="fondColor" name="back[]"   value="{{$groupes[0]['backrgoundColor'] ??Enfant::GROUPE_COLORS["1"]}}">
                        <input type="text" class="custom-input  br-40" name="termes[]"
                        value="{{ $groupes[0]['name'] ?? null }}" placeholder="Terme n°1" />
                    </div>
                
                    <div class="icone-input my-4 terme " id="terme2">
                        <div class="badge_terme"  style="background-color:{{$groupes[1]['backgroundColor'] ?? Enfant::GROUPE_COLORS["2"]}}; color: {{$groupes[1]['textColor'] ?? '#FFFFFF'}}">{{ $groupes[1]['name'] ?? null }}</div>
                        <input type="hidden" class="policeColor" name="font[]"   value="#FFFFFF">
                        <input type="hidden" class="fondColor" name="back[]"   value="{{$groupes[1]['backgroundColor'] ??Enfant::GROUPE_COLORS["2"]}}">
                        <input type="text" class="custom-input  br-40" name="termes[]"
                        value="{{ $groupes[1]['name'] ?? null }}" placeholder="Terme n°2" />
                    </div>
                    <div class="icone-input my-4 terme {{ $nbGroupe >= 3 ? null : 'd-none'}}" id="terme3">
                        <div class="badge_terme"  style="background-color:{{$groupes[2]['backgroundColor'] ?? Enfant::GROUPE_COLORS["3"]}}; color: {{$groupes[2]['textColor'] ?? '#FFFFFF'}}">{{ $groupes[2]['name'] ?? null }}</div>
                        <input type="hidden" class="policeColor" name="font[]"   value="#FFFFFF">
                        <input type="hidden" class="fondColor" name="back[]"   value="{{$groupes[2]['backgroundColor'] ??Enfant::GROUPE_COLORS["3"]}}">
                        <input type="text" class="custom-input  br-40" name="termes[]"
                        value="{{ $groupes[2]['name'] ?? null }}" placeholder="Terme n°3" />
                    </div>
                    <div class="icone-input my-4 terme {{ $nbGroupe == 4 ? null : 'd-none'}}" id="terme4">
                        <div class="badge_terme"  style="background-color:{{$groupes[3]['backgroundColor'] ?? Enfant::GROUPE_COLORS["4"]}}; color: {{$groupes[3]['textColor'] ?? '#FFFFFF'}}">{{ $groupes[3]['name'] ?? null }}</div>
                        <input type="hidden" class="policeColor" name="font[]"   value="#FFFFFF">
                        <input type="hidden" class="fondColor" name="back[]"   value="{{$groupes[3]['backgroundColor'] ??Enfant::GROUPE_COLORS["4"]}}">
                        <input type="text" class="custom-input  br-40" name="termes[]"
                        value="{{ $groupes[3]['name'] ?? null }}" placeholder="Terme n°4" />
                    </div>               
               </div>




                {{-- <textarea  class="form-control" name="" id="termes" cols="10" rows="5">
                    {{ $type == 'termes' ? $groupe : null}}
                </textarea> --}}
                <div>
                    <button type="submit" class="custom_button mt-5 w-25" id="saveTermes">Sauvegarder</button>
                </div>
            </form>
        </div>
        <div class="col-md-6 p-5" id="myTabContent">
            
            {{-- <div class="couleur_badge_titre">couleur du badge</div> --}}
            <div class="d-flex flex-wrap w-100 tuto_selection_couleur position-relative" style="padding: 0 125px;">
                @foreach (App\Models\Enfant::GROUPE_COLORS as $key => $color)
                    <div class="rond_couleur ronds"  data-color="{{$color}}" style="background-color: {{ $color }}">
                       
                    </div>
                @endforeach
            </div>


        </div>
    </div>
    
    @endsection
    