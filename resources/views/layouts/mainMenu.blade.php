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
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
        <link href="{{asset('icons/css/all.css')}}" rel="stylesheet">
        <script src="{{asset('js/app.js')}}" defer></script>
        <script src="{{ asset('js/all.min.js') }}" defer></script>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>


<nav class="navbar navbar-expand-xl navbar-dark bg-dark" aria-label="Sixth navbar example">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{route('depart')}}">Les maternelles</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample06" aria-controls="navbarsExample06" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExample06">
        <ul class="navbar-nav me-auto mb-2 mb-xl-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="{{route('home')}}">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="{{route('enfants')}}">Ma classe</a>
          </li>
          {{--<li class="nav-item dropdown">--}}
            {{--<a class="nav-link dropdown-toggle" href="#" id="dropdown06" data-bs-toggle="dropdown" aria-expanded="false">Cahier de progrès</a>--}}
            {{--<ul class="dropdown-menu" aria-labelledby="dropdown06">--}}
              {{--<li><a class="dropdown-item" href="#">Elaboration</a></li>--}}
              {{--<li><a class="dropdown-item" href="#">Suivi</a></li>--}}
            {{--</ul>--}}
          {{--</li>--}}
          {{--<li class="nav-item">--}}
            {{--<a class="nav-link" href="#">Correspondance</a>--}}
          {{--</li>--}}
          {{--<li class="nav-item">--}}
            {{--<a class="nav-link" href="#">Les évenements</a>--}}
          {{--</li>--}}
          <li class="nav-item">
            <a class="nav-link" href="{{route('calendrier')}}">Calendrier</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown06" data-bs-toggle="dropdown" aria-expanded="false">Paramètres</a>
            <ul class="dropdown-menu" aria-labelledby="dropdown06">
              <li><a class="dropdown-item" href="{{route('phrases')}}">Créer des paragraphe de commentaires</a></li>
              <li><a class="dropdown-item" href="{{route('password')}}">Gestion des mots de passe</a></li>
              <li><a class="dropdown-item" href="{{route('eleves')}}">Gestion des élèves</a></li>
              <li><a class="dropdown-item" href="{{route('fiches')}}">Définir les items</a></li>
              {{--<li><a class="dropdown-item" href="#">Définir le système de notation</a></li>--}}
              {{--<li><a class="dropdown-item" href="#">Définir les couleurs des sections</a></li>--}}
              {{--<li><a class="dropdown-item" href="{{route('calendar')}}">Définir les périodes scolaires</a></li>--}}
              <li><a class="dropdown-item" href="{{route('aidematernelle')}}">Définir vos aides maternelles</a></li>
              <li><a class="dropdown-item" href="{{route('ecole')}}">Définir votre école</a></li>
              <li><a class="dropdown-item" href="{{route('periode')}}">Définir vos périodes scolaires</a></li>
            </ul>
          </li>
        </ul>

        <ul class="navbar-nav me-auto mb-2 mb-xl-0">
            @if (Auth::check())
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown06" data-bs-toggle="dropdown" aria-expanded="false">{{Auth::user()->nom_complet()}}</a>
                <ul class="dropdown-menu" aria-labelledby="dropdown06">
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
    <div id="alerte" class="w-100">

    </div>

  <div class="container">
       @yield('content')
  </div>


@include('components.modals.confirmation')
