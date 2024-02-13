@extends('layouts.template1', ['titre' => 'Mon compte '.config('app.name')])

@section('content')

@include('include.display_msg_error')
      
{{-- <div class="card mx-auto p-5" style="width: auto; height: auto"> --}}
<form action="{{ route('registration.newaccount.post') }}" method="POST">
    @csrf

<div class="card mx-auto">
    <div class="card-header">
        <div class="d-flex justify-content-between pt-2">
            <h5>Création de mon compte {{ config('app.name') }}</h5>
        </div>
    </div>
    <div class="card-body">

            <div class="mt-3 mb-3">
                <label for="email" class="form-label">Votre adresse e-mail professionnelle</label>
                <input type="email" id="email" name="email" class="form-control block w-full" value="{{ old('email') }}" placeholder="" required />
            </div>


            <div class="row mb-3">

                <div class="col-12 col-xl-2 mt-2">
                    <label for="civilite" class="form-label">Civilité</label><br>
                    <select class="form-select form-select" name="civilite" id="civilite" required>
                        <option value=""></option>
                        <option value="Mme" {{ old('civilite') == 'Mme' ? 'selected' : null }}>Madame</option>
                        <option value="M." {{ old('civilite') == 'M.' ? 'selected' : null }}>Monsieur</option>
                    </select>
                </div>

                <div class="col-12 col-xl-5 mt-2">
                    <label for="prenom" class="form-label">Votre prénom</label>
                    <input placeholder="" id="prenom" class="form-control block w-full" type="text" name="prenom" value="{{ old('prenom') }}" required />
                </div>

                <div class="col-12 col-xl-5 mt-2">
                    <label for="name" class="form-label">Votre nom</label>
                    <input placeholder="" id="name" class="form-control block w-full" type="text" name="name" value="{{ old('name') }}" required  />
                </div>

            </div>

            <div class="row mb-3">

                <div class="col-12 col-xl-6 mt-2 mb-2">
                    <label for="password" class="form-label">Choisissez un mot de passe (minimum 8 caractères)</label>
                    <input placeholder="Mot de passe" id="password" class="form-control block w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />
                </div>

                <div class="col-12 col-xl-6 mt-2">
                    <label for="password_confirmation" class="form-label">Veuillez confirmer le mot de passe</label>
                    <input placeholder="Confirmation du mot de passe" id="password_confirmation" class="form-control block w-full"
                                    type="password"
                                    name="password_confirmation" required />
                </div>

            </div>

            <div class="form-check justify-content-center">
                <input class="form-check-input me-2" type="checkbox" value="" id="agree" required />
                <label class="form-check-label" for="agree">
                    J'ai lu et j'accepte les <a href="#voirCGU" data-bs-toggle="modal">conditions générales d'utilisation</a> et notre <a href="#voirConfidentialite" data-bs-toggle="modal">politique de confidentialité</a>.
                </label>
            </div>

            {{-- <div class="d-flex justify-content-center">
                <button class="btnAction mx-0">
                    {{ __('Créer le compte') }}
                </button>
            </div> --}}
    </div>
    <div class="card-footer pb-3">
        <div class="d-flex justify-content-center align-items-center">
            {{-- <a class="d-block"  href="{{ route('registration.start') }}">Annuler</a> --}}
            <button class="btnAction mx-0">
                {{ __('Créer le compte') }}
            </button>
        </div>
    <div>
</div>
</form>

<div class="modal" id="voirCGU" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Conditions générales de vente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('include.conditions')
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
                @include('include.confidentialite')
            </div>
            <div class="modal-footer">
                <button type="button" class="btnAction" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

      
    
@endsection