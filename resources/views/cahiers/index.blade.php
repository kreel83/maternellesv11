@extends('layouts.mainMenu', ['titre' => 'Mon cahier de réussite'])

@section('content')
    <h1>cahier de réussite de {{$enfant->prenom}}</h1>

    <h3>
       {{$title}}

    </h3>

    <div id="cahierView" class="row">
        <div class="col-md-3">
            <div class="form-group" style="margin-top: 40px">

                @foreach($sections as $sec)
                    <div data-section="{{$sec->id}}" data-phrases="@include('include.card_phrases',['section' => $sec])" data-texte="{{ isset($textes[$sec->id]) ? $textes[$sec->id] : null  }}"  class='sectionCahier selectSectionFiche {{$sec->id == $section->id ? "selected" : null}}' data-value="{{$sec->id}}" style="background-color: {{$sec->color}}">
                    {{$sec->name}}
                    </div>
                @endforeach

            </div>
        </div>
        <div class="col-md-7">

            <a class="btn btn-outline-primary" href="{{route('editerPDF',['enfant' => $enfant->id])}}" >Editer le cahier de réussite</a>
            @if ($enfant->hasReussite())
            <a class="btn btn-outline-danger" href="{{route('deleteReussite',['enfant' => $enfant->id])}}" >Modifier le cahier de réussite (cette opération éffacera les modification)</a>
            @endif



    @if (!$enfant->hasReussite())
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            {{--<button class="nav-link" id="apercu" data-section="null" data-enfant="{{$enfant->id}}" data-periode="{{$periode}}" data-bs-toggle="tab" data-bs-target="#nav-apercu" type="button" role="tab" aria-controls="nav-home" aria-selected="true">--}}
                {{--Apercu--}}
            {{--</button>--}}
            @foreach ($sections as $key=>$section)
            <button data-section="{{$section->id}}" data-phrases="@include('include.card_phrases')" data-texte="{{ isset($textes[$section->id]) ? $textes[$section->id] : null  }}" class="sectionCahier nav-link {{$key == 0 ? 'active' : null}}" id="nav-tab-{{$section->id}}" data-bs-toggle="tab" data-bs-target="#nav-{{$section->id}}" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
                <img src="{{asset('img/sections/logos/'.$section->logo)}}" width="40px" alt="">
            </button>
            @endforeach


        </div>
    </nav>

    <div class="tab-content" id="nav-tabContent" style="margin-bottom: 20px" >
        {{--<div style="margin-bottom: 20px" class="tab-pane fade {{$key == 0 ? 'show active' : null}}" id="nav-apercu" role="tabpanel" aria-labelledby="nav-home-tab">--}}
            {{--<div class="d-flex w-100 justify-content-between align-items-center">--}}
                {{--<button data-section="apercu" data-enfant="{{$enfant->id}}" data-periode="{{$periode}}"  style="margin-top: 20px" class="btn btn-dark saveTexteReussite">Sauvegarder</button>--}}
                {{--<a target="_blank" href="/enfants/{{$enfant->id}}/cahier/{{$periode}}/seepdf" data-enfant="{{$enfant->id}}" data-periode="{{$periode}}" class="btn btn-primary" id="pdf">Voir le pdf</a>--}}
                {{--<div class="form-check form-switch">--}}


                    {{--<input {{($reussite && $reussite->definitif == 1) ? "checked" : null }} class="form-check-input" type="checkbox" id="definitif" data-enfant="{{$enfant->id}}" data-periode="{{$periode}}">--}}
                    {{--<label class="form-check-label" for="definitif">Définitif</label>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        @foreach ($sections as $key=>$section)

            <div style="margin-bottom: 20px" class="tab-pane fade {{$key == 0 ? 'show active' : null}}" id="nav-{{$section->id}}" role="tabpanel" aria-labelledby="nav-home-tab">
                <h4 style="margin-bottom: 20px">{{$section->name}}</h4>


                <div style="margin: 10px 0; border: 1px solid grey; padding: 4px">@include('include.card_phrases')</div>
                <button data-section="{{$section->id}}" data-enfant="{{$enfant->id}}" data-periode="{{$periode}}"  style="margin: 20px 0" class="btn btn-dark saveTexte">Sauvegarder</button>


                <select class="form-control phrase" data-section="{{$section->id}}" data-enfant="{{$enfant->id}}">
                    <option value="null">Veuillez selectionner</option>



                    @if (!$phrases->isEmpty())
                @foreach ($phrases[$section->id] as $phrase)
                        <option value="{{$phrase->id}}">{{$phrase->texte($enfant)}}</option>
                @endforeach
                        @endif
                </select>

            </div>


        @endforeach
        <div id="editor" data-section="" data-enfant="{{$enfant->id}}" style="height: 400px"></div>


    </div>
    @endif
</div>
</div>

@endsection
