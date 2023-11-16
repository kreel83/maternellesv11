@extends('layouts.createAccount')

@section('content')

<div class="mt-3 mb-4 text-center">
    <h5>Etape 2 / 3 : validation de l'établissement</h5>
</div>


<div class="card mx-auto p-0" style="width: 36rem; height: 20rem">
    <div class="card-body px-5">
        <p>Etablissement trouvé :</p>
        <strong>{{ $ecole->nom_etablissement }} ({{$ecole->identifiant_de_l_etablissement }})<br>
        {{ $ecole->adresse_1 }}<br>
        {{ $ecole->adresse_3 }}
        </strong>        
    </div>

</p>
<div class="card-footer mt-5 px-5 d-flex justify-content-between align-items-center">
    <a class="d-block" href="{{ url()->previous() }}">Retour</a>
    <a href="{{ route('registration.step3', ['role' => $role, 'ecole_id' => $ecole->identifiant_de_l_etablissement, 'token' => $token]) }}" class="btnAction d-block">Suivant</a>

<div>
</div>
@endsection