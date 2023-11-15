@extends('layouts.createAccount')

@section('content')

@include('include.display_msg_error')

<div class="d-flex flex-column flex-xl-row align-items-center justify-content-between w-100 text-center">

    <div class="card" style="width: 36rem; height: 40rem">
      <img height="400px" width="90%" src="{{asset('img/account/compte-enseignant.jpg')}}" class="mx-auto"  alt="Création d'un compte enseignant">
      <div class="card-body">
        <h5 class="card-title">Enseignant(e)</h5>
        <p class="card-text">Gestion de votre classe de maternelle <br> et des cahiers de réussite.</p>
        <a href="{{ route('registration.step1', ['role' => 'user']) }}" class="btnAction mx-auto d-block w-50 mx-auto d-block w-50">Je m'inscris</a>
      </div>
    </div>

    <div class="card" style="width: 36rem; height: 40rem">
      <img height="400px" width="90%" src="{{asset('img/account/compte-admin.jpg')}}" class="mx-auto" alt="Création d'un compte directeur">
      <div class="card-body">
        <h5 class="card-title">Directeur / Directrice</h5>
        <p class="card-text">Administration des licences pour les enseignant(e)s de votre établissement.</p>
        <a href="{{ route('registration.step1', ['role' => 'admin']) }}" class="btnAction mx-auto d-block w-50">Je m'inscris</a>
      </div>
    </div>
 
</div>

@endsection  