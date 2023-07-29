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
                        <div class='sectionCahier selectSectionFiche {{$sec->id == $section->id ? "selected" : null}}'  data-value="{{$sec->id}}" data-section="{{$sec->id}}" data-textes="{{(isset($textes[$sec->id])) ? $textes[$sec->id] : null}}"  data-phrases="@include('include.card_phrases',['section' => $sec])"    style="background-color: {{$sec->color}}">
                            <img src="{{asset('img/illustrations/'.$sec->logo)}}" alt="" width="45px" height="45px">
                        </div>
                        <div class="tiret_selection {{$sec->id == $section->id ? null : "d-none"}}" data-id="{{$sec->id}}" style="background-color: {{$sec->color}}"></div>            
                </div>
    
                @endforeach   
                <div class="d-flex flex-column align-items-center" style="border-left: 1px solid lightgray">
                    <div class='sectionCahier selectSectionFiche' data-section="carnet" data-value="carnet" id="nav-carnet" data-textes="{{isset($textes['carnet']) ? $textes['carnet'] : null}}" style="background-color: red">
                        <img src="{{asset('img/illustrations/carnet.png')}}" alt="" width="120px" height="120px">
                    </div>
                    <div class="tiret_selection d-none" data-id="carnet" style="background-color: red"></div>            
            </div>        
            </div>
    

        </div>

        <div class="col-md-6">

         


            <div class="tab-content" id="nav-tabContent" style="margin-bottom: 20px" >

                @foreach ($sections as $key=>$sec)

                    <div style="margin-bottom: 20px" class="tab-pane fade {{$key == 0 ? 'show active' : null}}" data-id="nav-{{$sec->id}}" id="nav-{{$sec->id}}" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div style="margin: 10px 0; border: 1px solid grey; padding: 4px; height: 100px; overflow-Y: auto" >
                            @include('include.card_phrases',['section' => $sec])
                        </div>
                    </div>


                @endforeach
                <div style="margin-bottom: 20px" class="tab-pane fade" data-id="nav-carnet" id="nav-carnet" role="tabpanel" aria-labelledby="nav-carnet-tab">
                    <div style="margin: 10px 0;padding: 4px; height: 50px; overflow-Y: auto" id="carnetContainer" >
                        <h4>Commentaire général
                            @if ($isChrome)
                            <span class="ms-5" id="record" role="button">
                            <i class="fa-solid fa-microphone-slash"></i>
                            </span>
                            @endif
                        </h4>
                        {{-- <select id="phraseCommentaireGeneral" class="form-control  mb-2" mt-4 data-section="99" data-enfant="{{$enfant->id}}">
                            <option value="null">Veuillez selectionner</option>
            
                            @if (!$commentaires->isEmpty())
                                @foreach ($commentaires as $phrase)
                                        <option value="{{$phrase->texte($enfant)}}">{{$phrase->texte($enfant)}}</option>
                                @endforeach
                                @endif
                        </select> --}}
                        {{-- <textarea id="commentaire_general" data-enfant="92" style="width: 100%" rows="10">{{ $isreussite ? $isreussite->commentaire_general : null}}</textarea>
                        <div class="mt-3" id="instruction"></div>
                        <button data-section="apercu" data-enfant="{{$enfant->id}}"
                            class="btnSelection violet btn-sm" id="saveCommentaireGeneral">Sauvegarder
                        </button> --}}
                    </div>
                </div>


                <div class="position-relative w-100">
                    <button  data-section="{{$section->id}}" data-enfant="{{$enfant->id}}" data-periode="{{$periode}}"  style="position: absolute; right: 4px; top: 6px;" class="btn btn-dark btn-sm saveTexte ">Sauvegarder</button>
                    <div id="editor" data-enfant="{{$enfant->id}}" style="height: 300px; top:0; left:0">
                     {!! $textes[$section->id] ?? '' !!}
                    </div>                    
                </div>



            </div>
          
            <a class="btn btn-outline-primary" href="{{route('editerPDF',['enfant' => $enfant->id])}}" >Editer le cahier de réussite</a>
\
        </div>



        <div class="col-md-6">


            <div class="badge_phrase_container">
                @include('cahiers.liste_phrases')              
            </div>


        </div>
</div>

@endsection
