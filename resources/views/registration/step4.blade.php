@extends('layouts.createAccount')

@section('content')

<div class="mt-3">

    <h4>Votre compte utilisateur a été crée !</h4>

    <p>Un message de confirmation a été envoyé à l'adresse suivante : <strong>{{ session('email') }}</strong></p>

    <p>
        Veuillez cliquer sur le lien disponible dans ce message afin de confirmer votre inscription sur le portail. <br>
        <strong>Ce lien a une validité de 30 minutes.</strong>
    </p>

    <p>Si vous n'avez pas reçu le message de confirmation vous pouvez :</p>

    <p>- Vérifier sa présence dans le dossier 'Spam' ou 'Courrier indésirable' de votre messagerie.</p>
    <p>- <a href="{{ route('vitrine.contact') }}">Obtenir de l'aide via notre formulaire de contact</a></p>    

</div>

<a href="{{ route('login') }}" class="btn btn-primary">Se connecter</a>
    
@endsection