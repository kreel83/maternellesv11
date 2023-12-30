<?php
    $ps = (int) $fiche->lvl[0];
    $ms = (int) $fiche->lvl[1];
    $gs = (int) $fiche->lvl[2];
    $lvl = json_encode([$ps, $ms, $gs]);
    

    $classification = $classifications[$fiche->section_id] ?? [];
   


?>
<!-- Fonctionne mais enormement de requetes -->
<style>
    .coder {
        padding: 2px;
        font-size: 14px;
        cursor: pointer;
        background-color: white;
        color: pink;
        margin: 4px;
        height: 25px;
    }
    .coder:hover {

        background-color: red;
        color: white;

    }
    .coder.active {

        color: white;
        background-color: pink;

    }
</style>

<li class="card_fiche {{$key==0 ? 'fiche_exemple' : null}} shadowDepth1 ui-state-default position-relative {{$fiche->section_id == $section->id ? null : 'd-none'}}"  data-table="{{$fiche->getTable()}}" data-categorie="{{$fiche->categorie_id}}" data-section="{{$fiche->section_id}}" data-type="{{$type}}" data-level="{{$lvl}}" data-fiche="{{$fiche->id}}" data-ps="{{$ps}}" data-ms="{{$ms}}" data-gs="{{$gs}}" data-classe="{{json_encode($classifications[$fiche->section_id] ?? [])}}">
{{-- <div class="actiontemp">
    @foreach ($classification as $classe)
    <div class="coder {{ $fiche->classification_id == $classe['id'] ? 'active' : null}}" title="{{$classe['section1']}}" data-fiche={{$fiche->id}} data-id={{$classe['id']}}>{{$classe['code']}}</div>
    @endforeach
</div> --}}
<div class="action d-flex flex-column justify-content-center align-items-center">
    @php
        //dd($fiche->section());
    @endphp
    <button class="btnSelection   d-none retirer my-2" style="background-color: {{$fiche->section()->color}}" >Retirer</button>
    <button class="btnSelection   selectionner my-2" style="background-color: {{$fiche->section()->color}}" >Selectionner</button>
    <button data-id="{{$fiche->id ?? null}}" style="background-color: {{$fiche->section()->color}}"  class="btnSelection  dupliquer my-2">Dupliquer</button>
    {{-- <button data-id="{{$fiche->id ?? null}}" style="background-color: {{$fiche->section()->color}}"  class="biblioModalFiche btnSelection changer my-2" data-bs-toggle="modal"
        data-bs-target="#biblioModal">image</button> --}}
    {{-- <button data-id="{{$fiche->id ?? null}}" style="background-color: {{$fiche->section()->color}}"  class="biblioModalCategories btnSelection changer my-2" data-bs-toggle="modal"
        data-bs-target="#biblioModalCategories" data-categories="{{$fiche->categories()}}">categories</button> --}}
    <button data-id="{{$fiche->id ?? null}}" style="background-color: {{$fiche->section()->color}}" class="btnSelection {{$fiche->user_id ? null : 'd-none'}} modifier my-2">Modifier</button>
</div>
    <div class="perso_card">
            @if ($fiche->user_id)
            <span data-id="{{$fiche->id}}" data-section="{{$section->id}}"><i class="fas fa-user" style="color: var(--main-color)"></i></span>
            @endif


    </div>

        <div class="card__image">
            <img src="{{asset($fiche->image_name)}}" alt="image" class="border-tlr-radius">
        </div>

        <div class="card-footer" style="font-size: 12px;border-color: {{$fiche->section()->color}} !important">
            <div style="font-weight: bolder;" class="st">{{$fiche->categorie->section2 ?? null}}</div>
            <div>{{$fiche->name}}</div>
        </div>
        <div class="card-footer2" style="padding: 0; background: linear-gradient(164deg, {{$fiche->section()->color}} 23%, #ecf0f1 74%)" data-id="{{$fiche->id}}">
        {{-- <div class="card-footer2" style="padding: 0; background-color: {{$fiche->section()->color}}; background: linear-gradient(to bottom, {{$fiche->section()->color}}, #ecf0f1); " data-id="{{$fiche->id}}; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);"> --}}
           
                <style>
                    .caseLvl.ps.active {
                        /* background-color: var(--pink); */
                        border: 1px solid white;
                        font-weight: bolder;
                    }
                    .caseLvl.ms.active {
                        /* background-color: var(--green); */
                        border: 1px solid white;
                        font-weight: bolder;
                    }
                    .caseLvl.gs.active {
                        border: 1px solid white;
                        font-weight: bolder;
                        /* background-color: var(--rouge); */
                    }
                </style>
                
                    <div class="p-0 caseLvl ps {{ $ps == "1" ? 'active' : null }}" >PS</div>
                    <div class="p-0 caseLvl ms {{ $ms == "1" ? 'active' : null }}" >MS</div>
                    <div class="p-0 caseLvl gs {{ $gs == "1" ? 'active' : null }}" >GS</div>
                    {{-- <div class="ms-5">{{$fiche->id}}</div> --}}
                    {{-- <button data-id="{{$fiche->id ?? null}}" style="background-color: {{$fiche->section()->color}}" class="btnSelection }} modifier my-1">Modifier</button>
                    <div>{{$fiche->id}}</div> --}}
        </div>

</li>
