<?
use Illuminate\Support\Facades\Auth;
?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Ma maternelle</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        @vite(['resources/scss/app.scss', 'resources/js/app.js'])

        <link href="{{asset('fontawesome/css/all.css')}}" rel="stylesheet">


        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>


<nav class="navbar navbar-expand-xl  fixed-top" aria-label="Sixth navbar example" style="background-color: #E7FCFF">
    <div class="container-fluid" style="padding: 0 20rem">
      <a class="navbar-brand me-5" href="{{route('depart')}}">Les maternelles</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample06" aria-controls="navbarsExample06" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse pe-5" id="navbarsExample06">
        <ul class="navbar-nav me-auto mb-2 mb-xl-0">
          <li class="nav-item me-3 fw-bolder">
            <a class="nav-link" aria-current="page" href="{{route('home')}}" style="color: var(--vert)">Accueil</a>
          </li>
          <li class="nav-item me-3 fw-bolder">
            <a class="nav-link" aria-current="page" href="{{route('enfants')}}"  style="color: var(--orange)">Ma classe</a>
          </li>

          <li class="nav-item me-3 fw-bolder">
            <a class="nav-link" href="{{route('calendrier')}}"  style="color: var(--rouge)">Calendrier</a>
          </li>
          <li class="nav-item dropdown me-3 fw-bolder">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown06" data-bs-toggle="dropdown" aria-expanded="false"  style="color: var(--bleu)">Paramètres</a>
            <ul class="dropdown-menu menu_parametres" aria-labelledby="dropdown06"  style="background-color: var(--bleu)">
              <li><a class="dropdown-item" style="color: white" href="{{route('phrases')}}">Créer des paragraphe de commentaires</a></li>
              <li><a class="dropdown-item" style="color: white" href="{{route('password')}}">Gestion des mots de passe</a></li>
              <li><a class="dropdown-item" style="color: white" href="{{route('eleves')}}">Gestion des élèves</a></li>
              <li><a class="dropdown-item" style="color: white" href="{{route('fiches')}}">Définir les items</a></li>
              <li><a class="dropdown-item" style="color: white"href="{{route('aidematernelle')}}">Définir vos aides maternelles</a></li>
              <li><a class="dropdown-item" style="color: white" href="{{route('ecole')}}">Définir votre école</a></li>
              <li><a class="dropdown-item" style="color: white" href="{{route('periode')}}">Définir vos périodes scolaires</a></li>
            </ul>
          </li>
        </ul>

        <ul class="navbar-nav mb-2 mb-xl-0 justify-content-center">
            @if (Auth::check())
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown06" data-bs-toggle="dropdown" aria-expanded="false">{{Auth::user()->nom_complet()}}</a>
                <ul class="dropdown-menu" aria-labelledby="dropdown06" style="background-color: var(--bleu);color: white">
                  <li><a class="dropdown-item" href={{route('monprofil')}}>Mon profil</a></li>
                  <li><a class="dropdown-item" href="{{route('deco')}}">Se deconnecter</a></li>
                </ul>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link" href="{{route('enfants')}}">Se connecter</a>
              </li>
            @endif
        </ul>

      </div>
    </div>
</nav>


  <!-- <div class="mt-5 position-relative">
    <img src="{{asset('/img/deco/banierre.jpg')}}" alt="" style="width: 100vw; height: 400px">
    <div class="titre">
    {{ ucfirst($titre) }}
    </div>
  </div> -->
    <div id="alerte" class="w-100">

    </div>

  <div style="margin-top: 63px;">
       @yield('content')
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<!-- Include jQuery UI from a CDN -->

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>





@include('components.modals.confirmation')
