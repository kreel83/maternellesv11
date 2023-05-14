@extends('layouts.mainMenu', ['titre' => 'Mes fiches'])

@section('content')

<style>

</style>

<div id="fichesView" class="row">
<div class="col-md-3">
        <div class="form-group" style="margin-top: 40px">

                @foreach($sections as $sec)
                    <div class='selectSectionFiche {{$sec->id == $section->id ? "selected" : null}}' data-value="{{$sec->id}}" style="background-color: {{$sec->color}}">
                    {{$sec->name}}
                    </div>
                @endforeach

        </div>
</div>
<div class="col-md-7">
        

     
<div class="d-flex" id="choixFiche">
            <button data-type="autresfiches" class="mx-2 btn btn-primary  w-50 {{$type == "autresfiches" ? 'active' : 'null' }}">Liste des fiches</button>
            <button data-type="mesfiches" class="btn btn-primary w-50 {{$type == "mesfiches" ? 'active' : 'null' }}">Ma sélection</button>           
            
          
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
            
            <ul class="fiche_container fiches autresfiches" id="sortable">

                @foreach ($universelles as $fiche)
                    @include('cards.universelle',['type' => 'autresfiches'])
                @endforeach
            </ul>
        </div>
        

        </div>


        <div class="tab-pane fade {{$type == "createfiche" ? 'show active' : 'null' }}" id="nav-2" role="tabpanel" aria-labelledby="nav-profile-tab">

            @include('fiches.create')
        </div>

    </div>
</div>

<div class="col-md-2">
<button data-type="createfiche" class="mx-2 btn btn-primary  {{$type == "createfiche" ? 'active' : 'null' }}" >Création de fiche</button>
    @include('fiches.filtre')
</div>
</div>









@endsection
