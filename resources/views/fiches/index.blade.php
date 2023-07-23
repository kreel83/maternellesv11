@extends('layouts.mainMenu', ['titre' => 'Mes fiches', 'menu' => 'item'])

@section('content')



<style>

</style>

<div class="container">
    <div id="fichesView" class="row">
    {{-- <div class="col-md-3">
            <div class="form-group" style="margin-top: 40px">

                    @foreach($sections as $sec)
                        <div class='selectSectionFiche {{$sec->id == $section->id ? "selected" : null}}' data-value="{{$sec->id}}" style="background-color: {{$sec->color}}">
                        {{$sec->name}}
                        </div>
                    @endforeach

            </div>
    </div> --}}
    <div  data-section="{{ $section->id }}" class="liste_section">
        <div class="section_container">
            @foreach($sections as $sec)
            <div class="d-flex flex-column align-items-center">
                    <div class='selectSectionFiche {{$sec->id == $section->id ? "selected" : null}}' data-value="{{$sec->id}}" style="background-color: {{$sec->color}}">
                        <img src="{{asset('img/illustrations/'.$sec->logo)}}" alt="" width="45px" height="45px">
                    </div>
                    <div class="tiret_selection {{$sec->id == $section->id ? null : "d-none"}}" data-id="{{$sec->id}}" style="background-color: {{$sec->color}}"></div>            
            </div>

            @endforeach           
        </div>

    </div>
    <div class="col-md-12">

                        
            
    
            

        
    <div class="d-flex justify-content-between align-items-center" id="choixFiche">
        <div class="d-flex">
           
           
        </div>

                
    </div>
    <div class="d-flex" id="pointerFiche">
            <div id="pointer" class='w-50'></div>
    </div>

    <style>
        /* width */
        .o-container {
            /* width */
            ::-webkit-scrollbar {
                width: 20px;
            }

            /* Track */
            ::-webkit-bar-track {
                box-shadow: inset 0 0 5px #7769FE;
                border-radius: 10px;
            }

            /* Handle */
            ::-webkit-scrollbar-thumb {
                background: #7769FE;
                border-radius: 20px;
            }
        }


    /* Handle */

    </style>

        <div class="d-flex controle justify-content-between" style="width: 1080px">

            <div class="d-flex ">

                <div data-type="autresfiches" data-position="left" class="btnSelectionType violet droit selected">Liste des fiches</div>
                <div data-type="mesfiches"  data-position="right" class="btnSelectionType violet droit">Ma sélection</div>                                
            </div>
            <div class="d-flex pb-3">
                <div>
                    @include('fiches.filtre')
                </div>
                <button data-type="" class="createfiche mx-2 btnSelection  violet {{$type == "createfiche" ? 'active' : 'null' }}" >+</button>
            </div>
        </div>
    <div class="o-container" style="height: 80vh; width: 1080px; overflow-y: auto;">


        <div  data-section="{{ $section->id }}">
            <div id="autresfiches" class="listFiches d-flex justify-content-center">
                
                <ul class="fiche_container fiches autresfiches" >

                    @foreach ($universelles as $fiche)
                        @include('cards.universelle',['type' => 'autresfiches'])
                    @endforeach
                </ul>
            </div>

            <div id="mesfiches" class="d-none listFiches justify-content-center" >
                <ul class="fiche_container fiches mesfiches" id="sortable" style="width: calc((240px * 4) + 120px)">
                @foreach ($fiches as $fiche)
                    @include('cards.fiche',['type' => 'mesfiches'])
                @endforeach
                </ul>
            </div>



            

            </div>




        </div>
    </div>    
</div>




@endsection
