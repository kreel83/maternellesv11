@extends('layouts.createAccount')

@section('content')

<div class="row">
  <div class="d-inline-flex p-0">
    <div class="card" style="width: 18rem;">
      <img src="{{asset('img/account/compte-enseignant.jpg')}}" class="card-img-top img-fluid" alt="Création d'un compte enseignant">
      <div class="card-body">
        <h5 class="card-title">Enseignant(e)</h5>
        <p class="card-text">Gestion de votre classe de maternelle et des cahiers de réussite.</p>
        <a href="{{ route('registration.step1', ['role' => 'user']) }}" class="btn btn-primary">Je m'inscrit</a>
      </div>
    </div>
    <div class="card" style="width: 18rem;">
      <img src="{{asset('img/account/compte-admin.jpg')}}" class="card-img-top img-fluid" alt="Création d'un compte directeur">
      <div class="card-body">
        <h5 class="card-title">Directeur / Directrice</h5>
        <p class="card-text">Administration des licences pour les enseignant(e)s de votre établissement.</p>
        <a href="{{ route('registration.step1', ['role' => 'admin']) }}" class="btn btn-primary">Je m'inscrit</a>
      </div>
    </div>
  </div>
</div>

@endsection  