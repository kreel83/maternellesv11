
@if (!$resultats->isEmpty())
    @if (isset($resultats[$section->id]))
        @foreach($resultats[$section->id] as $resultat)
            {{$resultat->item()->phrase($enfant)}}
            <br>
        @endforeach
    @endif
@endif
