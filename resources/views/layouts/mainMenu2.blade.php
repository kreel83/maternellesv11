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
        <link rel="stylesheet" href="{{asset('/fonts/style.css')}}">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <script src="//cdn.quilljs.com/1.3.6/quill.js" defer></script>
        
        <!-- Theme included stylesheets -->
        <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">



        @vite(['resources/scss/app.scss', 'resources/js/app.js'])

        <link href="{{asset('fontawesome/css/all.css')}}" rel="stylesheet">


        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>



    <input type="hidden" id="tuto" value="{{Auth::user()->configuration->tuto ?? null}}">
    <input type="hidden" id="type" value="{{$tuto ?? null}}">
    <input type="hidden" id="page" value="{{$menu}}">
    @if (!isset($log))
    <header class="site-navbar js-sticky-header site-navbar-target" role="banner">

      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a href="{{route('home')}}" class="brand-logo">
            <img src="{{asset('img/deco/les_maternelles.png')}}" alt="" width="130">
        </a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav align-items-center">
                  <a href="{{route('depart')}}" class="nav-item nav-link  {{$menu == 'accueil' ? 'active' : null}}">Tableau de bord </a>
                  @php
                  $params = in_array($menu, ['evaluation','reussite','affectation_groupe','avatar']);
                @endphp
      
                  @if (Auth::user()->is_enfants())
                  <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Ma classe</a>
                    <div class="dropdown-menu">

      
                      <a href="{{route('enfants',["type" => "evaluation"])}} " class="nav-item nav-link {{$menu == 'evaluation' ? 'active' : null}}">Evaluations</a>
                      <a href="{{route('enfants',["type" => "reussite"])}}" class="nav-item nav-link {{$menu == 'reussite' ? 'active' : null}}">Cahiers de réussite</a>
                      <a href="{{route('enfants',["type" => "avatar"])}}" class="nav-item nav-link {{$menu == 'avatar' ? 'active' : null}}">Je choisis les avatars</a>
                      <a href="{{route('enfants',["type" => "affectation_groupe"])}}" class="nav-item nav-link {{$menu == 'affectation_groupe' ? 'active' : null}}">Affectation des groupes</a>
      
                    </div>
                  </div>
                  @endif
                  @php
                  $params = in_array($menu, ['calendrier','event','periode']);
                @endphp
                 <a href="{{route('calendrier')}}" class="nav-item nav-link  {{$menu == 'dashboard' ? 'active' : null}}">Calendrier</a>

                 @php
                 $params = in_array($menu, ['affectation_groupe','commentaire','periode','eleve','item','create_item','aide','ecole','groupe','avatar']);
               @endphp
                    <div class="nav-item dropdown">
                      <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Parametres</a>
                      <div class="dropdown-menu">
                 <a href="{{route('phrases')}}" class="nav-item nav-link {{$menu == 'commentaire' ? 'active' : null}}">Paragraphe de commentaires</a>
                 {{-- <a href="{{route('password')}}" class="nav-item nav-link {{$menu == 'mdp' ? 'active' : null}}">Mots de passe</a> --}}
                 <a href="{{route('eleves')}}" class="nav-item nav-link {{$menu == 'eleve' ? 'active' : null}}">Mes élèves</a>
                 <a href="{{route('fiches')}}" class="nav-item nav-link {{$menu == 'item' ? 'active' : null}}">Je selectionne mes activités</a>
                 <a href="{{route('createFiche')}}" class="nav-item nav-link {{$menu == 'create_item' ? 'active' : null}}">Je créé mes activités</a>
                 {{-- <a href="{{route('aidematernelle')}}" class="nav-item nav-link {{$menu == 'aide' ? 'active' : null}}">Mes aides maternelles</a> --}}
                 {{-- <a href="{{route('ecole')}}" class="nav-item nav-link {{$menu == 'ecole' ? 'active' : null}}">Mon école</a> --}}
                 <a href="{{route('groupe')}}" class="nav-item nav-link {{$menu == 'groupe' ? 'active' : null}}">Mes groupes</a>
                 {{-- <a href="{{route('affectation_groupe')}}" class="nav-item nav-link {{$menu == 'affectation_groupe' ? 'active' : null}}">Affectation des groupes</a> --}}
                                 {{-- <a href="{{route('periode')}}" class="nav-item nav-link {{$menu == 'periode' ? 'active' : null}}">Mes périodes scolaires</a> --}}
                 {{-- <a href="{{route('avatar')}}" class="nav-item nav-link {{$menu == 'avatar' ? 'active' : null}}">Je choisis les avatars</a> --}}
               </div>
             </div>
             @php
             $params = in_array($menu, ['monprofil','lock']);
           @endphp
                    <div class="nav-item dropdown">
                      <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Mon profil</a>
                      <div class="dropdown-menu">
               <a href="{{route('monprofil')}}" class="nav-item nav-link  {{ $menu == 'monprofil' ? 'active' : null }}">Mon profil</a>
               <a href="{{route('changerLeMotDePasse')}}" class="nav-item nav-link  {{ $menu == 'lock' ? 'active' : null }}">Changer le mot de passe</a>
             </div>
           </div>
           @php
           $params = in_array($menu, ['detail','souscrire','resilier','reactiver','facture']);
         @endphp
                    <div class="nav-item dropdown">
                      <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Mon abonnement</a>
                      <div class="dropdown-menu">
             @if(session('menuAbonnement')['abonnement'])
               <a href="{{route('subscribe.detail')}}" class="nav-item nav-link {{$menu == 'detail' ? 'active' : null}}">Voir le détail</a>
             @else
               <a href="{{route('subscribe.cardform')}}" class="nav-item nav-link {{$menu == 'souscrire' ? 'active' : null}}">Souscrire un abonnement</a>
             @endif
             @if(session('menuAbonnement')['resiliationSubMenu'])
               <a href="{{route('subscribe.cancel')}}" class="nav-item nav-link {{$menu == 'resilier' ? 'active' : null}}">Résilier mon abonnement</a>
             @endif
             @if(session('menuAbonnement')['resumeSubMenu'])
             <a href="{{route('subscribe.resume')}}" class="nav-item nav-link {{$menu == 'reactiver' ? 'active' : null}}">Réactiver mon abonnement</a>
             @endif
             @if(session('menuAbonnement')['invoice'])
               <a href="{{route('subscribe.invoice')}}" class="nav-item nav-link {{$menu == 'facture' ? 'active' : null}}">Mes factures</a>
             @endif
           </div>
         </div>
         <a class="nav-item nav-link  {{ $menu == 'contact' ? 'active' : null }}" href="{{route('contact')}}">Nous contacter</a>
         <div class="nav-item-divider"></div>
         <div id="modeTuto" class="{{Auth::user() && Auth::user()->configuration->tuto == 0 ? 'd-none' : null}}">
           <button class="btnModeTuto">Desactiver le mode tutoriel</button>
         </div>
           
                                   </div>
                <div class="navbar-nav ms-auto">
                  <a href="{{route('deco')}}" class="nav-item nav-link"><i class="fal fa-sign-out-alt"></i> Se déconnecter</a>
                </div>
            </div>
        </div>
    </nav>

    </header>
      <div class='position-relative' >

        {{-- <header class='dashboard-toolbar'>
          <a href="#!" class="menu-toggle"><i class="fas fa-bars"></i></a>
        </header> --}}
        @if(Session::has('message'))
        <p class="alerteMessage alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif
        <div class='position-relative h-100'>
          {{-- <div class="position-absolute" style="top: 40px; right: 40px "><i class="fs-1 fas fa-edit"></i></div> --}}
          @yield('content')
        </div>
        @else
        <div class='h-100'>
          @yield('content')
        </div>
        @endif
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

<!-- Modal -->


<style>
  .fleche {
    cursor: pointer;
   
  }


</style>



<div id="tuto_window" class="position-absolute d-none">
  <div class="remoteTutoWindow">
    <i class="fa-solid fa-times"></i>
  </div>
  <img src="{{asset('img/tutos/fleche.png')}}" alt="" height="160" width="100" id="arrowTuto" class="position-absolute" style=" z-index: 8000;">
  <div class="title"></div>
  <div class="texte"></div>
  <div class="d-flex justify-content-between px-5 mt-3">
    
    <i class="fa-solid fa-arrow-left fleche left"></i>
    <i class="fa-solid fa-arrow-right fleche right"></i>
</div>
</div>

{{-- <div class="modal fade" id="tutoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content  position-relative">
      <img src="{{asset('img/tutos/fleche.png')}}" alt="" width="" id="arrowTuto" class="position-absolute">



      <div class="modal-header">
        <h1 class="modal-title fs-5" id="title"></h1>
        <div class="modal-header d-flex justify-content-between px-5 w-50">
          <i class="fa-solid fa-arrow-left fleche left"></i>
          <i class="fa-solid fa-arrow-right fleche right"></i>
      </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ceci est un tuto sur la direction
      </div>

    </div>
  </div>
</div> --}}




  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<!-- Include jQuery UI from a CDN -->

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>





@include('components.modals.confirmation')
