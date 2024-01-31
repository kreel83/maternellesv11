@extends('layouts.template1', ['titre' => 'Mon compte '.config('app.name')])

@section('content')

{{-- <div class="mt-3 mb-4 text-center">
    <h5>Etape 2 / 3 : validation de l'établissement</h5>
</div> --}}

{{-- style="width: 36rem; height: 20rem" --}}
<div class="card mx-auto w-75">
    <div class="card-header">
        <div class="d-flex justify-content-between pt-2">
            <h5>Création de mon compte {{ config('app.name') }}</h5>
            <h5><span class="badge bg-info">{{ $role == 'admin' ? 'Administrateur' : 'Enseignant' }}</span></h5>
        </div>
    </div>
    <div class="card-body">
        <h5 class="card-title mb-3">Etape 2 / 3 : validation de l'établissement</h5>
        <div class="alert alert-success">
        <div class="mb-3">
            Etablissement trouvé :
        </div>
        <strong>{{ $ecole->nom_etablissement }} ({{$ecole->identifiant_de_l_etablissement }})<br>
        {{ $ecole->adresse_1 }}<br>
        {{ $ecole->adresse_3 }}
        </strong>
        </div>
    </div>
    <div class="card-footer pb-3">
        <div class="d-flex justify-content-between align-items-center">
            <a class="d-block"  href="{{ route('registration.start') }}">Annuler</a>
            <a href="{{ route('registration.step3', ['role' => $role, 'ecole_id' => $ecole->identifiant_de_l_etablissement, 'token' => $token]) }}" class="btnAction d-block">Suivant</a>
        </div>
    <div>
</div>

@endsection