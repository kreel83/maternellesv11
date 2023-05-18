@extends('layouts.mainMenu', ['titre' => "les résultats de $enfant->prenom"])

@section('content')


<div class="accordion row p-2" id="page_items">
    <input type="hidden" id="enfant" value="{{$enfant->id}}">
    <div class="col-md-3">
    <div class="form-group" style="margin-top: 40px">

@foreach($sections as $sec)
    <div class='selectSectionItem {{$sec->id == $section->id ? "selected" : null}}' data-value="{{$sec->id}}" style="background-color: {{$sec->color}}">
    {{$sec->name}}
    </div>
@endforeach

</div>
    </div>
    <div class="col-md-7">


    <div  data-section="{{ $section->id }}">
        <div id="mesfiches" class="listItems" >
            <div class="fiche_container fiches mesitems">
            @foreach ($fiches as $fiche)
                @include('cards.item')
            @endforeach
            </div>
        </div>


        

        </div>
    </div>
    <div class="col-md-2"></div>

   
</div>
@endsection
