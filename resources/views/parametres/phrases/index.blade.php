@extends('layouts.mainMenu2', ['titre' => 'Les paramètres', 'menu' => 'commentaire'])

@section('content')
<div id="phrasesView" class="mt-5">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('depart')}}">Tableau de bord</a></li>        
        <li class="breadcrumb-item active" aria-current="page">Création des phrases pré-enregistrées</li>
      </ol>
    </nav>
    @php
        $section_actuelle = App\Models\Section::find($section);
    @endphp
<div class="form-group" style="margin-top: 40px">
    <div data-section="{{ $section }}" class="liste_section">

        <style>
            
        </style>
        <div class="section_container align-items-end">


            @foreach ($sections as $sec)
            @if ($sec->id == 9 && Auth::user()->configuration->desactive_devenir_eleve == 1)
            @else
            <div class="d-flex flex-column align-items-center">
                    <div class="tiret_selection {{ $sec->id == $section ? null : 'd-none' }}"
                        data-id="{{ $sec->id }}" style="background-color: {{ $sec->color }}"></div>
                    <div class='sectionPhrase selectSectionFiche {{ $sec->id == $section ? 'selected' : null }}'
                        data-value="{{ $sec->id }}" data-section="{{ $sec->id }}" data-titre="{{$sec->name}}"                        
                         style="background-color: {{ $sec->color }}">
                        <img src="{{ asset('img/illustrations/' . $sec->logo) }}" alt="" width="45px"
                            height="45px">
                    </div>

                    <div class="petit_texte" style="color: {{$sec->color}}">{{$sec->icone}}</div>
                    
                </div>
                @endif
            @endforeach
            <div class="d-flex flex-column align-items-center" style="border-left: 1px solid lightgray">
                <div class="tiret_selection {{ $section == 99 ? null : 'd-none' }}" data-id="99" style="background-color: red"></div>
                <div class='sectionPhrase selectSectionFiche' data-section="99" data-value="99" id="nav-carnet"                    
                    style="background-color: red">
                    <img src="{{ asset('img/illustrations/99.png') }}" alt="" width="45px"
                        height="45px">
                </div>
                <div class="petit_texte" style="color: red">Général</div>
            </div>

        </div>






    </div>



        {{-- <label for="">Choisir une section</label>
        <select name="" id="selectPhrase" class="form-control" >
            @foreach($sections as $sec)
                <option value="{{$sec->id}}" {{$sec->id == $section ? "selected" : null}}>{{$sec->name}}</option>
                @endforeach
                <option value="99" {{$section == 99 ? "selected" : null}}>Commentaire général</option>
        </select> --}}
    </div>
    <div id="phrase_container" class="p-5" style="border: 10px solid {{ $section_actuelle->color ?? 'red' }}; border-radius: 40px;">

    
    <div class="form-group">
            <div class="input-group my-3">
                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
                <input type="text" class="form-control searchPhraseCreation" placeholder="Chercher une phrase" aria-label="Chercher un élève" aria-describedby="basic-addon1">
                <span class="input-group-text raz_search_phrase" style="cursor: pointer"><i class="fa-sharp fa-solid fa-xmark"></i></span>
              </div>
              <div id="tableauDesPhrases" class="my-4">

            
            @include('parametres.phrases.__tableau_des_phrases')

        </div>

    </div>

        <div class="d-flex justify-content-between my-4" id="controle_editor">
            <button class="custom_button w-25" id="nouvellePhrase" >Nouvelle phrase</button>
            <div id="controleNouvellePhrase" class="d-none">
                <button class="custom_button" id="saveNouvellePhrase" data-section="{{$section}}">Sauvegarder</button>
                <button class="custom_button_secondary ms-4" id="cancelNouvellePhrase">Annuler</button>
            </div>
        </div>

        
        <div id="bloc_editor" class="d-none justify-content-between  flex-column">
            <small>Vous devez écrire un phrase au masculin exclusivement en utilisant le prénom par défaut "Tom"</small>
            {{-- <div data-reg="L'élève " id="motCle" class="custom_button" style="width: fit-content"><i class="fa-solid fa-plus me-3"></i>L'élève</div> --}}
            <div id="editor2" data-section="" style="height: 100px; width: 70%"  ></div>        

        </div>
        <style>
            .feminin, .masculin {
                padding: 4px 8px;
                border: 1px solid grey;
                line-height: 30px;
                font-size: 18px;
                width: 80%;;
                height: auto;
                

            }

        </style>

        <div id="bloc_2phrases" class="d-none flex-column">
            <div class="d-flex align-items-center">
                <div style="width: 20%">Masculin</div>
                <div class="masculin"></div>
            </div>
            <div class="d-flex mt-3 align-items-center">
                <div style="width: 20%">Féminin</div>
                <div class="feminin"></div>
            </div>
        </div>



</div>
</div>

  

@endsection
