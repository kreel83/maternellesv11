@extends('layouts.mainMenu2', ['titre' => 'Mes fiches', 'menu' => 'item'])

@section('content')



<style>

</style>

<div class="container">
    <div id="fichesView" class="row">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">

            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('depart')}}">Tableau de bord</a></li>        
                <li class="breadcrumb-item active" aria-current="page">Selection des fiches d'activités</li>
              </ol>
            </nav>
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
        <div class="section_container selection_section">
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
                    .createfiche {
                width: 34px !important;
                height: 34px !important;
                display: flex;
                justify-content: center;
                align-items: center;
            }
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

        <div class="d-flex controle justify-content-between" >

            <div class="d-flex ">

                <div data-type="autresfiches" data-position="left" class="btnSelectionType violet droit selected les_fiches">Liste des fiches</div>
                <div data-type="mesfiches"  data-position="right" class="btnSelectionType violet droit ma_selection">Ma sélection</div>                                
            </div>
            <div class="d-flex pb-3">
                <div>
                    @include('fiches.filtre')
                </div>
                <button data-type="" class="createfiche mx-2 btnSelection  p-0 violet {{$type == "createfiche" ? 'active' : 'null' }}" >
                    <i class="fa-solid fa-plus"></i>
                </button>
            </div>
        </div>
    <div class="o-container" style="height: 80vh; overflow-y: auto;">


        <div  data-section="{{ $section->id }}">
            <div id="autresfiches" class="listFiches d-flex justify-content-center">
                
                <ul class="fiche_container fiches autresfiches m-0 p-0 justify-content-center" >

                    @foreach ($universelles as $key=>$fiche)
                        @include('cards.universelle',['type' => 'autresfiches'])
                    @endforeach
                </ul>
            </div>

            <div id="mesfiches" class="d-none listFiches justify-content-center" >
                <ul class="fiche_container fiches mesfiches p-0 m-0" id="sortable" >
                @foreach ($fiches as $key=>$fiche)
                    @include('cards.fiche',['type' => 'mesfiches'])
                @endforeach
                </ul>
            </div>



            

            </div>




        </div>
    </div>    
</div>




@endsection
