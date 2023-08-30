<div class="card_item shadowDepth1 ui-state-default position-relative  {{$fiche->section_id == $section->id ? null : 'd-none'}}"  data-section="{{$fiche->section_id}}" data-item="{{$fiche->id}}">
<style>
    .action {
        width: 240px !important;
        height: 300px !important;

    }
    .notation {
        width: 45%  !important;
        height: 35% !important;
        margin: 4px !important;
    }
</style>

<div class="action d-flex flex-wrap">
    <button class="my-1 btn notation niveau_3"  data-notation="3">Acquis</button>
    <button class="my-1 btn notation niveau_2"   data-notation="2">Acquis avec aide</button>
    <button class="my-1 btn notation niveau_1"   data-notation="1">En voie d'acquisition</button>
    <button class="my-1 btn notation niveau_0"   data-notation="0">Annuler</button>
</div>
        <div class="card__image">
            <img src="{{asset($fiche->image_name)}}" alt="image" class="border-tlr-radius">
        </div>

        @php
            if ($fiche->notation == 2 && $fiche->autonome == 1) $fiche->notation = 3;
        @endphp

        <div class="card-footer" style="font-size: 12px">
            <div style="font-weight: bolder;">{{$fiche->st}}</div>
            <div>{{$fiche->name}}</div>
        </div>
        <div class="card-footer2 niveau_{{$fiche->notation}}" style="padding: 0; border-top: 10px solid {{$fiche->section()->color}}">
           
                    <div class="d-flex justify-content-between px-3 w-100">
                        <div class="lanote">{{$fiche->textnote}}</div>

                        <div class="{{in_array($fiche->notation,[2,3]) ? null : 'd-none'}} autonome autonome_{{$fiche->autonome}}"><i class="fa-solid fa-circle"></i></div>

                        
                    </div>               
        </div>


</div>