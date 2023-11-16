@extends('layouts.createAccount')

@section('content')

@include('include.display_msg_error')
      
<div class="mt-3 mb-4">
    <h5 class="text-center">Etape 3 / 3 : informations personnelles</h5>
</div>


<div class="card mx-auto p-5" style="width: auto; height: auto">
<form action="{{ route('registration.step3.post') }}" method="POST">
@csrf

    <input type="hidden" name="role" value="{{ $role }}">
    <input type="hidden" name="academique" value="{{ $academique }}">
    <input type="hidden" name="domain" value="{{ $domain }}">
    <input type="hidden" name="ecole_id" value="{{ $ecole_id }}">
    <input type="hidden" name="token" value="{{ $token }}">

    <!-- email -->
    @if($role == 'admin')
        <input type="hidden" name="email" value="{{ $email }}">
        <div class="mb-3">
            Adresse mail : {{ $email }}
        </div>
    @else
        @if($academique)
            <p>L'adresse de courrier électronique de votre établissement ({{$email}}) est sur le domaine académique : <strong>{{ $domain }}</strong></p>
            <p><strong>Nous vous recommandons fortement d'utiliser votre adresse email professionnelle crée par le ministère de l'éducation nationale.</strong></p>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="emailondomain" id="emailondomain1" value="1">
                <label class="form-check-label" for="emailondomain1">
                J'ai une adresse email sur ce domaine académique (exemple : mon_prenom.mon_nom{{'@'.$domain}})
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="emailondomain" id="emailondomain2" value="0">
                <label class="form-check-label" for="emailondomain2">
                J'utilise un autre service de courrier électronique (Gmail, Yahoo, Hotmail...)
                </label>
            </div>
        @else
            <input type="hidden" name="emailondomain" value="0">
        @endif
        <div class="mt-3 mb-3">
            <label for="email" class="form-label">Votre adresse e-mail professionnelle</label>
            <input type="email" id="email" name="email" class="form-control block w-full" value="{{ old('email') }}" placeholder="" required />
        </div>
    @endif

    <div class="row mt-3 mb-4">

        <div class="col-12 col-xl-2">
            <label for="civilite" class="form-label">Civilité</label><br>
            <select class="form-select form-select-sm" name="civilite" id="civilite" required>
                <option value=""></option>
                <option value="Mme" {{ old('civilite') == 'Mme' ? 'selected' : null }}>Madame</option>
                <option value="M." {{ old('civilite') == 'M.' ? 'selected' : null }}>Monsieur</option>
            </select>
        </div>

        <div class="col-12 col-xl-5">
            <label for="name" class="form-label">Votre nom</label>
            <input placeholder="" id="name" class="form-control block w-full" type="text" name="name" value="{{ old('name') }}" required  />
        </div>
    
        <div class="col-12 col-xl-5">
            <label for="prenom" class="form-label">Votre prénom</label>
            <input placeholder="" id="prenom" class="form-control block w-full" type="text" name="prenom" value="{{ old('prenom') }}" required />
        </div>

    </div>

    <div class="row mt-3 mb-4">

        <div class="col-12 col-xl-6">
            <label for="password" class="form-label">Choisissez un mot de passe (minimum 8 caractères)</label>
            <input placeholder="Mot de passe" id="password" class="form-control block w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
        </div>

        <div class="col-12 col-xl-6">
            <label for="password_confirmation" class="form-label">Veuillez confirmer le mot de passe</label>
            <input placeholder="Confirmation du mot de passe" id="password_confirmation" class="form-control block w-full"
                            type="password"
                            name="password_confirmation" required />
        </div>

    </div>

    <div class="form-check justify-content-center mb-4">
        <input class="form-check-input me-2" type="checkbox" value="" id="agree" required />
        <label class="form-check-label" for="agree">
            J'ai lu et j'accepte les <a href="#voirCGU" data-bs-toggle="modal">conditions générales d'utilisation</a> et notre <a href="#voirConfidentialite" data-bs-toggle="modal">politique de confidentialité</a>
        </label>
    </div>

    <div class="d-flex justify-content-center">
        <button class="btnAction mx-0">
            {{ __('Créer le compte') }}
        </button>
    </div>

</form>

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
                <button type="button" class="btnAction" data-bs-dismiss="modal">Fermer</button>
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
                <button type="button" class="btnAction" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
</div>
      
    
@endsection