@extends('layouts.admin', ['titre' => 'Bienvenue sur votre espace administration', 'menu' => 'monprofil'])

@section('content')

<div class="row mb-3">
    <div class="col">
        Identifiant de votre établissement : <strong>{{$user->ecole_id}}</strong><br>
        {{ $adresseEcole }}
    </div>
    <div class="col">
        Adresse e-mail de contact : <strong>{{$user->email}}</strong><br>
        Téléphone professionnel : <strong>{{ $telephoneEcole }}
    </div>
</div>

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

<div class="mb-4">

    <form action="{{ route('admin.saveprofile') }}" method="post">
    @csrf

        <div class="mt-3 mb-3">
            <h4>Informations de contact</h4>
        </div>

        <div class="mt-3 mb-3">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="directeur0" name="directeur"  value="0" {{$user->directeur == 0 ? 'checked' : null}}>
                <label class="form-check-label" for="directeur0">Directeur</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="directeur1" name="directeur" value="1" {{$user->directeur == 1 ? 'checked' : null}}>
                <label class="form-check-label" for="directeur1">Directrice</label>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label for="nom" class="form-label">Votre nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="{{$user->name}}">
            </div>
            <div class="col">
                <label for="prenom" class="form-label">Votre prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" value="{{$user->prenom}}">
            </div>
        </div>

        <div class="mb-0">
            <label for="mobile" class="form-label">Téléphone mobile (facultatif)</label>
            <input type="text" class="form-control" id="mobile" name="mobile" aria-describedby="mobileHelp" value="{{$user->mobile}}">
            <div id="mobileHelp" class="form-text">Information confidentielle qui ne sera jamais partagée avec un tiers. Peut servir à vous contacter plus rapidement si nécessaire.</div>
        </div>

        {{--
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
        --}}

        <button type="submit" class="btn btn-primary mt-3">Modifier les informations de contact</button>

    </form>

</div>

<div class="mt-5">

    <form action="{{ route('admin.sauverLeMotDePasse') }}" method="post">
    @csrf

        <div class="mt-3 mb-3">
            <h4>Mot de passe de connexion</h4>
        </div>

        <!-- password -->
        <div class="mb-3">
            <label for="password" class="form-label">Nouveau mot de passe</label>
            <input placeholder="{{ __('Mot de passe') }}" id="password" class="form-control block mt-0 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
        </div>

        <!-- confirm password -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmez le nouveau mot de passe</label>
            <input placeholder="{{ __('Confirmer le mot de passe') }}" id="password_confirmation" class="form-control block mt-0 w-full"
                            type="password"
                            name="password_confirmation" required />
        </div>

        <button type="submit" class="btn btn-primary mt-1">Modifier le mot de passe</button>

    </form>

</div>

@endsection
