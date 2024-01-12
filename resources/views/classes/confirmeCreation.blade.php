@extends('layouts.mainMenu2',['titre' => 'Ma classe', 'menu' => 'createClasse'])

@php
    // dd($resultats);
@endphp

@section('content')

<div class="mt-5 container">

    <div class="card mx-auto w-75"  style="border: none; border-radius: 40px; margin-top: 100px">
        <div class="ms-3" style="border: none; border-radius: 40px">
            <div class="d-flex justify-content-between pt-2" style="color: var(--main-color)">
                <h5>{{ $title }} -  2/2</h5>
            </div>
        </div>
        <div class="card-body">
            {{-- <h5 class="card-title mb-3">Etape 2 / 3 : validation de l'établissement</h5> --}}
            <div class="alert alert-success mb-3" style="background-color: var(--main-color); color: white; border: none">
                <div class="mb-3">
                    Etablissement trouvé :
                </div>
                <strong>{{ $ecole->nom_etablissement }} ({{$ecole->identifiant_de_l_etablissement }})<br>
                {{ $ecole->adresse_1 }}<br>
                {{ $ecole->adresse_3 }}
                </strong>
            </div>
            <div class="mb-3">
                Nom de ma classe : <strong>{{ $description }}</strong>
            </div>
            <div class="mb-3">
                Section(s) : <strong>{{ $sectionTexte }}</strong>
            </div>
        </div>
        <div class="pb-3 pt-3 px-5">
            <div class="d-flex justify-content-between align-items-center">
                <a class="btnAction inverse"  href="{{ route('createclasse') }}">Annuler</a>
                <form action="{{ route('saveNewClasse') }}" method="post">
                    @csrf
                    <input type="hidden" name="classe_id" value="{{ $classe_id }}">
                    <input type="hidden" name="ecole_id" value="{{ $ecole->identifiant_de_l_etablissement }}">
                    <input type="hidden" name="code_academie" value="{{ $ecole->code_academie }}">
                    <input type="hidden" name="description" value="{{ $description }}">
                    <input type="hidden" name="section" value="{{ $section }}">
                    <button class="btnAction">{{ $classe_id == 'new' ? 'Créer la classe' : 'Sauvegarder'}}</button>
                </form>
            </div>
        <div>      

    </div>

</div>

@endsection
