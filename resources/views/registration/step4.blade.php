@extends('layouts.parentLayout')

@section('content')

<h1 class="mt-3">Création de votre compte sur Les Maternelles</h1>

<div class="mt-3">

    <h4>Votre compte utilisateur a été crée !</h4>

    <p>Un message de confirmation a été envoyé à l'adresse suivante : <strong>{{ $email }}</strong></p>

    <p>
        Veuillez cliquer sur le lien disponible dans ce message afin de confirmer votre inscription sur le portail. <br>
        <strong>Ce lien a une validité de 30 minutes.</strong>
    </p>
        <p><strong>Attention :</strong> tant que votre inscription n'est pas confirmée, vous ne pouvez pas accéder à votre compte utilisateur.</p>


    <p>Si vous n'avez pas reçu le message de confirmation vous pouvez :</p>

    <p>- Vérifier sa présence dans le dossier 'Spam' ou 'Courrier indésirable' de votre messagerie.</p>
    <p>- <a href="#">Obtenir de l'aide via notre formulaire de contact</a></p>    

</div>

<a href="/login" class="btn btn-primary">Se connecter</a>
    
@endsection