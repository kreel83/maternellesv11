                @if (!$phrases->isEmpty())
                    @foreach ($phrases[$section->id] as $phrase)
                            <div class="badge_phrase" style="background-color: {{$section->color}}" data-value="{{$phrase->id}}">{{$phrase->texte($enfant)}}</div>
                    @endforeach
                @endif   