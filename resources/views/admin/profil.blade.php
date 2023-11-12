@extends('layouts.admin', ['titre' => 'Bienvenue sur votre espace administration', 'menu' => 'monprofil'])

@section('content')

<div class="row mb-3">
    <div class="col">
        Identifiant de votre établissement : <strong>{{ $user->ecole_identifiant_de_l_etablissement }}</strong><br>
        {{ $adresseEcole }}
    </div>
    <div class="col">
        Adresse e-mail de contact : <strong>{{ $user->email }}</strong><br>
        Téléphone professionnel : <strong>{{ $telephoneEcole }}
    </div>
</div>

@include('include.display_msg_error')

<div class="mb-4">

    <form action="{{ route('admin.saveprofile') }}" method="post">
    @csrf

        <div class="mt-3 mb-3">
            <h4>Informations de contact</h4>
        </div>

        <div class="d-flex align-items-start mb-3">
            <div class="me-3">
                <label for="civilite" class="form-label">Civilité</label><br>
                <select class="form-select form-select-sm" name="civilite" id="civilite">
                    <option value="MME" {{$user->civilite == 'MME' ? 'selected' : null}}>Madame</option>
                    <option value="M" {{$user->civilite == 'M' ? 'selected' : null}}>Monsieur</option>
                </select>
            </div>
            <div class="me-3">
                <label for="nom" class="form-label">Votre nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="{{$user->name}}">
            </div>
            <div class="me-3">
                <label for="prenom" class="form-label">Votre prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" value="{{$user->prenom}}">
            </div>
            <div class="me-3">
                <label for="mobile" class="form-label">Téléphone mobile (facultatif)</label>
                <input type="text" class="form-control" id="mobile" name="mobile" aria-describedby="mobileHelp" value="{{$user->mobile}}">
                {{-- <div id="mobileHelp" class="form-text">Information confidentielle qui ne sera jamais partagée avec un tiers. Peut servir à vous contacter plus rapidement si nécessaire.</div> --}}
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Modifier les informations de contact</button>

    </form>

</div>

<div class="mt-4">

    <form action="{{ route('admin.sauverLeMotDePasse') }}" method="post">
    @csrf

        <div class="mt-3 mb-3">
            <h4>Mot de passe de connexion</h4>
        </div>

        {{-- Mot de passe --}}
        <div class="mb-3">
            <label for="password" class="form-label">Nouveau mot de passe</label>
            <input placeholder="{{ __('Mot de passe') }}" id="password" class="form-control block mt-0 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
        </div>

        {{-- Confirmation du mot de passe --}}
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
