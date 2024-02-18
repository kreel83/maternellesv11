@extends('layouts.mainMenu2', ['titre' => "les résultats de $enfant->prenom", 'menu' => 'classe'])

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

    <div class="position-relative gx-0 mt-5" id="page_items">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb position-relative me-5">
              <li class="breadcrumb-item"><a href="{{route('depart')}}">Tableau de bord</a></li>
              <li class="breadcrumb-item"><a href="{{route('enfants',['type' => $type])}}">Liste des enfants</a></li>
              <li class="breadcrumb-item active" aria-current="page">Evaluation</li>
              <span class="help position-absolute" data-location="eleves.evaluation.main"><i class="fa-light fa-message-question"></i></span>
            </ol>
          </nav>

        <input type="hidden" id="enfant" value="{{ $enfant->id }}">



        <style>
            .arrowLeft a {
                font-size: 35px;
                color: #7769FE;
            }
        </style>

        @php
        
            $degrades = App\Models\Enfant::DEGRADE;
        @endphp

        <div class="position-relative">
            <div class="custom-container">

            


            <div class="d-flex justify-content-between align-items-center my-5 flex-column flex-xl-row">

                    <div class="d-flex ps-2 align-items-center enfant_pill mb-3">
                        <div class="d-none d-xl-block arrowLeft me-2">
                            <a href="{{ route('enfants',['type' => 'evaluation']) }}">
                                <i class="fa-solid fa-arrow-left"></i>
                            </a>
                        </div>
                        <div class="d-flex">
                            @if ($enfant->background)
                                <div class="m-2 degrade_card_enfant animaux little"
                                    style="background-image: {{ $degrades[$enfant->background] }}">
                                    <img src="{{ asset('/img/animaux/' . $enfant->photo) }}" alt="" width="60">
        
                                </div>
                            @else
                                <img src="{{ asset($enfant->photoEleve) }}" alt="rover" width="60" />
                            @endif
                            <div class="ms-3 d-flex flex-column justify-content-center">
                                <div style="font-size: 24px;font-weight: bolder; color: {{$enfant->genre == 'F' ? 'var(--pink)' : 'var(--blue)'}}">{{ $enfant->prenom }}</div>
                                <div style="font-weight: 400; font-size: 14px" class="{{ config('app.custom.app_demo') && Auth::id() == config('app.custom.app_demo_user') ? 'blur' : null}}">{{ $enfant->nom }}</div>
                            </div>
                        </div>
                    </div>
                    
                    <div data-section="{{ $section->id }}" class="liste_section pe-5 d-flex">
                        

    
                            @foreach ($sections as $sec)
                                @if ($sec->id == 9 && Auth::user()->classe_active()->desactive_devenir_eleve == 1)
                                @else
                                <div class="d-flex flex-column align-items-center">
                                    <div class="tiret_selection {{ $sec->id == $section->id ? null : 'd-none' }}"
                                        data-id="{{ $sec->id }}" style="background-color: {{ $sec->color }}"></div>
                                    <div class='selectSectionFiche selectSectionItem {{ $sec->id == $section->id ? 'selected' : null }}'
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
                   
                            @foreach ($fiches as $fiche)
                                @include('cards.item')
                            @endforeach                             
           
                   
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

    <div class="modal fade" id="modifResultat" tabindex="-1" aria-labelledby="modifResultat" aria-hidden="true">
        <div class="modal-dialog" style="top: 150px">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Modification du cahier de réussites de la section</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div style="font-size: 12px;margin-bottom: 10px">
                    La modification de l'évaluation de cet activité n'implique pas de mise à jour automatique du résumé de la section <span id="sectionLabel"></span>.
                    Vous pouvez ici, mettre à jour manuellement le texte correspondant à la section.
                </div>
              <div id="editorModif"  data-texte="{{$resultats[$sec->id] ?? null}}" data-section="{{$section->id}}" data-enfant="{{$enfant->id}}" style="min-height: 100px; height: auto;max-height: 420px; overflow-y: auto" class="ql-container ql-snow position-relative">
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btnAction inverse" data-bs-dismiss="modal">Annuler</button>
              <button type="button" class="btnAction" id="CommitSaveReussite" data-bs-dismiss="modal">Sauvegarder</button>
            </div>
          </div>
        </div>
      </div>



@endsection
