@foreach ($communes as $commune)
    <tr>
        <td data-codecom="{{$commune->code_commune}}" class="commune">{{ substr($commune->code_commune,0,2) }} - {{ $commune->commune }}</td>
    </tr>


@endforeach
