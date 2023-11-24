@extends('layouts.mainMenu2', ['titre' => 'Mes fiches', 'menu' => 'item'])

@section('content')
    <style>

    </style>


    <div id="fichesView" class="row">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">

            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('depart') }}">Tableau de bord</a></li>
                <li class="breadcrumb-item active" aria-current="page">Selection des fiches d'activités</li>
            </ol>
        </nav>

        <div data-section="{{ $section->id }}" class="liste_section d-flex align-items-end" style="width: 1000px !important">
            
                @foreach ($sections as $sec)
                @if ($sec->id == 9 && Auth::user()->configuration->desactive_devenir_eleve == 1)
                @else
                <div class="d-flex flex-column align-items-center">
                        <div class="tiret_selection {{ $sec->id == $section->id ? null : 'd-none' }}"
                            data-id="{{ $sec->id }}" style="background-color: {{ $sec->color }}"></div>
                        <div class='selectSectionFiche {{ $sec->id == $section->id ? 'selected' : null }}'
                            data-value="{{ $sec->id }}" style="background-color: {{ $sec->color }}">
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
                @if (Auth::user()->hasResultats() ==  0)
                <div title="Importer vos activités par section" class="btnAction" id="importationFiches" data-bs-toggle="modal" data-bs-target="#importSection" style="width: 50px;height: 53px; border-radius: 10px; margin: 0; margin-left: 20px; margin-bottom: 20px">
                    <i class="fa-solid fa-file-import fs-3"></i>
                </div>
                @endif
            
        </div>

        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center" id="choixFiche">



            </div>
            <div class="d-flex" id="pointerFiche">
                <div id="pointer" class='w-50'></div>
            </div>

            <style>
                /* Handle */
            </style>

            <div class="d-flex controle justify-content-between flex-column-reverse flex-xl-row">

                <div class="d-flex ">

                    <div data-type="autresfiches" data-position="left"
                        class="btnSelectionType violet droit selected les_fiches text-center">Liste des fiches</div>
                    <div data-type="mesfiches" data-position="right" class="btnSelectionType violet droit ma_selection  text-center">Ma
                        sélection</div>
                </div>
                <div class="d-flex pb-3 justify-content-end w-100">
                    <select name="" id="categories" class="w-75">
                        <option value="null" selected>Toutes les fiches</option>
                        @include('fiches.include.categories')
                    </select>

                    <button data-type=""
                        class="deletefiches d-none mx-2 btnSelection  p-0 violet {{ $type == 'createfiche' ? 'active' : 'null' }}">
                        RAZ
                    </button>
                    <button data-type=""
                        class="createfiche mx-2 btnSelection  p-0 violet {{ $type == 'createfiche' ? 'active' : 'null' }}">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="o-container" style="height: 80vh; overflow-y: auto;">


                <div data-section="{{ $section->id }}">
                    <div id="autresfiches" class="listFiches d-flex justify-content-center">

                        <ul class="fiche_container fiches autresfiches m-0 p-0">

                            @foreach ($universelles as $key => $fiche)
                                @include('cards.universelle', [
                                    'type' => 'autresfiches',
                                    'classifications' => $classifications,
                                ])
                            @endforeach
                        </ul>
                    </div>

                    <div id="mesfiches" class="d-none listFiches justify-content-center">
                        <ul class="fiche_container fiches mesfiches p-0 m-0" id="sortable">
                            @foreach ($fiches as $key => $fiche)
                                @include('cards.fiche', ['type' => 'mesfiches'])
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


        <div class="modal fade" id="importSection" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="top: 70px">
                <div class="modal-content" style="height: 250px">

                    <div class="modal-header">
                        <h5 class="modal-title fs-5" id="title">
                            Selectionnez votre ou vos sections
                        </h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex flex-column justify-content-center align-items-center" style="overflow: hidden; overflow-y: auto">
                        <form action="{{route('setSection')}}" method="POST">
                            @csrf

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="ps" id="ps" name="section[]">
                            <label class="form-check-label" for="ps">
                              Petite section
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="ms" id="ms"  name="section[]">
                            <label class="form-check-label" for="ms">
                              Moyenne section
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="gs" id="gs"  name="section[]">
                            <label class="form-check-label" for="gs">
                              Grande section
                            </label>
                          </div>
                          <button type="submit" class="btnAction">Selectionner</button>
                        </form>

                    </div>

                </div>
            </div>
        </div>
        <div class="modal fade" id="biblioModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" style="top: 70px">
                <div class="modal-content" style="height: 600px">

                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="title">

                        </h1>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex flex-wrap" style="overflow: hidden; overflow-y: auto">
                        {{-- @include('fiches..include.liste_images') --}}

                    </div>

                </div>
            </div>
        </div>

        <div class="modal fade" id="biblioModalCategories" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" style="top: 70px">
                <div class="modal-content" style="height: 600px">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <select name="" id="newCategorie" class="form-control">

                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalRetirerFiche" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" style="top: 70px">
                <div class="modal-content" style="height: 600px">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-warning">Une validation a déjà été effectuée sur cette fiche
                            <br>sur les enfants suivants :
                        </div>
                        <ul id="enfant_liste"></ul>
                        <div class="alert alert-danger">La déselection de cette fiche entrainera la suppression de
                            l'évaluation de ou des enfants sur cette activite. <br> Voulez-vous déselectionner cette fiche ?
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
                        <button class="btn btn-primary deselectionneFiche" data-bs-dismiss="modal">Déselectionner la
                            fiche</button>
                    </div>
                </div>
            </div>
        </div>
    @endsection
