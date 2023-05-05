<div class="card__share" style="display: flex;justify-content: space-between;align-items: center;width: {{sizeof($notations) * 55 + 110}}; position: relative">
    <div class="card__social" style="width: {{sizeof($notations) * 55 + 55}}px;">
        @foreach ($notations as $notation)
            <div class="share-icon" style="background-color: {{$notation['color']}}" href="#" data-notation="{{$notation->id}}"></div>
        @endforeach
        <div class="share-icon" style="background-color: white;color: red;" data-notation="raz"><i class="fa-solid fa-xmark"></i></div>
    </div>
    <div style="position: absolute; right: 8px; top: 0px;">
        @if ($enfant->resultat($fiche->item_id))
            <div class="share-toggle share-empty" data-notation="null" style="background-color: {{$enfant->resultat($fiche->item_id)->color}}" ></div>
        @else
            <div class="share-toggle share-icon" data-notation="null"><i class="fad fa-ballot-check"></i></div>
        @endif
    </div>

</div>
