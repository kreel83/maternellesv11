@extends('layouts.mainMenu2', ['titre' => 'Mes fiches', 'menu' => $menu])

@section('content')





    <div class="container-fluid row h-100 my-auto mt-5">
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
        <div class="col-xs-12 offset-md-2 col-md-8">






            <form action="{{ route('saveFiche') }}" method="post" id="form1" enctype="multipart/form-data"
                data-message={{ Session::has('message') }}>
                @csrf

                @if ($duplicate)
                    <input type="hidden" name="section_id" value="{{ $section->id }}">
                    <input type="hidden" name="categorie_id" value="{{ $itemactuel->categorie_id }}">
                    {{-- <input type="hidden" name="classification_id" value="{{$classification->id}}"> --}}
                @endif
                <input type="hidden" name="fiche_id" value="{{ $new ? null : $itemactuel->id }}">
                <input type="hidden" name="duplicate" value="{{ $duplicate }}">
                {{-- <input type="hidden" name="provenance" value="{{$provenance}}"> --}}

                <div class="form-group">
                    <label for="">Domaines</label>
                    <select class="form-select my-4 form_section" id="section_id" name="section_id"
                        {{ $duplicate ? 'disabled' : null }}>
                        <option value="" selected>Choisissez une section...</option>
                        @foreach ($sections as $sec)
                            <option value="{{ $sec->id }}"
                                {{ isset($section->id) ? ($sec->id == $section->id ? 'selected' : null) : null }}>
                                {{ $sec->name }}</option>
                        @endforeach
                    </select>
                </div>



                <div>
                    <div class="form-group">
                        <label for="">Activités</label>
                        <select class="form-select my-4 form_section" id="categorie_id" name="categorie_id"
                            {{ $duplicate ? 'disabled' : null }}>

                    </div>

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




                <style>
                    .disabledtitle {
                        font-weight: bold;
                    }
                </style>


                <div class="form-group">
                    <label for="">section</label>
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
                </div>


                <div class="col-md-12">

                    {{-- @php --}}
                    {{-- dd($fiche); --}}
                    {{-- @endphp --}}

                    <div class="d-flex flex-column mb-4">
                        <div class="field field_v1 mt-3 form_titre form-group">

                            <input id="titre" class="field__input" placeholder="" name="name"
                                value="{{ $itemactuel ? $itemactuel->name : null }}">
                            <span class="field__label-wrap" aria-hidden="true">
                                <span class="field__label">Titre</span>
                            </span>
                        </div>
                        {{-- <div class="field field_v1 mt-3 form_sous_titre">
                            <label for="st" class="ha-screen-reader">Sous-titre</label>
                            <input id="st" class="field__input" placeholder="" name="st" value="{{$itemactuel ? $itemactuel->st : null}}">
                            <span class="field__label-wrap" aria-hidden="true">
                            <span class="field__label">Sous-titre</span>
                            </span>
                        </div>                             --}}


                        {{-- <div class="form-group">
                        <label for="">Titre</label>
                        <input type="text" name="name" class="form-control" value="{{$itemactuel ? $itemactuel->name : null}}">
                    </div> --}}
                        {{-- <div class="form-group">
                        <label for="">Sous-titre</label>
                        <input type="text" name="st" class="form-control" value="{{$itemactuel ? $itemactuel->st : null}}">
                    </div> --}}
                    </div>
                    <style>
                        .photoEnfantImg {
                            width: 250px;
                            height: 150px;
                            border: 2px solid lightblue;
                            border-radius: 25px;
                            overflow: hidden;
                        }
                    </style>
                    @php
                        // dd($itemactuel);
                    @endphp
                    <div class="row mb-5">
                        <div class="col-md-8 mt-3 form_image">
                            <label for="">Illustation</label>
                            <input accept="image/*" name="file" type='file' id="photoEnfantInput" hidden />

                            <div id="photoEnfantImg">
                                <input type="hidden" name="imageName" id="imageName" value="{{ $itemactuel->image_id }}">
                                <i style="cursor: pointer;font-size: 200px; z-index: 4000; color: lightgray"
                                    class="fa-light fa-image logoImage {{ $new ? null : 'd-none' }}"></i>
                                <img class="dlImage {{ $new ? 'd-none' : null }}" alt="your image"
                                    src="{{ asset($itemactuel->image_name) }}" width="250px" height="150"
                                    style="cursor: pointer; z-index: 6000" />
                            </div>

                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                data-bs-target="#biblioModal">
                                bibliotheque d'image
                            </button>
                        </div>

                    </div>

                </div>

                {{-- @php
            if($itemactuel) dd($itemactuel->phrase);
            @endphp --}}
                Phrase qui apparaitra dans le cahier de réussites.
                <strong>Il convient de la rédiger au masculin</strong>.<br>
                Exemple générale : Il sait compter jusqu'à 5.
                <div id="editor3" class="mt-2 form_editeur" data-phrase="{{ $itemactuel->phrase_masculin }}"
                    data-section="" style="height: 100px; ">{!! $itemactuel && !$new ? $itemactuel->phrase : null !!}</div>
                <textarea class="d-none" name="phrase" id="phraseForm" style="width: 100%" rows="3">{!! $itemactuel && !$new ? $itemactuel->phrase : null !!}</textarea>

                <div class="alert alert-info mt-2 mb-2" role="alert">
                    La phrase équivalente au féminin va être générée. Toutefois, si vous préférez la saisir
                    vous-même, <a href="#" onclick="$('.pf').show();$('.pf').focus();" class="alert-link">cliquez
                        ici</a>.
                </div>

                <div class="pf" style="display:none">
                    <textarea name="phrase_feminin" style="width: 100%" rows="3"
                        placeholder="Ecrivez ici la même phrase au féminin...">{!! $itemactuel && !$new ? $itemactuel->phrase_feminin : null !!}</textarea>
                </div>


                <style>
                    .item {
                        flex: 1 1 0;
                        width: 0;
                        margin: 4px
                    }
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

                <div class="d-flex justify-content-between">
                    @if ($new || $duplicate)
                        <button type="submit" name="submit" value="save"
                            class="btnAction form_save">Sauvegarder</button>
                        <button type="submit" name="submit" value="save_and_select"
                            class="btnAction form_save_select">Sauvegarder et sélectionner</button>
                    @else
                        <button type="submit" name="submit" value="modif" class="btnAction">Sauvegarder</button>
                    @endif
                    <!--<button type="button" class="btnAction">Annuler</button>-->
                </div>

            </form>

        </div>

        <style>
            #biblio_container {
                height: 100vh;
                overflow: hidden;
                overflow-y: auto;
            }
        </style>



    </div>
    </div>

    <div class="modal fade" id="successCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" style="top: 70px">
            <div class="modal-content" style="height: 600px">

                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="title">Information</h1>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex flex-wrap" style="overflow: hidden; overflow-y: auto">
                    choix des options

                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="biblioModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" style="top: 70px">
            <div class="modal-content" style="height: 600px">

                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="title"></h1>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex flex-wrap" style="overflow: hidden; overflow-y: auto">
                    @foreach ($images as $image)
                        <div class="selectImage" data-id="{{ $image->id }}" data-image="{{ $image->name }}">
                            <img src="{{ asset('img/items/' . $image->name) }}" class="img-fluid"> <!-- width="100%" -->
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>


@endsection
