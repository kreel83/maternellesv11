
@php
    // dd($phrases);
@endphp
@if (!isset($type) || $type == 'reussite')
    @if (!$phrases->isEmpty())
        <ul>
            @foreach ($phrases[$section->id] as $phrase)
                <li class="badge_phrase" data-value="{{ $phrase->id }}">{{ $enfant->genre == 'F'  ? $phrase->phrase_feminin : $phrase->phrase_masculin }}</li>
            @endforeach
        </ul>
    @endif
@else
    <ul>
        @foreach ($phrases as $phrase)
            <li class="badge_phrase" data-value="{{ $phrase->id }}">{{ $enfant->genre == 'F'  ? $phrase->phrase_feminin : $phrase->phrase_masculin }}</li>
        @endforeach
    </ul>
@endif
