@extends('layouts.mainMenu2', ['titre' => 'Mes fiches', 'menu' => $menu])

@section('content')


    <style>
        .disabledtitle {
            font-weight: bold;
        }

        #biblio_container {
            height: 100vh;
            overflow: hidden;
            overflow-y: auto;
        }

        .item {
            flex: 1 1 0;
            width: 0;
            margin: 4px
        }

        .photoEnfantImg {
            width: 250px;
            height: 150px;
            border: 2px solid lightblue;
            border-radius: 25px;
            overflow: hidden;
        }
    </style>


    <div class="my-auto mt-5" id="create_fiche">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">

            <ol class="breadcrumb position-relative">
                <li class="breadcrumb-item"><a href="{{ route('depart') }}">Tableau de bord</a></li>
                <li class="breadcrumb-item"><a href="/app/fiches?section={{ $itemactuel->section_id }}">Les fiches</a></li>
                @if ($new)
                    <li class="breadcrumb-item active" aria-current="page">Création d'une fiche d'activité</li>
                    <span class="help position-absolute" data-location="fiches.creation.main"><i class="fa-light fa-message-question"></i></span>
                    
                    @elseif ($duplicate)
                    <li class="breadcrumb-item active" aria-current="page">Duplication d'un fiche d'activité</li>
                    <span class="help position-absolute" data-location="fiches.duplicate.main"><i class="fa-light fa-message-question"></i></span>
                    @else
                    <li class="breadcrumb-item active" aria-current="page">Modification d'un fiche d'activité</li>
                    <span class="help position-absolute" data-location="fiches.modification.main"><i class="fa-light fa-message-question"></i></span>
                @endif
            </ol>
        </nav>

        @include('include.display_msg_error')

        <form class="mt-xl-5" action="{{ route('saveFiche') }}" method="post" id="form1" enctype="multipart/form-data"
            data-message={{ Session::has('message') }}>
            <div class="row">
                <div class="col-xs-12 col-xl-6 pe-4">
                    @csrf

                    @if ($duplicate)
                        <input type="hidden" name="section_id" value="{{ $section->id }}">
                        <input type="hidden" name="categorie_id" value="{{ $itemactuel->categorie_id }}">
                    @endif
                    <input type="hidden" name="fiche_id" value="{{ $new ? null : $itemactuel->id }}">
                    <input type="hidden" name="duplicate" value="{{ $duplicate }}">
                    <input type="hidden" id="first_item" value="{{$first_item}}">


                    <div class="form-group cadre-group">
                        <div class="h5">Domaine et activité </div>
                        <select class="form-select my-4 form_section" id="section_id" name="section_id"
                            {{ $duplicate ? 'disabled' : null }}>
                            <option value="" selected>Choisissez un domaine...</option>
                            @foreach ($sections as $sec)
                                <option value="{{ $sec->id }}" data-img={{'/storage/items/none/'.$sec->id.'-none.png'}}
                                    {{ isset($section->id) ? ($sec->id == $section->id ? 'selected' : null) : null }}>
                                    {{ $sec->name }}</option>
                            @endforeach
                        </select>
                        @error('section_id')
                        <div class="error_message">{{ $message }}</div>                                        
                        @enderror

                        <select class="form-select my-4 form_section" id="categorie_id" name="categorie_id"
                            {{ $duplicate ? 'disabled' : null }}>

                            @if (!$new)
                                <option value="" selected>Choisissez une activité...</option>
                                @php
                                    $x = '';
                                @endphp
                                @foreach ($categories as $cla)
                                    @if ($x != $cla->section1)
                                        <option class="disabledtitle" disabled>{{ $cla->section1 }}</option>
                                        @php
                                            $x = $cla->section1;
                                        @endphp
                                    @endif
                                    <option value="{{ $cla->id }}"
                                        {{ isset($itemactuel->categorie_id) ? ($cla->id == $itemactuel->categorie_id ? 'selected' : null) : null }}>
                                        {{ $cla->section2 }}</option>
                                @endforeach
                            @endif

                        </select>
                        @error('categorie_id')
                        <div class="error_message">{{ $message }}</div>                                        
                        @enderror
                    </div>
                    <div
                        class="cadre-group form_image d-flex   flex-column  {{ isset($section->id) ? null : 'd-none' }}">
                        <div class="h5">Illustation<span class="help" data-location="fiche.create.illustration"><i class="fa-light fa-message-question"></i></span></div>
                        <div class="d-flex flex-column flex-md-row justify-content-between px-5">
                            <input accept="image/*" name="file" type='file' id="photoEnfantInput" hidden />

                            <div id="photoEnfantImg" class="d-flex flex-column">
                                <input type="hidden" name="imageName" id="imageName" value="">

                                {{-- <i style="cursor: pointer;font-size: 200px; z-index: 1000; color: lightgray"
                                    class="fa-light fa-image logoImage {{ $new ? null : 'd-none' }}"></i> --}}
                                <img class="dlImage" alt="your image"
                                    src="{{ asset($itemactuel->image_name) }}" width="250px" height="150"
                                    style="cursor: pointer;" />
                                <small class="text-center">Cliquez sur l'image pour télécharger <br> votre illustration</small>
                            </div>

                            <div class="col-md-2 mt-3">
                                <button type="button" class="btnAction biblioModal" data-bs-toggle="modal"
                                    data-bs-target="#biblioModal">
                                    bibliotheque d'images
                                </button>
                            </div>                            
                        </div>
                        @error('file')
                        <div class="error_message">{{ $message }}</div>                                        
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-xl-6 ps-4 create_droit">

                    <div class="form-group cadre-group">
                        <div class="h5">Section et titre</div>
                        {{-- <div class="d-flex justify-content-between my-2 form_maternelle" id="filtre"> --}}
                        <div class="my-2 form_maternelle" id="filtre">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="true" id="ps" name="section[ps]"
                                    {{ $itemactuel && substr($itemactuel->lvl, 0, 1) == '1' ? 'checked' : null }}>
                                <label class="form-check-label" for="ps">
                                    Petite section
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="true"
                                    id="ms" name="section[ms]" {{ $itemactuel && substr($itemactuel->lvl, 1, 1) == '1' ? 'checked' : null }}>
                                <label class="form-check-label" for="ms">
                                    Moyenne section
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="true" id="gs" name="section[gs]"
                                    {{ $itemactuel && substr($itemactuel->lvl, 2, 1) == '1' ? 'checked' : null }}>
                                <label class="form-check-label" for="gs">
                                    Grande section
                                </label>
                            </div>
                        </div>
                        @error('section')
                        <div class="error_message">{{ $message }}</div>                                        
                        @enderror
                        <div class="field field_v1 my-3 form_titre form-group w-100 d-flex flex-column">

                            <input id="titre" class="form-control" name="name" placeholder="titre de la fiche"
                                style="font-size: 1rem !important" value="{{ $itemactuel ? $itemactuel->name : null }}"
                                >
                            <div class="text-end" style="font-size: 12px; color: var(--main-color)"><span id="compteur">0</span>/90</div>
                        </div>
                            @error('name')
                            <div class="error_message">{{ $message }}</div>                                        
                            @enderror
                    </div>





                    <div class="d-flex flex-column mb-4 cadre-group pt-4 ">
                        <div class="h5">Phrase<span class="help" data-location="fiche.create.phrase"><i class="fa-light fa-message-question"></i></span></div>

                        <div class="d-flex justify-content-between">
                            <div>Exemple : Tom sait compter jusqu'à 5.</div>
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#warningFichePhrase"><i class="fa-solid fa-question"></i></button>
                            

                        </div>
                        <div id="editor3" class="mt-2 form_editeur" data-phrase="{{ $itemactuel->phrase_masculin }}"
                            data-section="" style="height: 100px; ">{!! $itemactuel && !$new ? $itemactuel->phrase : null !!}</div>
                        <textarea class="d-none" name="phrase" id="phraseForm" style="width: 100%" rows="3">{!! $itemactuel && !$new ? $itemactuel->phrase : null !!}</textarea>
                        @error('phrase')
                        <div class="error_message">{{ $message }}</div>                                        
                        @enderror
                    </div>

                    @if ($new || $duplicate)
                    <div class="row">
                        <div class="col">
                            <div class="d-flex justify-content-start">
                                <button type="submit" name="submit" value="save"
                                    class="btnAction form_save">Sauvegarder</button>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-flex justify-content-end">
                                <button type="submit" name="submit" value="save_and_select"
                                    class="btnAction form_save_select">Sauvegarder et sélectionner</button>
                            </div>
                        </div>
                    </div>
                    @else
                        <div class="d-flex justify-content-center">
                            <button type="submit" name="submit" value="modif" class="btnAction">Sauvegarder</button>
                        </div>
                    @endif

                    {{-- <div class="d-flex justify-content-between">
                        @if ($new || $duplicate)
                            <button type="submit" name="submit" value="save"
                                class="btnAction form_save">Sauvegarder</button>
                            <button type="submit" name="submit" value="save_and_select"
                                class="btnAction form_save_select">Sauvegarder et sélectionner</button>
                        @else
                            <button type="submit" name="submit" value="modif" class="btnAction">Sauvegarder</button>
                        @endif
                    </div> --}}

                </div>
            </div>
        </form>

    </div>
    






    <style>
        .btn-main {
            background-color: var(--main-color);
            color: white;
        }

        .btn-main:hover {
            background-color: var(--main-color);
            filter: brightness(85%) !important;
            color: white;
        }
    </style>




    <div class="modal fade" id="successCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" style="top: 40%; left: 50%; transform: translate(-50%, -40%); border: none">
            <div class="modal-content" style="height: 400px; width: 500px; border: none">

                <div class="modal-header" style="background-color: var(--second-color); color: white">
                    <h5 class="modal-title text-center" id="title">
                        @if ($duplicate)
                            La fiche a bien été dupliquée
                        @else
                            La fiche a bien été créée
                        @endif
                    </h5>

                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                <div class="modal-body">
                    <h5 class="text-center">Souhaitez-vous :</h5>
                    <div class="d-flex flex-column mx-5">
                        @if ($duplicate)
                            <a href="/app/fiches?section={{ $section->id }}" class="btn btn-main my-2">Retour aux
                                fiches</a>
                            <a href="/app" class="btn btn-main my-2">Aller sur votre tableau de bord</a>
                        @else
                            <a href="/app/fiches/create" class="btn btn-main my-2">Créér une nouvelle fiche ?</a>
                            <a href="/app/fiches?section={{ Session::get('section') }}" id="lienRetourFiche"
                                class="btn btn-main my-2">Retourner aux fiches ?</a>
                            <a href="/app" class="btn btn-main my-2">Aller sur votre tableau de bord ?</a>
                        @endif
                    </div>


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

        <!-- Modal -->
    <div class="modal fade" id="warningFichePhrase" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="top: 100px">
        <div class="modal-content">
            <div class="modal-header">
            <h5>Information concernant la création de fiche</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info mt-2 mb-2" role="alert" style="font-size: 14px">
                    Vous devez rédiger un texte qui sera repris dans le cahier de réussites à la validation de cette
                    activité. <br> Par convention, utilisez le prénom <strong>Tom</strong> dans la rédaction de votre phrase.<br>
                    Notre intelligence artificielle fera le reste :)
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btnAction" data-bs-dismiss="modal">J'ai compris</button>

            </div>
        </div>
        </div>
    </div>


@endsection
