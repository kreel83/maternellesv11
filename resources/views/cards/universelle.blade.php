<?php
    $ps = (int) $fiche->lvl[0];
    $ms = (int) $fiche->lvl[1];
    $gs = (int) $fiche->lvl[2];
    $lvl = json_encode([$ps, $ms, $gs]);
    

    $classification = $classifications[$fiche->section_id] ?? [];
   


?>

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


<li class="card_fiche {{$key==0 ? 'fiche_exemple' : null}} shadowDepth1 ui-state-default position-relative {{$fiche->section_id == $section->id ? null : 'd-none'}}"  data-table="{{$fiche->getTable()}}" data-categorie="{{$fiche->categorie_id}}" data-section="{{$fiche->section_id}}" data-type="{{$type}}" data-level="{{$lvl}}" data-fiche="{{$fiche->id}}" data-ps="{{$ps}}" data-ms="{{$ms}}" data-gs="{{$gs}}">

<div class="action d-flex flex-column justify-content-center align-items-center">

    <button class="btnSelection   d-none retirer my-2" style="background-color: {{ $sections->where('id', $fiche->section_id)->first()->color ?? '' }}" >Retirer</button>
    <button class="btnSelection   selectionner my-2" style="background-color: {{ $sections->where('id', $fiche->section_id)->first()->color ?? '' }}" >Selectionner</button>
    <button data-id="{{$fiche->id ?? null}}" style="background-color: {{ $sections->where('id', $fiche->section_id)->first()->color ?? '' }}"  class="btnSelection  dupliquer my-2">Dupliquer</button>
    @if (in_array(auth::id(),[61,47]))
        <button data-id="{{$fiche->id ?? null}}" style="background-color: {{$fiche->section()->color}}"  class="biblioModalFiche btnSelection changer my-2" data-bs-toggle="modal"
            data-bs-target="#biblioModal">image</button>
        <button data-id="{{$fiche->id ?? null}}" style="background-color: {{$fiche->section()->color}}"  class="biblioModalCategories btnSelection changer my-2" data-bs-toggle="modal"
            data-bs-target="#biblioModalCategories" data-categories="{{$fiche->categories()}}">categories</button>
    @endif
    <button data-id="{{$fiche->id ?? null}}" style="background-color: {{ $sections->where('id', $fiche->section_id)->first()->color ?? '' }}" class="btnSelection {{$fiche->user_id ? null : 'd-none'}} modifier my-2">Modifier</button>
</div>
    <div class="perso_card">
            @if ($fiche->user_id)
            <span data-id="{{$fiche->id}}" data-section="{{$section->id}}"><i class="fas fa-user" style="color: var(--main-color)"></i></span>
            @endif
    </div>

        <div class="card__image">
            <img src="{{asset($fiche->image_name)}}" class="border-tlr-radius">
        </div>

        <div class="card-footer" style="font-size: 12px;border-color: {{ $sections->where('id', $fiche->section_id)->first()->color ?? '' }} !important">
            <div style="font-weight: bolder;" class="st">{{ $fiche->categorie->section2 ?? '' }}</div>
            <div>{{$fiche->name}}</div>
        </div>
        <div class="card-footer2" style="padding: 0; background: linear-gradient(164deg, {{ $sections->where('id', $fiche->section_id)->first()->color ?? '' }} 23%, #ecf0f1 74%)" data-id="{{$fiche->id}}">
           
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

        </div>

</li>
