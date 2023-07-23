<div class="card_item shadowDepth1 ui-state-default position-relative  {{$fiche->section_id == $section->id ? null : 'd-none'}}"  data-section="{{$fiche->section_id}}" data-item="{{$fiche->id}}">

<div class="action">
    <button class="my-1 btn notation" style="background-color: {{$fiche->section()->color}}" data-notation="3">Acquis</button>
    <button class="my-1 btn notation" style="background-color: {{$fiche->section()->color}}"  data-notation="2">Acquis avec aide</button>
    <button class="my-1 btn notation" style="background-color: {{$fiche->section()->color}}"  data-notation="1">En voie d'acquisition</button>
    <button class="my-1 btn notation" style="background-color: {{$fiche->section()->color}}"  data-notation="0">Annuler</button>
    </div>
        <div class="card__image">
            <img src="{{asset($fiche->image_name)}}" alt="image" class="border-tlr-radius">
        </div>

        <div class="card-footer" style="font-size: 12px; border-color: {{$fiche->section()->color}} !important">
            <div style="font-weight: bolder;">{{$fiche->st}}</div>
            <div>{{$fiche->name}}</div>
        </div>
        <div class="card-footer2" style="padding: 0; background-color: {{$fiche->section()->color}}">
           
                    <div class="d-flex justify-content-between px-3 w-100">
                        <div class="lanote">{{$fiche->textnote}}</div>

                        <div class="{{$fiche->notation == 2 ? null : 'd-none'}} autonome autonome_{{$fiche->autonome}}"><i class="fa-solid fa-circle"></i></div>

                        
                    </div>               
        </div>


</div>