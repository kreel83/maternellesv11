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

<li class="card_fiche {{$key==0 ? 'fiche_exemple' : null}} shadowDepth1 ui-state-default position-relative {{$fiche->section_id == $section->id ? null : 'd-none'}}"  data-table="{{$fiche->getTable()}}" data-section="{{$fiche->section_id}}" data-type="{{$type}}" data-level="{{$lvl}}" data-fiche="{{$fiche->id}}" data-ps="{{$ps}}" data-ms="{{$ms}}" data-gs="{{$gs}}" data-classe="{{json_encode($classifications[$fiche->section_id] ?? [])}}">
<div class="actiontemp">
    @foreach ($classification as $classe)
    <div class="coder {{ $fiche->classification_id == $classe['id'] ? 'active' : null}}" title="{{$classe['section1']}}" data-fiche={{$fiche->id}} data-id={{$classe['id']}}>{{$classe['code']}}</div>
    @endforeach
</div>
{{-- <div class="action">
    <button class="btnSelection   d-none retirer my-1" style="background-color: {{$fiche->section()->color}}" >Retirer</button>
    <button class="btnSelection   selectionner my-1" style="background-color: {{$fiche->section()->color}}" >Selectionner</button>
    <button data-id="{{$fiche->id ?? null}}" style="background-color: {{$fiche->section()->color}}"  class="btnSelection  dupliquer my-1">Dupliquer</button>
    <button data-id="{{$fiche->id ?? null}}" style="background-color: {{$fiche->section()->color}}" class="btnSelection {{$fiche->user_id ? null : 'd-none'}} modifier my-1">Modifier</button>
</div> --}}
    <div class="perso_card">
            @if ($fiche->user_id)
            <span class="duplicate_card" data-id="{{$fiche->id}}" data-section="{{$section->id}}"><i class="fas fa-clone" style="color: var(--main-color)"></i></span>
            @endif


    </div>

        <div class="card__image">
            <img src="{{asset($fiche->image_name)}}" alt="image" class="border-tlr-radius">
        </div>

        <div class="card-footer" style="font-size: 12px;border-color: {{$fiche->section()->color}} !important">
            <div style="font-weight: bolder;">{{$fiche->st}}</div>
            <div>{{$fiche->name}}</div>
        </div>
        <div class="card-footer2" style="padding: 0; background-color: {{$fiche->section()->color}}">
           
                
                    <div class="p-0 caseLvl" style="background-color: {{ $ps == "0" ? 'transparent' : 'var(--pink)' }}">PS</div>
                    <div class="p-0 caseLvl" style="background-color: {{ $ms == "0" ? 'transparent' : 'var(--green)' }}">MS</div>
                    <div class="p-0 caseLvl" style="background-color: {{ $gs == "0" ? 'transparent' : 'var(--rouge)' }}">GS</div>
                    <button data-id="{{$fiche->id ?? null}}" style="background-color: {{$fiche->section()->color}}" class="btnSelection }} modifier my-1">Modifier</button>
                    <div>{{$fiche->id}}</div>
        </div>

</li>
