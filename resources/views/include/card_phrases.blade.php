
@if (!$resultats->isEmpty())
    @if (isset($resultats[$section->id]))
    <ul>
        @foreach($resultats[$section->id] as $resultat)
            <li>{{$resultat->item($enfant)}}</li>
           
        @endforeach
    </ul>
    @endif
@endif
