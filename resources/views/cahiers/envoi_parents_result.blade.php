@extends('layouts.mainMenu', ['title' => 'Mon cahier de réussite', 'menu' => 'cahier'])

@section('content')

<h1>Envoi du cahier de réussite</h1>

<div class="alert alert-success" role="alert">
    <h4 class="alert-heading">Envoi terminé</h4>
    <hr>
    Un courrier électronique contenant un lien pour télécharger le cahier de réussite de leur enfant a été envoyé à tous les parents.
</div>

@endsection