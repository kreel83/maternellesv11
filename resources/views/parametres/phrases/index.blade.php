@extends('layouts.mainMenu', ['titre' => 'Les paramètres', 'menu' => 'commentaire'])

@section('content')
<div class="container">
<div class="form-group" style="margin-top: 40px">
        <label for="">Choisir une section</label>
        <select name="" id="selectPhrase" class="form-control" >
            @foreach($sections as $sec)
                <option value="{{$sec->id}}" {{$sec->id == $section->id ? "selected" : null}}>{{$sec->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group" style="margin: 20px 0">
        <label for="">Liste des phrases de ce chapitre</label>
        <div id="tableCommentaireContainer">
            @include('parametres.phrases.__tableau_des_phrases')
        </div>

    </div>

        <div class="d-flex justify-content-between my-4">
            <button class="btn btn-dark" id="nouvellePhrase" >Nouvelle phrase</button>
            <div id="controleNouvellePhrase" class="hide">
                <button class="btn btn-danger" id="cancelNouvellePhrase">Annuler</button>
                <button class="btn btn-primary" id="saveNouvellePhrase" data-section="{{$section->id}}">Sauvegarder</button>
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
