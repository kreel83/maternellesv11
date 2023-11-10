<?
use Illuminate\Support\Facades\Auth;
?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Tableau de bord Direction</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
        <!--<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">-->
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        @vite(['resources/scss/app.scss', 'resources/js/app.js'])
        <link href="{{asset('fontawesome/css/all.css')}}" rel="stylesheet">

               <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
     
               <!-- <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
        <link href="{{asset('icons/css/all.css')}}" rel="stylesheet">
        <link href="{{asset('css/app.css')}}" rel="stylesheet"> -->
  
        <!-- <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/all.min.js') }}" defer></script> -->

        <style>
            body {
                font-family: 'Roboto', 'Nunito', sans-serif;
            }
        </style>
    </head>

    <div class='dashboard'>
        <div class="dashboard-nav">
          <header>
            <a href="#!" class="menu-toggle"><i class="fas fa-bars"></i></a>
            <a href="{{route('admin.index')}}" class="brand-logo">
                <img src="{{asset('img/deco/logo.png')}}" alt="" width="200">
            </a></header>
          <nav class="dashboard-nav-list">
            <a href="{{route('admin.index')}}" class="dashboard-nav-item  {{ $menu == 'dashboard' ? 'active' : null }}"><i class="fas fa-tachometer-alt"></i> Tableau de bord</a>
            <a href="{{route('admin.licence.index')}}" class="dashboard-nav-item  {{ $menu == 'licence' ? 'active' : null }}"><i class="fa-regular fa-id-badge"></i> Mes licences</a>
            <a href="{{route('admin.licence.invoice')}}" class="dashboard-nav-item  {{ $menu == 'invoice' ? 'active' : null }}"><i class="fal fa-file-invoice"></i> Mes factures</a>

            {{--
            @php
              $params = in_array($menu, ['monprofil','monpasse']);
            @endphp
            <div class='dashboard-nav-dropdown {{$params ? 'show' : null}}'>
              <a href="#!" class="dashboard-nav-item dashboard-nav-dropdown-toggle"><i class="fa-solid fa-dove"></i> Mon compte</a>      
              <div class='dashboard-nav-dropdown-menu'>
                <a href="{{route('admin.loadprofile')}}" class="dashboard-nav-item  {{ $menu == 'monprofil' ? 'active' : null }}"><i class="fas fa-user"></i> Mon profil</a>
                <a href="{{route('admin.changerLeMotDePasse')}}" class="dashboard-nav-item  {{ $menu == 'monpasse' ? 'active' : null }}"><i class="fas fa-user"></i> Changer le mot de passe</a>
              </div>
            </div>
            --}}


            <a href="{{route('admin.loadprofile')}}" class="dashboard-nav-item  {{ $menu == 'monprofil' ? 'active' : null }}"><i class="fas fa-user"></i> Mon profil</a>
            <a href="{{route('admin.contact')}}" class="dashboard-nav-item  {{ $menu == 'contact' ? 'active' : null }}"><i class="fa-regular fa-envelope"></i> Nous contacter</a>
            <div class="nav-item-divider"></div>
            <a href="{{route('admin.logout')}}" class="dashboard-nav-item"><i class="fas fa-sign-out-alt"></i> Se déconnecter</a>
          </nav>
        </div>
        <div class='dashboard-app'>
          {{--
          <header class='dashboard-toolbar'>
            <a href="#!" class="menu-toggle"><i class="fas fa-bars"></i></a>
          </header>
          --}}
          <div id="alerte" class="w-100">
  
          </div>
          <div class='container'>
                @yield('content')
          </div>
        </div>
      </div>




{{--
<nav class="navbar navbar-expand-xl  fixed-top" aria-label="Sixth navbar example" style="background-color: #E7FCFF">
    <div class="container-fluid" style="padding: 0 20rem">
      <a class="navbar-brand me-5" href="{{route('admin.index')}}">Les maternelles - Administration</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample06" aria-controls="navbarsExample06" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse pe-5" id="navbarsExample06">

        <ul class="navbar-nav me-auto mb-2 mb-xl-0">
          
          <li class="nav-item me-3 fw-bolder">
            <a class="nav-link" aria-current="page" href="{{route('admin.licence.index')}}">Mes licences</a>
          </li>

        </ul>

        <ul class="navbar-nav me-auto mb-2 mb-xl-0">
          
          <li class="nav-item me-3 fw-bolder">
            <a class="nav-link" aria-current="page" href="{{route('admin.licence.invoice')}}">Mes factures</a>
          </li>

        </ul>

        <ul class="navbar-nav mb-2 mb-xl-0 justify-content-right">
            @if (Auth::check())
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown06" data-bs-toggle="dropdown" aria-expanded="false">{{Auth::user()->nom_complet()}}</a>
                <ul class="dropdown-menu" aria-labelledby="dropdown06">
                  <li><a class="dropdown-item" href="{{route('admin.loadprofile')}}">Mon profil</a></li>
                  <li><a class="dropdown-item" href="{{route('admin.logout')}}">Se deconnecter</a></li>
                </ul>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link" href="{{route('login')}}">Se connecter</a>
            </li>
            @endif
        </ul>

      </div>

    </div>
</nav>


    <div id="alerte" class="w-100">

    </div>

  <div class="container" style="margin-top: 70px;">
       @yield('content')
  </div>
--}}

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<!-- Include jQuery UI from a CDN -->

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>





@include('components.modals.confirmation')
