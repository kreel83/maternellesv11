@foreach ($items as $item)
    {{ $item->id.', '.$item->name}}
    <br>
@endforeach

<p>Tom erreurs :</p>
@foreach ($tom as $item)
    {{ $item }}
    <br>
@endforeach

<p>Lucie erreurs :</p>
@foreach ($lucie as $item)
    {{ $item }}
    <br>
@endforeach

<p>Doublons erreurs :</p>
@foreach ($doublon as $item)
    {!! $item !!}
    <br>
@endforeach