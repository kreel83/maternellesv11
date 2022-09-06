<?php
    $ps = (int) $fiche->item->lvl[0];
    $ms = (int) $fiche->item->lvl[1];
    $gs = (int) $fiche->item->lvl[2];
    $lvl = json_encode([$ps, $ms, $gs]);

    $color = \App\Models\Section::getColor($fiche->section_id);


?>


<li class="card_fiche shadowDepth1 ui-state-default" style="background-color: {{$color}}; color: white" data-type="{{$type}}" data-level="{{$lvl}}" data-fiche="{{$fiche->id}}" data-ps="{{$ps}}" data-ms="{{$ms}}" data-gs="{{$gs}}">


    <div class="perso_card">
        @if ($fiche->parent_type == 'personnels')
        <span class="modifyFiche" data-provenance="fiche" data-id="{{$fiche->item->id}}" data-section="{{$section->id}}"><i class="fas fa-address-card"></i></span>
        @endif
            {{--<span class="duplicate_card" data-provenance="fiche" data-id="{{$fiche->item->id}}" data-section="{{$section->id}}"><i class="fas fa-clone"></i></span>--}}

    </div>




        <div class="card-header" style="padding: 0">
            <table class="table table-bordered m0 tableLevel" >
                <tr><td class="p-0" style="color: {{ $ps == "0" ? 'transparent' : 'var(--pink)' }}">PS</td></tr>
                <tr><td class="p-0" style="color: {{ $ms == "0" ? 'transparent' : 'var(--green)' }}">MS</td></tr>
                <tr><td class="p-0" style="color: {{ $gs == "0" ? 'transparent' : 'var(--blue)' }}">GS</td></tr>
            </table>
        </div>
        <div class="card__image">
            <img src="{{asset($fiche->item->image)}}" alt="image" class="border-tlr-radius">
        </div>

        <div class="card-footer" style="font-size: 12px">
            <div style="font-weight: bolder;">{{$fiche->item->st}}</div>
            <div>{{$fiche->item->name}}</div>
        </div>

</li>
