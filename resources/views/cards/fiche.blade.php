<?php
    $ps = (int) $fiche->lvl[0];
    $ms = (int) $fiche->lvl[1];
    $gs = (int) $fiche->lvl[2];
    $lvl = json_encode([$ps, $ms, $gs]);
?>

<li class="card_fiche {{$key == 0 ? 'fiche_selection' : null}} ui-state-default   {{$fiche->section_id == $section->id ? null : 'd-none'}}"  data-type="{{$type}}" data-level="{{$lvl}}" data-section="{{$fiche->section_id}}" data-fiche="{{$fiche->id}}" data-selection="{{$fiche->fiche_id}}"  data-categorie="{{$fiche->categorie_id}}" data-ps="{{$ps}}" data-ms="{{$ms}}" data-gs="{{$gs}}">
<div class="action d-flex flex-column justify-content-center align-items-center">
    <button class="btnSelection   retirer"  style="background-color: {{ $sections->where('id', $fiche->section_id)->first()->color ?? '' }}">Retirer</button>
    <button class="btnSelection   d-none selectionner"  style="background-color: {{ $sections->where('id', $fiche->section_id)->first()->color ?? '' }}">Selectionner</button>
    </div>

        <div class="card__image">
            <img src="{{asset($fiche->image_name)}}" alt="image" class="border-tlr-radius">
        </div>

        <div class="card-footer" style="font-size: 12px; border-color: {{ $sections->where('id', $fiche->section_id)->first()->color ?? '' }} !important">

            <div style="font-weight: bolder;">{{ $fiche->categorie->section2 ?? '' }}</div>
            
            <div>{{$fiche->name}}</div>
        </div>
        <div class="card-footer2" style="padding: 0; background: linear-gradient(164deg, {{ $sections->where('id', $fiche->section_id)->first()->color ?? '' }} 23%, #ecf0f1 74%)">
           
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
