@extends('layouts.mainMenu')

@section('content')
    <h1>cahier de réussite de {{$enfant->prenom}}</h1>

    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link" id="apercu" data-section="null" data-enfant="{{$enfant->id}}" data-periode="{{$periode}}" data-bs-toggle="tab" data-bs-target="#nav-apercu" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
                Apercu
            </button>
            @foreach ($sections as $key=>$section)
            <button data-section="{{$section->id}}" data-phrases="@include('include.card_phrases')" data-texte="{{ isset($textes[$section->id]) ? $textes[$section->id] : null  }}" class="sectionCahier nav-link {{$key == 0 ? 'active' : null}}" id="nav-tab-{{$section->id}}" data-bs-toggle="tab" data-bs-target="#nav-{{$section->id}}" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
                <img src="{{asset('img/sections/logos/'.$section->logo)}}" width="40px" alt="">
            </button>
            @endforeach


        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent" style="margin-bottom: 20px" >
        <div style="margin-bottom: 20px" class="tab-pane fade {{$key == 0 ? 'show active' : null}}" id="nav-apercu" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="d-flex w-100 justify-content-between align-items-center">
                <button data-section="{{$section->id}}" data-enfant="{{$enfant->id}}" data-periode="{{$periode}}"  style="margin-top: 20px" class="btn btn-dark saveTexte">Sauvegarder</button>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="definitif" data-enfant="{{$enfant->id}}" data-periode="{{$periode}}">
                    <label class="form-check-label" for="definitif">Définitif</label>
                </div>
            </div>
        </div>
        @foreach ($sections as $key=>$section)

            <div style="margin-bottom: 20px" class="tab-pane fade {{$key == 0 ? 'show active' : null}}" id="nav-{{$section->id}}" role="tabpanel" aria-labelledby="nav-home-tab">
                <h4 style="margin-bottom: 20px">{{$section->name}}</h4>

                <textarea style="margin: 10px 0" name="" id="" class="form-control" rows="10">@include('include.card_phrases')</textarea>
                <button data-section="{{$section->id}}" data-enfant="{{$enfant->id}}" data-periode="{{$periode}}"  style="margin: 20px 0" class="btn btn-dark saveTexte">Sauvegarder</button>


                <select class="form-control phrase" data-section="{{$section->id}}" data-enfant="{{$enfant->id}}">
                    <option value="null">Veuillez selectionner</option>

                @foreach ($phrases[$section->id] as $phrase)
                        <option value="{{$phrase->id}}">{{$phrase->texte($enfant)}}</option>
                @endforeach
                </select>

            </div>


        @endforeach
        <div id="editor" data-section="" data-enfant="{{$enfant->id}}" style="height: 400px"></div>


    </div>

@endsection
