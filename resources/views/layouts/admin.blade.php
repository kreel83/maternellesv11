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


    <nav class="navbar navbar-expand-lg fixed-top" aria-label="" style="background-color: #E7FCFF">
        <div class="container-fluid">
            <a href="{{ route('admin.index') }}" class="brand-logo">
                <img src="{{ asset('img/deco/logo.png') }}" alt="{{ env('APP_NAME').' Administration' }}" width="130">
            </a>
        {{-- <a class="navbar-brand me-5" href="{{route('admin.index')}}">Les maternelles - Administration</a> --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample06" aria-controls="navbarsExample06" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse pe-5" id="navbarsExample06">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link {{ $menu == 'dashboard' ? 'active' : null }}" aria-current="page" href="{{route('admin.index')}}">Tableau de bord</a>
                </li>
            
                <li class="nav-item">
                    <a class="nav-link {{ $menu == 'licence' ? 'active' : null }}" aria-current="page" href="{{route('admin.licence.index')}}">Mes licences</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{ $menu == 'invoice' ? 'active' : null }}" aria-current="page" href="{{route('admin.licence.invoice')}}">Mes factures</a>
                </li>
            
                <li class="nav-item">
                    <a class="nav-link {{ $menu == 'contact' ? 'active' : null }}" aria-current="page" href="{{route('admin.contact')}}">Nous contacter</a>
                </li>
    
            </ul>

            <ul class="navbar-nav mb-2 mb-xl-0 justify-content-right">
                @if (Auth::check())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown06" data-bs-toggle="dropdown" aria-expanded="false">{{Auth::user()->nom_complet()}}</a>
                    <ul class="dropdown-menu" aria-labelledby="dropdown06">
                    <li><a class="dropdown-item" href="{{route('admin.loadprofile')}}">Mon profil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="{{route('admin.logout')}}"><i class="fal fa-sign-out-alt"></i> Se déconnecter</a></li>
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

  <div class="container" style="margin-top: 90px">
       @yield('content')
  </div>


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<!-- Include jQuery UI from a CDN -->

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>





@include('components.modals.confirmation')
