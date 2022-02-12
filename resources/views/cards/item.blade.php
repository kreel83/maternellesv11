

    <div class="card shadowDepth1" data-enfant="{{$enfant->id}}" data-item="{{$item->id}}">
        <div class="card__image border-tlr-radius">
            <div class="card-body" style="padding: 0; height: 100%">
                <img src="{{asset($item->image)}}" alt="image" class="border-tlr-radius">
                <div class="card__content">
                    <div class="card__share">
                        <div class="card__social" style="width: {{sizeof($notations) * 55}}px;">
                            @foreach ($notations as $notation)
                            <a class="share-icon" style="background-color: {{$notation['color']}}" href="#" data-notation="{{$notation->id}}"></a>
                            @endforeach
                        </div>


                        @if ($enfant->resultat($item->id))
                            <a class="share-toggle share-empty" data-notation="null" style="background-color: {{$enfant->resultat($item->id)->color}}" href="#"></a>
                        @else
                            <a class="share-toggle share-icon" data-notation="null"  href="#"><i class="fad fa-ballot-check"></i></a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card-footer" style="font-size: 12px">

                    <div style="font-size: 14px;font-weight: bolder;">{{$item->st}}</div>
                    <div style="font-size: 16px">{{$item->name}}</div>



            </div>
        </div>




    </div>



