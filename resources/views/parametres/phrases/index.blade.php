@extends('layouts.mainMenu', ['titre' => 'Les paramètres', 'menu' => 'commentaire'])

@section('content')
<div class="container" id="phrasesView">
<div class="form-group" style="margin-top: 40px">
    <div data-section="{{ $section }}" class="liste_section mb-5">
        <div class="section_container">


            @foreach ($sections as $sec)
                <div class="d-flex flex-column align-items-center">
                    <div class='sectionPhrase selectSectionFiche {{ $sec->id == $section ? 'selected' : null }}'
                        data-value="{{ $sec->id }}" data-section="{{ $sec->id }}"                        
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


    </div>



        {{-- <label for="">Choisir une section</label>
        <select name="" id="selectPhrase" class="form-control" >
            @foreach($sections as $sec)
                <option value="{{$sec->id}}" {{$sec->id == $section ? "selected" : null}}>{{$sec->name}}</option>
                @endforeach
                <option value="99" {{$section == 99 ? "selected" : null}}>Commentaire général</option>
        </select> --}}
    </div>
    <div class="form-group" style="margin: 20px 0">
        <label for="">Liste des phrases de cette discipline</label>
        <div id="tableCommentaireContainer">
            
            @include('parametres.phrases.__tableau_des_phrases')

        </div>

    </div>

        <div class="d-flex justify-content-between my-4">
            <button class="btn btn-dark" id="nouvellePhrase" >Nouvelle phrase</button>
            <div id="controleNouvellePhrase" class="d-none">
                <button class="btn btn-danger" id="cancelNouvellePhrase">Annuler</button>
                <button class="btn btn-primary" id="saveNouvellePhrase" data-section="{{$section}}">Sauvegarder</button>
            </div>
        </div>

        <div id="editor2" data-section="" style="height: 100px"></div>
        <div style="margin-top: 20px">
            <table class="table table-bordered table-hover" id="motCle" style="cursor: pointer;">
                <tr style="text-align: center">
                    <td data-reg="@name@">prénom</td>
                    <td data-reg="@ilelle@">pronom personnel</td>
                    <td data-reg="*e*">feminin / masculin</td>
                </tr>

            </table>
        </div>

</div>

  

@endsection
