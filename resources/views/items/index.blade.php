@extends('layouts.mainMenu2', ['titre' => "les résultats de $enfant->prenom", 'menu' => 'classe'])

@section('content')
    <style>
        .noFiche {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: red;
            width: fit-content;
            height: 70px;
        

        }
    </style>

    <div class="row position-relative gx-0" id="page_items">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('depart')}}">Tableau de bord</a></li>
              <li class="breadcrumb-item"><a href="{{route('enfants',['type' => $type])}}">Liste des enfants</a></li>
              <li class="breadcrumb-item active" aria-current="page">Evaluation</li>
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

        <div class="col-md-12 position-relative vh-100 ">
            <div class="custom-container">

            
            <div class="noFiche d-none ">
                <div>Aucune fiche trouvé</div>
                <a class="linkNoFiche btn btn-primary mt-3" href="">Ajouter des fiches</a>
            </div>

            <div class="d-flex justify-content-between align-items-center my-5">

                    <div class="d-flex ps-2 align-items-center enfant_pill">
                        <div class="arrowLeft me-5">
                            <a href="{{ route('enfants') }}">
                                <i class="fa-solid fa-arrow-left"></i>
                            </a>
                        </div>
                        <div class=" d-flex">
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
                                <div style="font-weight: 400; font-size: 14px">{{ $enfant->nom }}</div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div data-section="{{ $section->id }}" class="liste_section pe-5">
                            <div class="section_container">
        
                                @foreach ($sections as $sec)
                                    <div class="d-flex flex-column align-items-center">
                                        <div class='selectSectionFiche selectSectionItem {{ $sec->id == $section->id ? 'selected' : null }}'
                                            data-value="{{ $sec->id }}" style="background-color: {{ $sec->color }}" title="{{$sec->name}}">
                                            <img src="{{ asset('img/illustrations/' . $sec->logo) }}" alt="" width="45px"
                                                height="45px">
                                        </div>
                                        <div class="tiret_selection {{ $sec->id == $section->id ? null : 'd-none' }}"
                                            data-id="{{ $sec->id }}" style="background-color: {{ $sec->color }}"></div>
                                    </div>
                                @endforeach
                            </div>
                            {{-- <div id="SectionName">
                                {{ $sections[0]->name }}
                            </div> --}}
                        </div>
                    </div>
                
            </div>


            <div id="mesfiches" class="listItems d-flex justify-content-center">
                <div class="fiche_container fiches mesitems ">
                    @foreach ($fiches as $fiche)
                        @include('cards.item')
                    @endforeach
                </div>
            </div>

        </div>

        </div>


    </div>
@endsection
