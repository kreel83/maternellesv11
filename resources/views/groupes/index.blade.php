@extends('layouts.mainMenu', ['titre' => "Les groupes d'élèves", 'menu' => 'groupe'])

@section('content')
@php
    use App\Models\Enfant;
@endphp
    <style>
        #myTabContent {
            background-color: purple;
        }
        .terme.selected {
            outline: 2px solid purple;
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

        .br-40 {
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

    <div id="page_groupes" class="row vh-100">
        <div class="col-md-6 p-5" id="termes-tab-pane">
            <form action="{{ route('saveTermes') }}" method="POST">
                @csrf
                <label for="">Nombre de groupes</label>
                <input type="number" value="{{$nbGroupe ?? 2}}"  min="2" max="4" class="form-control" id="nbGroupe" name="nbGroupe">

                @foreach($groupes as $key=>$groupe)
                <div class="icone-input my-4 terme {{$key == 0 ? 'selected' : null}}" id="terme{{$key+1}}">
                    <div class="badge_terme"  style="background-color:{{$groupe['backgroundColor'] ?? Enfant::GROUPE_COLORS["1"]}}; color: {{$groupe['textColor'] ?? '#FFFFFF'}}">{{ $groupe['name'] ?? null }}</div>
                    <input type="hidden" class="policeColor" name="font[]"   value="{{$groupe['textColor'] ?? '#FFFFFF'}}">
                    <input type="hidden" class="fondColor" name="back[]"   value="{{$groupe['backgroundColor'] ??Enfant::GROUPE_COLORS["1"]}}">
                    <input type="text" class="custom-input  br-40" name="termes[]"
                    value="{{ $groupe['name'] ?? null }}" placeholder="Terme n°{{$key + 1}}" />
                </div>
                @endforeach
                {{-- <div class="icone-input my-4 terme " id="terme2">
                    <div class="badge_terme"  style="background-color:{{$groupes[1]['backroundColor'] ?? Enfant::GROUPE_COLORS["2"]}}; color: {{$groupes[1]['textColor'] ?? '#FFFFFF'}}">{{ $groupes[1]['name'] ?? null }}</div>
                    <input type="hidden" class="policeColor" name="font[]"   value="{{$groupes[1]['textColor'] ?? '#FFFFFF'}}">
                    <input type="hidden" class="fondColor" name="back[]"   value="{{$groupes[1]['backroundColor'] ??Enfant::GROUPE_COLORS["2"]}}">
                    <input type="text" class="custom-input  br-40" name="termes[]"
                    value="{{ $groupes[1]['name'] ?? null }}" placeholder="Terme n°2" />
                </div>
                <div class="icone-input my-4 terme {{ $nbGroupe >= 3 ? null : 'd-none'}}" id="terme3">
                    <div class="badge_terme"  style="background-color:{{$groupes[2]['backroundColor'] ?? Enfant::GROUPE_COLORS["3"]}}; color: {{$groupes[2]['textColor'] ?? '#FFFFFF'}}">{{ $groupes[2]['name'] ?? null }}</div>
                    <input type="hidden" class="policeColor" name="font[]"   value="{{$groupes[2]['textColor'] ?? '#FFFFFF'}}">
                    <input type="hidden" class="fondColor" name="back[]"   value="{{$groupes[2]['backroundColor'] ??Enfant::GROUPE_COLORS["3"]}}">
                    <input type="text" class="custom-input  br-40" name="termes[]"
                    value="{{ $groupes[2]['name'] ?? null }}" placeholder="Terme n°3" />
                </div>
                <div class="icone-input my-4 terme {{ $nbGroupe == 4 ? null : 'd-none'}}" id="terme4">
                    <div class="badge_terme"  style="background-color:{{$groupes[3]['backroundColor'] ?? Enfant::GROUPE_COLORS["4"]}}; color: {{$groupes[3]['textColor'] ?? '#FFFFFF'}}">{{ $groupes[3]['name'] ?? null }}</div>
                    <input type="hidden" class="policeColor" name="font[]"   value="{{$groupes[3]['textColor'] ?? '#FFFFFF'}}">
                    <input type="hidden" class="fondColor" name="back[]"   value="{{$groupes[3]['backroundColor'] ??Enfant::GROUPE_COLORS["4"]}}">
                    <input type="text" class="custom-input  br-40" name="termes[]"
                    value="{{ $groupes[3]['name'] ?? null }}" placeholder="Terme n°4" />
                </div> --}}



                {{-- <textarea  class="form-control" name="" id="termes" cols="10" rows="5">
                    {{ $type == 'termes' ? $groupe : null}}
                </textarea> --}}
                <div>
                    <button type="submit" class="btn btn-primary mt-5" id="saveTermes">Sauvegarder</button>
                </div>
            </form>
        </div>
        <div class="col-md-6 p-5" id="myTabContent">
            <hr>
            <small>couleur du badge</small>
            <div class="d-flex flex-wrap w-100">
                @foreach (App\Models\Enfant::GROUPE_COLORS as $key => $color)
                    <div class="rond_couleur ronds"  data-color="{{$color}}" style="background-color: {{ $color }}">
                       
                    </div>
                @endforeach
            </div>
            <hr>
            <small>couleur de l'écriture</small>
            <div class="d-flex flex-wrap w-100">
                @foreach (App\Models\Enfant::GROUPE_COLORS_FONT as $key => $color)
                    <div class="rond_couleur_font ronds" data-color="{{$color}}" style="background-color: {{ $color }}">
                      
                    </div>
                @endforeach
            </div>

        </div>
    </div>
    
    @endsection
    