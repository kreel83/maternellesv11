@extends('layouts.parentLayout')

@section('content')

<h1>Création de votre compte administrateur</h1>
<p>Bienvenue dans notre assistant !</p>

<div id="adminRegistrationForm">

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form action="{{ route('admin.createadminuser') }}" method="post">
    @csrf

        <div class="row mt-3 mb-3">
            <div class="col">
            <!-- identifiant etablissement -->
            <label for="ecole_id" class="form-label">{{ __('Identifiant de l\'établissement') }}</label>
            <input id="ecole_id" type="text" name="ecole_id" class="form-control" value="{{ $ecole_id }}" readonly required />
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
            <!-- email -->
            <label for="email" class="form-label">{{ __('Mail de l\'établissement (pour la connexion au compte et la correspondance)') }}</label>
            <input id="email" type="text" name="email" class="form-control" value="{{ $email }}" readonly required />
            </div>
        </div> 

        <div class="row mb-3">

            <!-- nom -->
            <div class="col">
                <!--<label for="name" class="form-label">{{ __('Nom') }}</label>-->
                <input placeholder="{{ __('Votre nom') }}" id="name" class="form-control block mt-1 w-full" type="text" name="name" value="{{ old('name') }}" required autofocus />
            </div>
        
            <!-- prenom -->
            <div class="col">
                <!--<label for="firstname" class="form-label">{{ __('Prénom') }}</label>-->
                <input placeholder="{{ __('Votre prénom') }}" id="prenom" class="form-control block mt-1 w-full" type="text" name="prenom" value="{{ old('prenom') }}" required autofocus />
            </div>

        </div>

        <!-- password -->
        <div class="mb-3">
            <!--<label for="password" class="form-label">{{ __('Mot de passe') }}</label>-->
            <input placeholder="{{ __('Choisissez un mot de passe') }}" id="password" class="form-control block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
        </div>

        <!-- confirm password -->
        <div class="mb-3">
            <!--<label for="password_confirmation" class="form-label">{{ __('Confirmer le mot de passe') }}</label>-->
            <input placeholder="{{ __('Confirmer le mot de passe') }}" id="password_confirmation" class="form-control block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required />
        </div>

        <div class="form-check justify-content-center mb-4">
            <input class="form-check-input me-2" type="checkbox" value="" id="agree" required />
            <label class="form-check-label" for="agree">
                J'ai lu et j'accepte les <a href="#voirCGU" data-bs-toggle="modal">conditions générales d'utilisation</a> et la <a href="#voirConfidentialite" data-bs-toggle="modal">politique de confidentialité</a>
            </label>
        </div>

        <div class="text-center">
            <button id="btnsubmit" class="btn btn-primary ml-3">
                {{ __('Créer le compte') }}
            </button>
        </div>

        <p class="text-center mt-4"><a href="/">Annuler</a></p>

    </form>

</div>

<div class="modal" id="voirCGU" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Conditions générales d'utilisation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Voici les conditions d'utilisation du service <strong>Les Maternelles</strong> :</p>
                <p>...</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="voirConfidentialite" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Politique de confidentialité</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Voici notre politique de confidentialité concernant le service <strong>Les Maternelles</strong> :</p>
                <p>...</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>


@endsection
