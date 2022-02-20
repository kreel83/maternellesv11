@extends('layouts.mainMenu')

@section('content')


        <select name="" id="selectPhrase" class="form-control" style="margin: 20px 0 ">
            @foreach($sections as $sec)
                <option value="{{$sec->id}}">{{$sec->name}}</option>
            @endforeach
        </select>
        <div id="tableCommentaireContainer">
            <table class="table table-bordered" id="tableauDesPhrases">
                @include('parametres.phrases.__tableau_des_phrases')
            </table>
        </div>
        <div class="d-flex justify-content-between my-4">
            <button class="btn btn-dark" id="nouvellePhrase">Nouvelle phrase</button>
            <div id="controleNouvellePhrase" class="hide">
                <button class="btn btn-danger" id="cancelNouvellePhrase">Annuler</button>
                <button class="btn btn-primary" id="saveNouvellePhrase">Sauvegarder</button>
            </div>
        </div>

        <div id="editor" data-section="" style="height: 100px; margin: 20px 0"></div>
        <div>
            <table class="table table-bordered table-hover">
                <tr><td data-reg="@name@">prénom</td></tr>
                <tr><td data-reg="@ilelle@">pronom personnel</td></tr>
                <tr><td data-reg="*e*">feminin / masculin</td></tr>
            </table>
        </div>


@endsection
