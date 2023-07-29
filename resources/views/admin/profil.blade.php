@extends('layouts.admin', ['titre' => 'Bienvenue sur votre espace administration', 'menu' => 'monprofil'])

@section('content')

<h1>Mon profil</h1>

@if(!empty(session('result')))
    <div class="alert alert-success">Votre profil a été mis à jour.</div>
@endif

<!-- Validation Errors -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.saveprofile') }}" method="post">
@csrf

    <div class="mb-3">
        <div class="form-check">
            <input class="form-check-input" type="radio" id="directeur0" name="directeur"  value="0" {{$user->directeur == 0 ? 'checked' : null}}>
            <label class="form-check-label" for="directeur0">
                Directeur
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" id="directeur1" name="directeur" value="1" {{$user->directeur == 1 ? 'checked' : null}}>
            <label class="form-check-label" for="directeur1">
                Directrice
            </label>
        </div>
    </div>

    <div class="mb-3">
        <label for="nom" class="form-label">Votre nom</label>
        <input type="text" class="form-control" id="nom" name="nom" value="{{$user->name}}">

    </div>

    <div class="mb-3">
        <label for="prenom" class="form-label">Votre prénom</label>
        <input type="text" class="form-control" id="prenom" name="prenom" value="{{$user->prenom}}">
    </div>

    <div class="mb-3">
        <label for="mobile" class="form-label">Téléphone mobile (facultatif)</label>
        <input type="text" class="form-control" id="mobile" name="mobile" aria-describedby="mobileHelp" value="{{$user->mobile}}">
        <div id="mobileHelp" class="form-text">Information confidentielle qui ne sera jamais partagée avec un tiers. Peut servir à vous contacter plus rapidement si nécessaire.</div>
    </div>

    <div class="mb-1">
        Identifiant de votre établissement : <strong>{{$user->ecole_id}}</strong>
    </div>

    <div class="mb-3">
        <ul>
            <li>{{ $adresseEcole }}</li>
            <li>Adresse e-mail de contact : <strong>{{$user->email}}</strong></li>
            <li>Téléphone professionnel : <strong>{{ $telephoneEcole }}</li>
        </ul>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Enregistrer les modifications</button>

</form>

<div class="mt-4">
    <a href="{{ route('admin.index') }}">Annuler</a>
</div>

@endsection
