@foreach ($communes as $commune)
    <tr>
        <td data-codecom="{{$commune->code_commune}}" class="commune">{{ $commune->adresse_3 }}</td>
    </tr>


@endforeach
