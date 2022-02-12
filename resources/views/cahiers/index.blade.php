@extends('layouts.mainMenu')

@section('content')
    <h1>cahier de réussite de {{$enfant->prenom}}</h1>

    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="apercu" data-section="null" data-enfant="{{$enfant->id}}" data-periode="{{$periode}}" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
                Apercu
            </button>
            @foreach ($sections as $key=>$section)
            <button data-section="{{$section->id}}" data-texte="{{ isset($textes[$section->id]) ? $textes[$section->id] : null  }}" class="sectionCahier nav-link " id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-{{$section->id}}" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
                <img src="{{asset('img/sections/logos/'.$section->logo)}}" width="40px" alt="">
            </button>
            @endforeach


        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent" style="margin-bottom: 20px" >
        @foreach ($sections as $key=>$section)

            <div style="margin-bottom: 20px" class="tab-pane fade {{$key == 0 ? 'show active' : null}}" id="nav-{{$section->id}}" role="tabpanel" aria-labelledby="nav-home-tab">
                <h4 style="margin-bottom: 20px">{{$section->name}}</h4>
                <select class="form-control phrase" data-section="{{$section->id}}" data-enfant="{{$enfant->id}}">
                    <option value="null">Veuillez selectionner</option>
                @foreach ($phrases[$section->id] as $phrase)
                        <option value="{{$phrase->id}}">{{$phrase->texte}}</option>
                @endforeach
                </select>
                <div class="d-flex w-100 justify-content-between align-items-center">
                    <button data-section="{{$section->id}}" data-enfant="{{$enfant->id}}" data-periode="{{$periode}}"  style="margin-top: 20px" class="btn btn-dark saveTexte">Sauvegarder</button>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Définitif</label>
                    </div>
                </div>

            </div>

        @endforeach
        <div id="editor" data-section="" data-enfant="{{$enfant->id}}" style="height: 600px"></div>


    </div>

@endsection
