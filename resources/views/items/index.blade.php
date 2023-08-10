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

<div class="row position-relative" id="page_items">

    <input type="hidden" id="enfant" value="{{$enfant->id}}">



    <style>
        .arrowLeft a{
            font-size: 35px;
            color: #7769FE;
        }
    </style>

@php
    $degrades = App\Models\Enfant::DEGRADE;
@endphp

    <div class="col-md-12 position-relative">
        <div class="noFiche d-none ">
            <div>Aucune fiche trouvé</div>
            <a class="linkNoFiche btn btn-primary mt-3" href="">Ajouter des fiches</a>
        </div>


   {{-- <div  data-section="{{ $section->id }}" class="liste_section">
         @foreach($sections as $sec)
            <div class='selectSectionItem {{$sec->id == $section->id ? "selected" : null}}' data-value="{{$sec->id}}" style="background-color: {{$sec->color}}">
            {{$sec->court}}
            </div>
        @endforeach 
    </div>--}}

    <div class="d-flex justify-content-between container align-items-center mb-5">
            <div class="arrowLeft">
                <a href="{{route('enfants')}}">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
            </div>

            {{-- <div class="d-flex align-items-center" style="width: 250px; height: 60px; border-radius: 40px; border: 1px solid grey; " >
                <div style="border-radius: 50%; overflow: hidden; width: 60px; height: 60px ">            
                    <img src="https://lesmaternelles.kreel.fr//storage/MOLMAG47/photos/639f4f4c28802.jpg" alt="rover" width="60">           
                </div>
                <div class="ms-3">
                    <div>{{$enfant->prenom}}</div>
                    <div>{{$enfant->nom}}</div>
                </div>      
            </div> --}}
            <div  data-section="{{ $section->id }}" class="liste_section">
                <div class="section_container">
                    @if ($enfant->background)
                    <div class="m-2 degrade_card_enfant animaux little"  style="background-image: {{$degrades[$enfant->background]}}">
                        <img src="{{asset('/img/animaux/'.$enfant->photo)}}" alt="" width="60">
                    
                    </div>
                    @else
                      <img src="{{asset($enfant->photoEleve)}}" alt="rover"  width="60" />
                    @endif
                    <div class="mx-3">
                        <div>{{$enfant->prenom}}</div>
                        <div>{{$enfant->nom}}</div>
                    </div>   
                    @foreach($sections as $sec)
                    <div class="d-flex flex-column align-items-center">
                        <div class='selectSectionFiche selectSectionItem {{$sec->id == $section->id ? "selected" : null}}' data-value="{{$sec->id}}" style="background-color: {{$sec->color}}">
                            <img src="{{asset('img/illustrations/'.$sec->logo)}}" alt="" width="45px" height="45px">
                        </div>
                        <div class="tiret_selection {{$sec->id == $section->id ? null : "d-none"}}" data-id="{{$sec->id}}" style="background-color: {{$sec->color}}"></div>            
                    </div>
                    
                    @endforeach           
                </div>
                
            </div>
            <div class="d-flex align-items-center" >
                
                
              
                
            </div>
        </div>
    <div id="mesfiches" class="listItems px-5" >
        <div class="fiche_container fiches mesitems">
        @foreach ($fiches as $fiche)
            @include('cards.item')
        @endforeach
    </div>
</div>


        
    </div>

   
</div>
@endsection
