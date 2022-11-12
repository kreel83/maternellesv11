
<?php
    $color = "var(--section".$key.")";
?>

    <div class="card shadowDepth1" data-enfant="{{$enfant->id}}" data-item="{{$fiche->item_id}}">

        <div class="card__image border-tlr-radius">
            <div class="card-body" style="padding: 0; height: 100%">

                <img src="{{asset($fiche->item->image)}}" alt="image" class="border-tlr-radius">
                <div class="card__content" style="">
                    @include('items.notation')

                </div>
            </div>

            <div class="card-footer" style="font-size: 12px; background-color: {{$color}}; color: white">

                    <div style="font-size: 14px;font-weight: bolder;">{{$fiche->item->st}}</div>
                    <div style="font-size: 16px">{{$fiche->item->name}}</div>



            </div>
        </div>




    </div>



