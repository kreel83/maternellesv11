@extends('layouts.parentLayout')

@section('content')
    
<p class="mt-3 text-center h1">Votre fonction au sein de l'établissement</p>

<div class="row">
    <div class="col-sm-6 mb-3 mb-sm-0">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Directrice / Directeur</h5>
          <p class="card-text">Avec ou sans fonction d'enseignement.</p>
          <a href="{{ route('registration.step1', ['role' => 'admin']) }}" class="btn btn-primary">Je m'inscrit</a>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Enseignant(e)</h5>
          <p class="card-text">Utilisation du service pour gérer votre classe de maternelle.</p>
          <a href="{{ route('registration.step1', ['role' => 'user']) }}" class="btn btn-primary">Je m'inscrit</a>
        </div>
      </div>
    </div>
</div>

<!--<p class="text-center mt-4"><a href="/">Accueil</a></p>-->

@endsection  