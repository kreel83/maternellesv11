


<?php
$ps = (int) $item->lvl[0];
$ms = (int) $item->lvl[1];
$gs = (int) $item->lvl[2];
$lvl = json_encode([$ps, $ms, $gs]);

?>


<li class="card_fiche duplicateFiche shadowDepth1 ui-state-default" data-table="{{$item->getTable()}}" data-type="{{$type}}" data-level="{{$lvl}}" data-item="{{$item->id}}" data-ps="{{$ps}}" data-ms="{{$ms}}" data-gs="{{$gs}}">
    <div class="duplicate_card" data-id="{{$item->id}}" data-section="{{$section->id}}">

        <span><i class="fas fa-clone"></i></span>
    </div>
    <div class="card-header" style="padding: 0">
        <table class="table table-bordered m0 tableLevel" >
            <tr><td class="p-0" style="color: {{ $ps == "0" ? 'transparent' : 'var(--pink)' }}">PS</td></tr>
            <tr><td class="p-0" style="color: {{ $ms == "0" ? 'transparent' : 'var(--green)' }}">MS</td></tr>
            <tr><td class="p-0" style="color: {{ $gs == "0" ? 'transparent' : 'var(--blue)' }}">GS</td></tr>
        </table>
    </div>
    <div class="card__image">
        <img src="{{asset($item->image)}}" alt="image" class="border-tlr-radius">
    </div>

    <div class="card-footer" style="font-size: 12px">
        <div style="font-weight: bolder;">{{$item->st}}</div>
        <div>{{$item->name}}</div>
    </div>

</li>
