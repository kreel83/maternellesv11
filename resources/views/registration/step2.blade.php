@extends('layouts.parentLayout')

@section('content')


<h1 class="mt-3">Création de votre compte sur Les Maternelles</h1>
<p>Bienvenue dans notre assistant !</p>
<p>Etape 2 / 3</p>

<p>Etablissement trouvé :</p>

<p>
<strong>{{ $ecole->nom_etablissement }} ({{$ecole->identifiant_de_l_etablissement }})<br>
{{ $ecole->adresse_1 }}<br>
{{ $ecole->adresse_3 }}
</strong>
</p>

<p class="mt-4"><a href="{{ route('registration.step3', ['role' => $role, 'ecole_id' => $ecole->identifiant_de_l_etablissement, 'token' => $token]) }}" class="btn btn-primary">Suivant</a></p>

<p class="mt-4"><a href="{{ route('registration.start') }}">Annuler</a></p>

{{--
<!-- Validation Errors -->
<x-auth-validation-errors class="mb-4" :errors="$errors" />

<form action="{{ route('registration.step2.post') }}" method="post">
@csrf

    <input type="hidden" name="role" value="{{ $role }}">
    <input type="hidden" name="ecole_id" value="{{ $ecole->identifiant_de_l_etablissement }}">

    <div class="">
        <button id="btnsubmit" class="btn btn-primary ml-3">
            {{ __('Suivant') }}
        </button>
    </div>

    <p class="mt-4"><a href="{{ route('registration.start') }}">Annuler</a></p>

</form>
--}}

@endsection