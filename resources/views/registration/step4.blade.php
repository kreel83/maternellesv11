@extends('layouts.createAccount')

@section('content')

<div class="card mx-auto p-0 mt-5" style="width: auto; height: auto">

    <div class="card-body text-center">

        <h4>Votre compte utilisateur a été crée !</h4>
        
        <p>Un message de confirmation a été envoyé à l'adresse suivante : <strong>{{ session('email') }}</strong>
        <br>
        Veuillez cliquer sur le lien disponible dans ce message afin de confirmer votre inscription.<p>
        
        <p><strong>Attention : ce lien a une validité de 30 minutes.</strong></p>
        
        <p>Si vous n'avez pas reçu le message de confirmation vous pouvez :</p>
        
        <p>- Vérifier sa présence dans le dossier 'Spam' ou 'Courrier indésirable' de votre messagerie.</p>
        <p>- <a href="{{ route('vitrine.contact') }}">Obtenir de l'aide via notre formulaire de contact</a></p>    
    </div>
    <div class="card-footer">
        <a href="{{ route('login') }}" class="btnAction mx-auto">Se connecter</a>

    </div>
</div>

    
@endsection