@extends('layouts.mainMenu2',['titre' => 'Ma classe', 'menu' => 'createClasse'])

@php
    // dd($resultats);
@endphp

@section('content')



{{-- <div class="input-group mb-2">
    <span class="input-group-text" id="basic-addon1"><i class="fa-sharp fa-solid fa-envelope"></i></span>
    <input type="email" class="form-control form-control-sm" id="mail4_form" name="mail4" id="mail4" value="{{ old('mail4') ?? $eleve['mail4'] }}" placeholder="Mail supplementaire">
</div> --}}

<div class="mt-5 container" id="creation_classe">

    <div class="card mx-auto w-75" style="border: none; border-radius: 40px; margin-top: 100px">
        <div class="ms-3" style="border: none; border-radius: 40px">
            <div class="d-flex justify-content-between pt-2">
                <h5>{{ $title }} - Etape 1/2</h5>
            </div>
        </div>
        <div class="card-body">

            {{-- <h5 class="card-title mb-3">Vous pouvez créer plusieurs classes si besoin</h5> --}}

            <form action="{{ route('confirmeClasse') }}" method="post">
            @csrf

            @include('include.display_msg_error')

            <input type="hidden" name="classe_id" value="{{ isset($classe) ? $classe->id : 'new' }}">

            <div class="row">
                <div class="col">
                    <label for="ecole_id" class="form-label">Identifiant de votre établissement :</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-school"></i></span>
                        <input type="text" class="form-control codeIdentifiantEtablissement" id="ecole_id" name="ecole_id" value="{{ old('ecole_id', isset($classe) ? $classe->ecole_identifiant_de_l_etablissement : '') }}" aria-describedby="codeHelp">
                    </div>
                    <small id="codeHelp" class="form-text mb-4">Celui-ci se compose de 7 chiffres et une lettre.</small>
                </div>
                <div class="col">
                    <label for="register_search" class="form-label">Recherche d'établissement par code postal :</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
                        <input type="text" class="form-control me-2" id="register_search" name="register_search">
                    </div>
                    <a class="btnAction boutonRechercheEtablissementParCP">Rechercher</a>
                </div>
            </div>

            <div id="register_afficheLaListeDesEtablissements" class="mt-3 mb-3" style="display:none">
                <div class="p-4" style="background:var(--second-color); border-radius: 8px">
                <select class="form-select" id="register_listeDesEcoles"></select>
                </div>
            </div>

            <div class="mb-3">
                <label for="description">Nom de la classe</label>
                <input type="text" class="form-control" id="description" name="description" value="{{ old('description', isset($classe) ? $classe->description : '') }}"">
            </div>

            <div class="mb-2">
                Vous pouvez indiquer la ou les sections de votre classe (facultatif)
            </div>

            <div class="mb-3">
                <div class="form-check form-check-inline">
                    {{-- <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="ps" name="section[]" @checked(in_array('ps', old('section', [])))> --}}
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="ps" name="section[]" @checked(in_array('ps', old('section', isset($classe) ? ($classe->ps == 1) ? array_fill(0, 1, 'ps') : [] : [])))>
                    <label class="form-check-label" for="inlineCheckbox1">Petite section</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="ms" name="section[]" @checked(in_array('ms', old('section', isset($classe) ? ($classe->ms == 1) ? array_fill(0, 1, 'ms') : [] : [])))>
                    <label class="form-check-label" for="inlineCheckbox2">Moyenne section</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="gs" name="section[]" @checked(in_array('gs', old('section', isset($classe) ? ($classe->gs == 1) ? array_fill(0, 1, 'gs') : [] : [])))>
                    <label class="form-check-label" for="inlineCheckbox3">Grande section</label>
                </div>
            </div>
            
            <button class="btnAction" type="submit">Continuer</button>
            
            </form>

        </div>        

    </div>


</div>

@endsection
