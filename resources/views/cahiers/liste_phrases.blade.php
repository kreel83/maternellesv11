@if (!isset($type) || $type == 'sections')
    @if (!$phrases->isEmpty())
        <ul>
            @foreach ($phrases[$section->id] as $phrase)
                <li class="badge_phrase" data-value="{{ $phrase->id }}">{{ $phrase->phrase_masculin }}</li>
            @endforeach
        </ul>
    @endif
@else
    {{-- <ul>
        @foreach ($phrases as $phrase)
            <li class="badge_phrase" data-value="{{ $phrase->id }}">{{ $phrase->phrase_masculin }}</li>
        @endforeach
    </ul> --}}
@endif
