@extends('layouts.mainMenu', ['titre' => "les résultats de $enfant->prenom", 'menu' => 'classe'])

@section('content')


<div class="row" id="page_items">
    <input type="hidden" id="enfant" value="{{$enfant->id}}">

    <div class="col-md-12">


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
