@extends('layouts.mainMenu', ['title' => 'Mon cahier de réussite','menu' => 'classe'])

@section('content')


    @php
    $degrades = App\Models\Enfant::DEGRADE;
@endphp

    <div id="cahierView" class="row px-5" data-enfant="{{$enfant->id}}">
        <div  data-section="{{ $section->id }}" class="liste_section mb-5">
            <div class="section_container">
                @if ($enfant->background)
                <div class="m-2 degrade_card_enfant animaux little"  style="background-image: {{$degrades[$enfant->background]}}">
                    <img src="{{asset('/img/animaux/'.$enfant->photo)}}" alt="" width="60">
                
                </div>
                @else
                  <img src="{{asset($enfant->photoEleve)}}" alt="rover"  width="60" />
                @endif
                <div class="ms-1 me-5 pt-2" style="font-size: 14px">
                    <div>{{$enfant->prenom}} {{substr($enfant->nom,0,1)}}</div>
                    <div>Cahier de réussite</div>
                    <div> {{$title}}</div>
                </div> 
                @foreach($sections as $sec)
                <div class="d-flex flex-column align-items-center">
                        <div class='sectionCahier selectSectionFiche {{$sec->id == $section->id ? "selected" : null}}' data-value="{{$sec->id}}" data-section="{{$sec->id}}" data-textes="{{(isset($textes[$sec->id])) ? $textes[$sec->id] : null}}"  data-phrases="@include('include.card_phrases',['section' => $sec])"   c data-value="{{$sec->id}}"  style="background-color: {{$sec->color}}">
                            <img src="{{asset('img/illustrations/'.$sec->logo)}}" alt="" width="45px" height="45px">
                        </div>
                        <div class="tiret_selection {{$sec->id == $section->id ? null : "d-none"}}" data-id="{{$sec->id}}" style="background-color: {{$sec->color}}"></div>            
                </div>
    
                @endforeach           
            </div>
    
        </div>
        {{-- <div class="col-md-3">
            <div class="form-group">

                @foreach($sections as $sec)
                    <div data-section="{{$sec->id}}" data-textes="{{(isset($textes[$sec->id])) ? $textes[$sec->id] : null}}"  data-phrases="@include('include.card_phrases',['section' => $sec])"   class='sectionCahier selectSectionFiche {{$sec->id == $section->id ? "selected" : null}}' data-value="{{$sec->id}}" style="background-color: {{$sec->color}}">
                    {{$sec->name}}
                    </div>
                @endforeach

            </div>
        </div> --}}
        <div class="col-md-6">

            @if (!$enfant->hasReussite())


            <div class="tab-content" id="nav-tabContent" style="margin-bottom: 20px" >

                @foreach ($sections as $key=>$sec)

                    <div style="margin-bottom: 20px" class="tab-pane fade {{$key == 0 ? 'show active' : null}}" id="nav-{{$sec->id}}" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div style="margin: 10px 0; border: 1px solid grey; padding: 4px; height: 100px; overflow-Y: auto" id="phraseContainer" >
                            @include('include.card_phrases',['section' => $sec])
                        </div>
                    </div>


                @endforeach

                <!-- <select class="form-control phrase" data-section="{{$section->id}}" data-enfant="{{$enfant->id}}">
                <option value="null">Veuillez selectionner</option>



                @if (!$phrases->isEmpty())
                    @foreach ($phrases[$section->id] as $phrase)
                            <option value="{{$phrase->id}}">{{$phrase->texte($enfant)}}</option>
                    @endforeach
                @endif
            </select> -->

                <div class="position-relative w-100">
                    <button  data-section="{{$section->id}}" data-enfant="{{$enfant->id}}" data-periode="{{$periode}}"  style="position: absolute; right: 4px; top: 6px;" class="btn btn-dark btn-sm saveTexte ">Sauvegarder</button>
                    <div id="editor" data-enfant="{{$enfant->id}}" style="height: 300px; top:0; left:0">
                     {!! $textes[$section->id] ?? '' !!}
                    </div>                    
                </div>



            </div>
            @endif
            <a class="btn btn-outline-primary" href="{{route('editerPDF',['enfant' => $enfant->id])}}" >Editer le cahier de réussite</a>
            @if ($enfant->hasReussite())
            <a class="btn btn-outline-danger" href="{{route('deleteReussite',['enfant' => $enfant->id])}}" >Modifier le cahier de réussite (cette opération éffacera les modification)</a>
            @endif
        </div>



        <div class="col-md-6">


            <div class="badge_phrase_container">
                @include('cahiers.liste_phrases')              
            </div>


        </div>
</div>

@endsection
