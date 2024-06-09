@extends('layouts.mainMenu2', ['titre' => "les activités", 'menu' => 'classe'])

@section('content')
    <style>
        .noFiche {

           
            color: black;

            width: 300px;

            display: flex;
            height: 300px;
            justify-content: center;
            align-items: center;
            background-color: white;
            flex-direction: column;
            border-radius: 15px;
            
        

        }
    </style>

    <div class="position-relative gx-0 mt-5" id="page_activites">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb position-relative me-5">
              <li class="breadcrumb-item"><a href="{{route('depart')}}">Tableau de bord</a></li>
             
              <li class="breadcrumb-item active" aria-current="page">Les activités</li>
              <span class="help position-absolute" data-location="eleves.evaluation.main"><i class="fa-light fa-message-question"></i></span>
            </ol>
          </nav>

       



        <style>
            .arrowLeft a {
                font-size: 35px;
                color: #7769FE;
            }
        </style>



        <div class="position-relative">
            <div class="custom-container">

            


            <div class="d-flex justify-content-between align-items-center my-5 flex-column flex-xl-row">                    
                    <div data-section="{{ $section->id }}" class="liste_section pe-5 d-flex">                         
                            @foreach ($sections as $sec)
                                @if ($sec->id == 9 && Auth::user()->classe_active()->desactive_devenir_eleve == 1)
                                @else
                                <div class="d-flex flex-column align-items-center">
                                    <div class="tiret_selection {{ $sec->id == $section->id ? null : 'd-none' }}"
                                        data-id="{{ $sec->id }}" style="background-color: {{ $sec->color }}"></div>
                                    <div class='selectSectionDiscipline {{ $sec->id == $section->id ? 'selected' : null }}'
                                        data-value="{{ $sec->id }}" style="background-color: {{ $sec->color }}" title="{{$sec->name}}"
                                        data-reussite="{{$listeReussiteSection[$sec->id] ?? false}}"
                                        >
                                        <img src="{{ asset('img/illustrations/' . $sec->logo) }}" alt="" width="45px"
                                            height="45px">
                                    </div>
                                    @if ($sec->id == 99)
                                    <div class="petit_texte" style="color: {{$sec->color}}">Général</div>
                                    @else
                                    <div class="petit_texte" style="color: {{$sec->color}}">{{$sec->icone}}</div>
                                    @endif
                                </div>
                                @endif
                            @endforeach
                       
                            {{-- <div id="SectionName">
                                {{ $sections[0]->name }}
                            </div> --}}
                    </div>
                    
                
            </div>


            <div id="mesfiches" class="listItems d-flex justify-content-center">
                <div class="fiche_container fiches mesitems position-relative d-flex">                    
                    <div class="d-flex justify-content-center flex-wrap">

                        @foreach ($fiches as $fiche)
                        @include('cards.item',['link' => true])
                        @endforeach                             
                    </div>
           
                   
                    </div>
                    <div class="noFiche d-none">
                        <div>Aucune activité sélectionnée</div>
                        <a class="linkNoFiche btnAction mt-5" href="">Ajouter des activités</a>
                    </div>                    
                </div>
            </div>
        </div>
        </div>


    </div>





@endsection
