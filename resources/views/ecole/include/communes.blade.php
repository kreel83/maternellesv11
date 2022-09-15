@foreach ($communes as $commune)
    <tr>
        <td data-codecom="{{$commune->code}}" class="commune">{{ $commune->codeDepartement }} - {{ $commune->nom }}</td>
    </tr>


@endforeach
