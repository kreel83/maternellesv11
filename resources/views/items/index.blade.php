@extends('layouts.mainMenu', ['titre' => "les résultats de $enfant->prenom", 'menu' => 'classe'])

@section('content')

<style>
    .noFiche {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color : red;
        padding-top: 50%; 
        
    }
</style>

<div class="row" id="page_items">
    <input type="hidden" id="enfant" value="{{$enfant->id}}">

    <div class="col-md-12 position-relative">
        <div class="noFiche d-none ">
            <div>Aucune fiche trouvé</div>
            <a class="linkNoFiche btn btn-primary mt-3" href="">Ajouter des fiches</a>
        </div>


    <div  data-section="{{ $section->id }}" class="liste_section">
        @foreach($sections as $sec)
            <div class='selectSectionItem {{$sec->id == $section->id ? "selected" : null}}' data-value="{{$sec->id}}" style="background-color: {{$sec->color}}">
            {{$sec->court}}
            </div>
        @endforeach
    </div>
    <div id="mesfiches" class="listItems" >
        <div class="fiche_container fiches mesitems">
        @foreach ($fiches as $fiche)
            @include('cards.item')
        @endforeach
    </div>
</div>


        
    </div>

   
</div>
@endsection
