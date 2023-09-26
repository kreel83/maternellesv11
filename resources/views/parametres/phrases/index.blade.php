@extends('layouts.mainMenu', ['titre' => 'Les paramètres', 'menu' => 'commentaire'])

@section('content')
<div class="container" id="phrasesView">
<div class="form-group" style="margin-top: 40px">
    <div data-section="{{ $section }}" class="liste_section">
        <div class="section_container">


            @foreach ($sections as $sec)
                <div class="d-flex flex-column align-items-center">
                    <div class='sectionPhrase selectSectionFiche {{ $sec->id == $section ? 'selected' : null }}'
                        data-value="{{ $sec->id }}" data-section="{{ $sec->id }}" data-titre="{{$sec->name}}"                        
                         style="background-color: {{ $sec->color }}">
                        <img src="{{ asset('img/illustrations/' . $sec->logo) }}" alt="" width="45px"
                            height="45px">
                    </div>
                    <div class="tiret_selection {{ $sec->id == $section ? null : 'd-none' }}"
                        data-id="{{ $sec->id }}" style="background-color: {{ $sec->color }}"></div>
                </div>
            @endforeach
            <div class="d-flex flex-column align-items-center" style="border-left: 1px solid lightgray">
                <div class='sectionPhrase selectSectionFiche' data-section="99" data-value="99" id="nav-carnet"                    
                    style="background-color: red">
                    <img src="{{ asset('img/illustrations/commentaires.png') }}" alt="" width="90px"
                        height="45px">
                </div>
                <div class="tiret_selection {{ $section == 99 ? null : 'd-none' }}" data-id="99" style="background-color: red"></div>
            </div>

        </div>


        <div id="SectionName">
            {{$sections[0]->name}}
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
    <div class="form-group">
            <div class="input-group my-3">
                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
                <input type="text" class="form-control searchPhraseCreation" placeholder="Chercher une phrase" aria-label="Chercher un élève" aria-describedby="basic-addon1">
                <span class="input-group-text raz_search_phrase" style="cursor: pointer"><i class="fa-sharp fa-solid fa-xmark"></i></span>
              </div>
        <div id="tableCommentaireContainer" class="my-4">

            
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

        <div id="bloc_editor" class="d-none justify-content-between align-items-center">
            <div data-reg="L'élève " id="motCle" class="custom_button" style="width: fit-content"><i class="fa-solid fa-plus me-3"></i>L'élève</div>
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

  

@endsection
