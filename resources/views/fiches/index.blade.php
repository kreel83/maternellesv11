@extends('layouts.mainMenu', ['titre' => 'Mes fiches', 'menu' => 'item'])

@section('content')



<style>

</style>

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
    @foreach($sections as $sec)
        <div class='selectSectionFiche {{$sec->id == $section->id ? "selected" : null}}' data-value="{{$sec->id}}" style="background-color: {{$sec->color}}">
        {{$sec->court}}
        </div>
    @endforeach
</div>
<div class="col-md-12">

                    
        
   
        

     
<div class="d-flex justify-content-between align-items-center" id="choixFiche">
    <div class="d-flex">
        <button data-type="" class="createfiche mx-2 btnSelection btn {{$type == "createfiche" ? 'active' : 'null' }}" >Création de fiche</button>

        <div data-type="autresfiches" data-position="left" class="btnSelection mx-2 btn selected">Liste des fiches</div>
        <div data-type="mesfiches"  data-position="right" class="btnSelection btn">Ma sélection</div>                                

    </div>

            @include('fiches.filtre')
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
        ::-webkit-scrollbar-track {
            box-shadow: inset 0 0 5px grey;
            border-radius: 10px;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #4d95ff;
            border-radius: 20px;
        }
    }


/* Handle */

</style>
<div class="o-container" style="height: 80vh; width: 100%; overflow-y: auto;">



    <div  data-section="{{ $section->id }}">
        <div id="mesfiches" class="d-none listFiches" >
            <ul class="fiche_container fiches mesfiches" id="sortable">
            @foreach ($fiches as $fiche)
                @include('cards.fiche',['type' => 'mesfiches'])
            @endforeach
            </ul>
        </div>



        <div id="autresfiches" class="listFiches">
            
            <ul class="fiche_container fiches autresfiches" >

                @foreach ($universelles as $fiche)
                    @include('cards.universelle',['type' => 'autresfiches'])
                @endforeach
            </ul>
        </div>
        

        </div>




    </div>
</div>



@endsection
