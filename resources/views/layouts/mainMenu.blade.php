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
    <div class='dashboard'>
      <div class="dashboard-nav">
          <header>
            <a href="#!" class="menu-toggle"><i class="fas fa-bars"></i></a>
            <a href="{{route('home')}}" class="brand-logo">
                <img src="{{asset('img/deco/les_maternelles.png')}}" alt="" width="200">
            </a></header>
          <nav class="dashboard-nav-list">
            <a href="{{route('home')}}" class="dashboard-nav-item {{$menu == 'accueil' ? 'active' : null}}"><i class="fal fa-home"></i>Accueil </a>
            <a href="{{route('depart')}}" class="dashboard-nav-item  {{$menu == 'dashboard' ? 'active' : null}}"><i class="fal fa-columns"></i> dashboard </a>
            <a href="{{route('enfants')}} " class="dashboard-nav-item {{$menu == 'classe' ? 'active' : null}}"><i class="fal fa-users"></i> Ma classe </a>
            {{-- <div class='dashboard-nav-dropdown'>
              <a href="#!" class="dashboard-nav-item dashboard-nav-dropdown-toggle"><i class="fas fa-photo-video"></i> Disciplines </a>
              <div class='dashboard-nav-dropdown-menu'>
                <a href="#" class="dashboard-nav-dropdown-item">All</a>
                <a href="#" class="dashboard-nav-dropdown-item">Recent</a>
                <a href="#" class="dashboard-nav-dropdown-item">Images</a>
                <a href="#" class="dashboard-nav-dropdown-item">Video</a>
              </div>
            </div> --}}

            @php
            $params = in_array($menu, ['calendrier','event','periode']);
          @endphp
            <div class='dashboard-nav-dropdown {{$params ? 'show' : null}}'>
              <a href="#!" class="dashboard-nav-item dashboard-nav-dropdown-toggle"><i class="fal fa-calendar"></i> Calendrier </a>      
              <div class='dashboard-nav-dropdown-menu'>
                <a href="{{route('calendrier')}}" class="dashboard-nav-dropdown-item {{$menu == 'calendrier' ? 'active' : null}}">Voir le calendrier</a>
                <a href="{{route('password')}}" class="dashboard-nav-dropdown-item {{$menu == 'event' ? 'active' : null}}">Ajouter un évenement</a>
                <a href="{{route('periode')}}" class="dashboard-nav-dropdown-item {{$menu == 'periode' ? 'active' : null}}">Mes périodes scolaires</a>

              </div>
            </div>

              @php
                $params = in_array($menu, ['affectation_groupe','commentaire','mdp','eleve','item','aide','ecole','groupe']);
              @endphp
            <div class='dashboard-nav-dropdown {{$params ? 'show' : null}}'>

              <a href="#!" class="dashboard-nav-item dashboard-nav-dropdown-toggle"><i class="fal fa-cog"></i> Paramètres </a>      

              <div class='dashboard-nav-dropdown-menu'>
                <a href="{{route('phrases')}}" class="dashboard-nav-dropdown-item {{$menu == 'commentaire' ? 'active' : null}}">Paragraphe de commentaires</a>
                <a href="{{route('password')}}" class="dashboard-nav-dropdown-item {{$menu == 'mdp' ? 'active' : null}}">Mots de passe</a>
                <a href="{{route('eleves')}}" class="dashboard-nav-dropdown-item {{$menu == 'eleve' ? 'active' : null}}">Les élèves</a>
                <a href="{{route('fiches')}}" class="dashboard-nav-dropdown-item {{$menu == 'item' ? 'active' : null}}">Les items</a>
                <a href="{{route('aidematernelle')}}" class="dashboard-nav-dropdown-item {{$menu == 'aide' ? 'active' : null}}">Mes aides maternelles</a>
                <a href="{{route('ecole')}}" class="dashboard-nav-dropdown-item {{$menu == 'ecole' ? 'active' : null}}">Mon école</a>
                <a href="{{route('groupe')}}" class="dashboard-nav-dropdown-item {{$menu == 'groupe' ? 'active' : null}}">Mes groupes d'élèves</a>
                <a href="{{route('affectation_groupe')}}" class="dashboard-nav-dropdown-item {{$menu == 'affectation_groupe' ? 'active' : null}}">Affectation des groupes</a>
                <a href="{{route('photos')}}" class="dashboard-nav-dropdown-item {{$menu == 'photos' ? 'active' : null}}">Les photos</a>
              </div>
            </div>

            <a href="{{route('monprofil')}}" class="dashboard-nav-item {{$menu == 'monprofil' ? 'active' : null}}"><i class="fas fa-user"></i> Mon profil</a>

            @php
              $params = in_array($menu, ['souscrire','resilier','reactiver','facture']);
            @endphp
            <div class='dashboard-nav-dropdown {{$params ? 'show' : null}}'>
              <a href="#!" class="dashboard-nav-item dashboard-nav-dropdown-toggle"><i class="fa-solid fa-dove"></i> Mon abonnement</a>      
              <div class='dashboard-nav-dropdown-menu'>
                <a href="{{route('subscribe.cardform')}}" class="dashboard-nav-dropdown-item {{$menu == 'souscrire' ? 'active' : null}}">Souscrire un abonnement</a>
                <a href="{{route('subscribe.cancel')}}" class="dashboard-nav-dropdown-item {{$menu == 'resilier' ? 'active' : null}}">Résilier mon abonnement</a>
                <a href="{{route('subscribe.resume')}}" class="dashboard-nav-dropdown-item {{$menu == 'reactiver' ? 'active' : null}}">Réactiver mon abonnement</a>
                <a href="{{route('subscribe.invoice')}}" class="dashboard-nav-dropdown-item {{$menu == 'facture' ? 'active' : null}}">Mes factures</a>
              </div>
            </div>

            <a class="dashboard-nav-item  {{ $menu == 'contact' ? 'active' : null }}" href="{{route('contact')}}"><i class="fa-regular fa-envelope"></i> Nous contacter</a>
            <div class="nav-item-divider"></div>
            <a href="{{route('deco')}}" class="dashboard-nav-item"><i class="fas fa-sign-out-alt"></i> Se déconnecter</a>

          </nav>
      </div>
      <div class='dashboard-app'>
        {{-- <header class='dashboard-toolbar'>
          <a href="#!" class="menu-toggle"><i class="fas fa-bars"></i></a>
        </header> --}}
        <div id="alerte" class="w-100">

        </div>
        <div class=''>
            @yield('content')
        </div>
    </div>

  </div>
{{-- 
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
</nav> --}}


  <!-- <div class="mt-5 position-relative">
    <img src="{{asset('/img/deco/banierre.jpg')}}" alt="" style="width: 100vw; height: 400px">
    <div class="titre">
    {{ ucfirst($titre) }}
    </div>
  </div> -->



  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<!-- Include jQuery UI from a CDN -->

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>





@include('components.modals.confirmation')
