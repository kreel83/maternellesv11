@extends('layouts.mainMenu', ['title' => 'Mon cahier de réussite', 'menu' => 'cahier'])

@section('content')

<h1>Envoi du cahier de réussite</h1>

<p>Vous allez envoyer un courrier électronique contenant un lien pour télécharger le cahier de réussite à tous les parents des élèves de votre classe.</p>

@if (count($badEmails) > 0)
    <div class="alert alert-warning" role="alert">
        <h4 class="alert-heading">Avertissement</h4>
        <p>Les élèves suivants n'ont pas d'adresse email valide :</p>
        <hr>
        {{ implode(', ',$badEmails) }}.
    </div>
@else
    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Vérification complète</h4>
        <hr>
        Tous les élèves ont une adresse de courrier électronique valide.
    </div>
@endif

<p>Merci de confirmer cette action en tapant le mot <b>VALIDER</b> dans le champ ci-dessous :</p>

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

<form action="{{ route('envoiCahier.post') }}" method="post">
@csrf

<div class="row g-3 align-items-center">
    <div class="col-auto mb-3">
        <input type="text" class="form-control" name="valider">
    </div>
</div>

<input type="submit" class="btn btn-primary" value="Confirmer">

</form>

@endsection