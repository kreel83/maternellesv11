@extends('layouts.parentLayout')

@section('content')    
      
<h1 class="mt-3">Création de votre compte sur Les Maternelles</h1>
<p>Bienvenue dans notre assistant !</p>
<p>Etape 3 / 3</p>

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

<form action="{{ route('registration.step3.post') }}" method="POST">
@csrf

    <input type="hidden" name="role" value="{{ $role }}">
    <input type="hidden" name="ecole_id" value="{{ $ecole_id }}">
    <input type="hidden" name="token" value="{{ $token }}">

    <!-- email -->
    @if($role == 'admin')
        <input type="hidden" name="email" value="{{ $email }}">
        <div class="mb-3">
            Adresse mail : {{ $email }}
        </div>
    @else
        <div class="mb-3">
            <!--<label for="email" class="form-label">{{ __('Email') }}</label>-->
            <input type="email" id="email" name="email" class="form-control block mt-1 w-full" value="{{ old('email') }}" placeholder="{{ __('Email') }}" required autofocus />
        </div>
    @endif

    <div class="row mt-3 mb-3">

        <!-- nom -->
        <div class="col">
            <!--<label for="name" class="form-label">{{ __('Nom') }}</label>-->
            <input placeholder="{{ __('Nom') }}" id="name" class="form-control block mt-1 w-full" type="text" name="name" value="{{ old('name') }}" required  />
        </div>
    
        <!-- prenom -->
        <div class="col">
            <!--<label for="firstname" class="form-label">{{ __('Prénom') }}</label>-->
            <input placeholder="{{ __('Prénom') }}" id="prenom" class="form-control block mt-1 w-full" type="text" name="prenom" value="{{ old('prenom') }}" required />
        </div>

    </div>

    <!-- password -->
    <div class="mb-3">
        <!--<label for="password" class="form-label">{{ __('Mot de passe') }}</label>-->
        <input placeholder="{{ __('Mot de passe') }}" id="password" class="form-control block mt-1 w-full"
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

    <div class="form-check justify-content-center mb-3">
        <input class="form-check-input me-2" type="checkbox" value="" id="agree" required />
        <label class="form-check-label" for="agree">
            J'ai lu et j'accepte les <a href="#voirCGU" data-bs-toggle="modal">conditions générales d'utilisation</a> et notre <a href="#voirConfidentialite" data-bs-toggle="modal">politique de confidentialité</a>
        </label>
    </div>

    <div class="text-center">
        <button class="btn btn-primary ml-3">
            {{ __('Créer le compte') }}
        </button>
    </div>

</form>

<p class="text-center mt-4"><a href="{{ route('registration.start') }}">Annuler</a></p>

{{--
<p class="text-center mt-4"><a href="{{ route('registration.start') }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
</svg> Annuler</a></p>
--}}        

    
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