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


    <div class="container-fluid row my-auto mt-5">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">

            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('depart') }}">Tableau de bord</a></li>
                <li class="breadcrumb-item"><a href="/app/fiches?section={{ $itemactuel->section_id }}">Les fiches</a></li>
                @if ($new)
                    <li class="breadcrumb-item active" aria-current="page">Création d'une fiche d'activité</li>
                @elseif ($duplicate)
                    <li class="breadcrumb-item active" aria-current="page">Duplication d'un fiche d'activité</li>
                @else
                    <li class="breadcrumb-item active" aria-current="page">Modification d'un fiche d'activité</li>
                @endif
            </ol>
        </nav>

        <style>
             .cadre-group {
                position: relative;;
                border-radius: 14px;
                border: 1px solid grey;
                padding: 8px;
                margin:  30px 0;
             }
             .cadre-group>label {
                background-color: white;
                top: -12px;
                left: 30px;
                padding: 0 16px;
                position: absolute
             }
        </style>

        <form action="{{ route('saveFiche') }}" method="post" id="form1" enctype="multipart/form-data"
            data-message={{ Session::has('message') }}>
            <div class="row">
                <div class="col-xs-12 col-md-6 pe-4">
                    @csrf

                    @if ($duplicate)
                        <input type="hidden" name="section_id" value="{{ $section->id }}">
                        <input type="hidden" name="categorie_id" value="{{ $itemactuel->categorie_id }}">
                    @endif
                    <input type="hidden" name="fiche_id" value="{{ $new ? null : $itemactuel->id }}">
                    <input type="hidden" name="duplicate" value="{{ $duplicate }}">


                    <div class="form-group cadre-group">
                        <label for="">Domaine et activité</label>
                        <select class="form-select my-4 form_section" id="section_id" name="section_id"
                            {{ $duplicate ? 'disabled' : null }}>
                            <option value="" selected>Choisissez un domaine...</option>
                            @foreach ($sections as $sec)
                                <option value="{{ $sec->id }}"
                                    {{ isset($section->id) ? ($sec->id == $section->id ? 'selected' : null) : null }}>
                                    {{ $sec->name }}</option>
                            @endforeach
                        </select>
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
                    </div>
                    <div class="cadre-group form_image d-flex justify-content-between align-items-center px-5">
                        <label for="">Illustation</label>
                        <input accept="image/*" name="file" type='file' id="photoEnfantInput" hidden />

                        <div id="photoEnfantImg" class="d-flex flex-column">
                            <input type="hidden" name="imageName" id="imageName" value="">

                            <i style="cursor: pointer;font-size: 200px; z-index: 1000; color: lightgray"
                                class="fa-light fa-image logoImage {{ $new ? null : 'd-none' }}"></i>
                            <img class="dlImage {{ $new ? 'd-none' : null }}" alt="your image"
                                src="{{ asset($itemactuel->image_name) }}" width="250px" height="150"
                                style="cursor: pointer; z-index: 6000" />
                            <small>Cliquez sur l'image pour télécharger <br> votre illustration</small>
                        </div>
                    
                        <div class="col-md-2">
                            <button type="button" class="btn btn-sm btn-primary biblioModal" data-bs-toggle="modal"
                                data-bs-target="#biblioModal">
                                bibliotheque d'image
                            </button>
                        </div>                    
                    </div>
                </div>






                    <div class="col-xs-12 col-md-6 ps-4">

                        <div class="form-group cadre-group">
                            <label for="">section et titre</label>
                            <div class="d-flex justify-content-between my-2 form_maternelle" id="filtre">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="true" name="ps"
                                        {{ $itemactuel && substr($itemactuel->lvl, 0, 1) == '1' ? 'checked' : null }}>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        petite section
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="true"
                                        name="ms"{{ $itemactuel && substr($itemactuel->lvl, 1, 1) == '1' ? 'checked' : null }}>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Moyenne section
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="true" name="gs"
                                        {{ $itemactuel && substr($itemactuel->lvl, 2, 1) == '1' ? 'checked' : null }}>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Grande section
                                    </label>
                                </div>
                            </div>
                            <div class="field field_v1 my-3 form_titre form-group w-100">

                                <input id="titre" class="form-control" name="name" placeholder="titre de la fiche"
                                    value="{{ $itemactuel ? $itemactuel->name : null }}" required>

                            </div>
                        </div>




                        {{-- @php --}}
                        {{-- dd($fiche); --}}
                        {{-- @endphp --}}

                        <div class="d-flex flex-column mb-4 cadre-group pt-4 ">
                            <label for="">Phrase</label>






                            Phrase qui apparaitra dans le cahier de réussites.
                            <strong>Il convient de la rédiger au masculin.</strong><br>
                            Exemple : Il sait compter jusqu'à 5.
                            <div id="editor3" class="mt-2 form_editeur"
                                data-phrase="{{ $itemactuel->phrase_masculin }}" data-section=""
                                style="height: 100px; ">{!! $itemactuel && !$new ? $itemactuel->phrase : null !!}</div>
                            <textarea class="d-none" name="phrase" id="phraseForm" style="width: 100%" rows="3" required>{!! $itemactuel && !$new ? $itemactuel->phrase : null !!}</textarea>

                            <div class="alert alert-info mt-2 mb-2" role="alert">
                                Ve texte au féminin va être généré. Toutefois, si vous préférez la saisir
                                manuellement, <a href="#" onclick="$('.pf').show();$('.pf').focus();"
                                    class="alert-link">cliquez
                                    ici</a>.
                            </div>

                            <div class="pf" style="display:none">
                                <textarea name="phrase_feminin" style="width: 100%" rows="3"
                                    placeholder="Ecrivez ici la même phrase au féminin...">{!! $itemactuel && !$new ? $itemactuel->phrase_feminin : null !!}</textarea>
                            </div>


                            <style>

                            </style>
                            <!--
                                    <div class="d-flex mb-5 motCleFiche form_mot_cle">
                                        <div data-reg="L'élève " class="item btnCommun me-2">prénom</div>
                                        {{-- <div data-reg="@ilelle@" class="item btnCommun me-2">pronom personnel</div>
                <div data-reg="*e*" class="item btnCommun">feminin / masculin</div> --}}
                                        {{-- <table class="table table-bordered table-hover" id="motCleFiche" style="cursor: pointer;">
                    <tr style="text-align: center">
                        <td data-reg="@name@">prénom</td>
                        <td data-reg="@ilelle@">pronom personnel</td>
                        <td data-reg="*e*">feminin / masculin</td>
                    </tr>
        
                </table> --}}
                                    </div>
                                    -->




                        </div>

                        <div class="d-flex justify-content-between">
                            @if ($new || $duplicate)
                                <button type="submit" name="submit" value="save"
                                    class="btnAction form_save">Sauvegarder</button>
                                <button type="submit" name="submit" value="save_and_select"
                                    class="btnAction form_save_select">Sauvegarder et sélectionner</button>
                            @else
                                <button type="submit" name="submit" value="modif"
                                    class="btnAction">Sauvegarder</button>
                            @endif
                            <!--<button type="button" class="btnAction">Annuler</button>-->
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
                    <h4 class="text-center">Souhaitez-vous :</h4>
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


@endsection
