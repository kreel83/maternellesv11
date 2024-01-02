@extends('layouts.template1', ['titre' => 'Mon compte '.env('APP_NAME')])

@section('content')

{{-- <div class="card mx-auto p-0 mt-5" style="width: auto; height: auto"> --}}
<div class="card mx-auto w-75">
    <div class="card-header">
        <div class="d-flex justify-content-between pt-2">
            <h5>Création de mon compte {{ env('APP_NAME' )}}</h5>
            <h5><span class="badge bg-info">{{ session('role') == 'admin' ? 'Administrateur' : 'Enseignant' }}</span></h5>
        </div>
    </div>
    <div class="card-body">
        <h5 class="card-title mb-3">Votre compte utilisateur a été crée !</h5>

        <div class="mb-3">
        Un message de confirmation a été envoyé à l'adresse e-mail : <strong>{{ session('email') }}</strong>
        </div>
        
        <div class="mb-3">
        Veuillez cliquer sur le lien disponible dans ce message afin de confirmer votre inscription.
        </div>
        
        {{-- <p><strong>Attention : ce lien a une validité de 30 minutes.</strong></p> --}}
        
        <div class="mb-3">
        Si vous n'avez pas reçu le message de confirmation vous pouvez :
        </div>

        <ul>
            <li>Vérifier sa présence dans le dossier 'Spam' ou 'Courrier indésirable' de votre messagerie.</li>
            <li><a href="{{ route('vitrine.contact') }}">Obtenir de l'aide via notre formulaire de contact</a></li>
        </ul>
        
        
    </div>
    <div class="card-footer pb-3">
        <a href="{{ route('login') }}" class="btnAction mx-auto">Se connecter</a>

    </div>
</div>

    
@endsection