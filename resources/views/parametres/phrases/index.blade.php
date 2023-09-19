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

        <div id="tableCommentaireContainer" class="my-4">
            
            @include('parametres.phrases.__tableau_des_phrases')

        </div>

    </div>

        <div class="d-flex justify-content-between my-4">
            <button class="custom_button w-25" id="nouvellePhrase" >Nouvelle phrase</button>
            <div id="controleNouvellePhrase" class="d-none">
                <button class="custom_button" id="saveNouvellePhrase" data-section="{{$section}}">Sauvegarder</button>
                <button class="custom_button_secondary ms-4" id="cancelNouvellePhrase">Annuler</button>
            </div>
        </div>

        <div id="editor2" data-section="" style="height: 100px"></div>

        {{-- <div class="row" >
        <div class="col-md-6">
            <label for="">Phrase pour les garcons</label>
            <textarea class="form-control masculin_area" style="font-size: 16px" rows="10"></textarea>
        </div>
        <div class="col-md-6">
            <label for="">Phrase pour les filles</label>
            <textarea class="form-control feminin_area" style="width: 100%" rows="10"></textarea>

        </div>
        </div> --}}
        
        <div style="margin-top: 20px">
            <table class="table table-bordered table-hover" id="motCle" style="cursor: pointer;">
                <tr style="text-align: center">
                    <td data-reg="L'élève ">prénom</td>

                </tr>

            </table>
        </div>

</div>

  

@endsection
