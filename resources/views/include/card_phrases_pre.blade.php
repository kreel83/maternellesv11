

<ul>
        @if (isset($phrases_selection[$section->id]))
        @foreach($phrases_selection[$section->id] as $phrase)

            <li class="badge_phrase_selected" data-phrase="{{$phrase->id}}">{{$phrase->commentaire()->phrase_masculin}}</li>
           
        @endforeach
        @endif
    </ul>

