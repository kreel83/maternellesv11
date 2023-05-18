<?php
    $ps = (int) $fiche->lvl[0];
    $ms = (int) $fiche->lvl[1];
    $gs = (int) $fiche->lvl[2];
    $lvl = json_encode([$ps, $ms, $gs]);




?>


<li class="card_fiche shadowDepth1 ui-state-default position-relative  {{$fiche->section_id == $section->id ? null : 'd-none'}}"  data-type="{{$type}}" data-level="{{$lvl}}" data-section="{{$fiche->section_id}}" data-fiche="{{$fiche->id}}" data-ps="{{$ps}}" data-ms="{{$ms}}" data-gs="{{$gs}}">
<div class="action">
    <button class="btn btn-sm btn-primary retirer">Retirer</button>
    <button class="btn btn-sm btn-primary d-none selectionner">Selectionner</button>
    </div>

        <div class="card__image">
            <img src="{{asset($fiche->image_name)}}" alt="image" class="border-tlr-radius">
        </div>

        <div class="card-footer" style="font-size: 12px; border-color: {{$fiche->section()->color}} !important">
            <div style="font-weight: bolder;">{{$fiche->st}}</div>
            <div>{{$fiche->name}}</div>
        </div>
        <div class="card-footer2" style="padding: 0; background-color: {{$fiche->section()->color}}">
           
                
                    <div class="p-0 caseLvl" style="background-color: {{ $ps == "0" ? 'transparent' : 'var(--pink)' }}">PS</div>
                    <div class="p-0 caseLvl" style="background-color: {{ $ms == "0" ? 'transparent' : 'var(--green)' }}">MS</div>
                    <div class="p-0 caseLvl" style="background-color: {{ $gs == "0" ? 'transparent' : 'var(--rouge)' }}">GS</div>
                
        </div>


</li>
