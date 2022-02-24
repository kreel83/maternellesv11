<?php
    $ps = $fiche->lvl[0];
    $ms = $fiche->lvl[1];
    $gs = $fiche->lvl[2];

?>


<li class="card_fiche shadowDepth1 ui-state-default"  data-fiche="{{$fiche->id}}">

        <div class="card-header" style="padding: 0">
            <table class="table table-bordered m0 tableLevel" >
                <tr><td class="p-0" style="color: {{ $ps == "0" ? 'transparent' : 'var(--pink)' }}">PS</td></tr>
                <tr><td class="p-0" style="color: {{ $ms == "0" ? 'transparent' : 'var(--green)' }}">MS</td></tr>
                <tr><td class="p-0" style="color: {{ $gs == "0" ? 'transparent' : 'var(--blue)' }}">GS</td></tr>
            </table>
        </div>
        <div class="card__image">
            <img src="{{asset($fiche->image)}}" alt="image" class="border-tlr-radius">
        </div>

        <div class="card-footer" style="font-size: 12px">
            <div style="font-weight: bolder;">{{$fiche->st}}</div>
            <div>{{$fiche->name}}</div>
        </div>

</li>
