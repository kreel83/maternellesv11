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

    <script src="//cdn.quilljs.com/1.3.6/quill.js" defer></script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/quill-image-resize-module@3.0.0/image-resize.min.js" defer></script> --}}

    {{-- https://npm.io/package/quill-resize-image --}}
    <script defer src="https://cdn.jsdelivr.net/gh/hunghg255/quill-resize-module/dist/quill-resize-image.min.js"></script>

    <!-- Theme included stylesheets -->
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="
https://cdn.jsdelivr.net/npm/quill-image-resize-module@3.0.0/image-resize.min.js
" defer></script>


    @vite(['resources/scss/app.scss', 'resources/js/app.js'])

    <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet">



</head>


@php
    $hasClassActive = 'disabled';
    if (session()->get('id_de_la_classe')) {
        $hasClassActive = null;
    } 
@endphp

<body id="backEndUser">

    <input type="hidden" id="tuto" value="{{ Auth::user()->configuration->tuto ?? null }}">
    <input type="hidden" id="type" value="{{ $tuto ?? null }}">
    <input type="hidden" id="page" value="{{ $menu }}">
    @if (!isset($log))
        <header class="site-navbar js-sticky-header site-navbar-target" role="banner">

            <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
                <div class="container-fluid">
                    <a href="{{ route('home') }}" class="brand-logo d-none d-lg-block">
                        <img src="{{ asset('img/deco/logo.png') }}" alt="" width="130">
                    </a>
                    <div class="d-block d-lg-none" style="font-size: 25px; ">
                        @if ($menu == 'accueil')
                            <img src="{{ asset('img/deco/logo.png') }}" alt="" width="90">
                        @else
                        <a href="{{url()->previous()}}">

                            <i style="color: black" class="fa-solid fa-arrow-left"></i>
                        </a>
                        @endif
                    </div>
                    <div class="d-xs-block d-lg-none">
                        {{ $menu}}
                    </div>
                    <button type="button" class="navbar-toggler" data-bs-toggle="collapse"
                        data-bs-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <div class="navbar-nav align-items-center contenu_du_menu">
                            <a href="{{ route('depart') }}"
                                class="nav-item nav-link  {{ $menu == 'accueil' ? 'active' : null }}">Tableau de bord
                            </a>
                            @php
                                $params = in_array($menu, ['evaluation', 'affectation_groupe', 'avatar', 'maclasse']);
                            @endphp


                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle {{ $params ? 'active' : null }}"
                                    data-bs-toggle="dropdown">Ma classe</a>
                                <div class="dropdown-menu">


                                    <a href="{{ route('createclasse') }} "
                                        class="nav-item nav-link {{ $menu == 'createclasse' ? 'active' : null }}">Je crée une classe
                                       </a>
                                    <a href="{{ route('maclasse', ['type' => 'maclasse']) }} "
                                        class="nav-item nav-link {{ $menu == 'maclasse' ? 'active' : null }} {{$hasClassActive}}" >J'édite
                                        ma classe</a>
                                    @if (Auth::user()->is_enfants())
                                        <a href="{{ route('enfants', ['type' => 'evaluation']) }} "
                                            class="nav-item nav-link  {{$hasClassActive}} ">J'évalue mes élèves</a>

                                        <a href="{{ route('enfants', ['type' => 'avatar']) }}"
                                            class="nav-item nav-link {{ $menu == 'avatar' ? 'active' : null }}  {{$hasClassActive}}">Je
                                            choisis les avatars</a>
                                        <a href="{{ route('enfants', ['type' => 'affectation_groupe']) }}"
                                            class="nav-item nav-link {{ $menu == 'affectation_groupe' ? 'active' : null }}  {{$hasClassActive}}">J'affecte
                                            mes groupes</a>
                                    @endif
                                </div>
                            </div>

                            @php
                                $params = in_array($menu, ['manage', 'reussite']);
                            @endphp

                            @if (Auth::user()->is_enfants())
                                <div class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle {{ $params ? 'active' : null }}"
                                        data-bs-toggle="dropdown">Les cahiers de réussites</a>
                                    <div class="dropdown-menu">
                                        <a href="{{ route('enfants', ['type' => 'reussite']) }}"
                                            class="nav-item nav-link {{ $menu == 'reussite' ? 'active' : null }}">J'édite
                                            les
                                            cahiers de réussite</a>
                                        <a href="{{ route('cahierManage') }}"
                                            class="nav-item nav-link {{ $menu == 'manage' ? 'active' : null }}">Je gère
                                            les
                                            cahiers de réussite</a>
                                    </div>

                                </div>
                            @endif
                            @php
                                $params = in_array($menu, ['calendrier', 'event', 'periode']);
                            @endphp
                            <a href="{{ route('calendrier') }}"
                                class="nav-item nav-link  {{ $params ? 'active' : null }}">Calendrier</a>

                            @php
                                $params = in_array($menu, ['commentaire', 'periode', 'eleve', 'item', 'create_item', 'aide', 'ecole', 'groupe']);
                            @endphp
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle {{ $params ? 'active' : null }}"
                                    data-bs-toggle="dropdown">Paramètres</a>
                                <div class="dropdown-menu">

                                    {{-- <a href="{{ route('eleves') }}"
                                        class="nav-item nav-link {{ $menu == 'eleve' ? 'active' : null }}">Mes
                                        élèves</a> --}}
                                    <a href="{{ route('fiches') }}"
                                        class="nav-item nav-link {{ $menu == 'item' ? 'active' : null }}">Je
                                        sélectionne mes activités</a>
                                    <a href="{{ route('createFiche') }}"
                                        class="nav-item nav-link {{ $menu == 'create_item' ? 'active' : null }}">Je
                                        crée mes activités</a>
                                    <a href="{{ route('groupe') }}"
                                        class="nav-item nav-link {{ $menu == 'groupe' ? 'active' : null }}">Mes
                                        groupes</a>
                                    <a href="{{ route('phrases') }}"
                                        class="nav-item nav-link {{ $menu == 'commentaire' ? 'active' : null }}">Mes
                                        phrases pré-enregistrées</a>
                                </div>
                            </div>
                            {{-- @php
                                $params = in_array($menu, ['monprofil', 'lock']);
                            @endphp
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle {{ $params ? 'active' : null }}"
                                    data-bs-toggle="dropdown">Mon profil</a>
                                <div class="dropdown-menu">
                                    <a href="{{ route('monprofil') }}"
                                        class="nav-item nav-link  {{ $menu == 'monprofil' ? 'active' : null }}">Mon
                                        profil</a>
                                    <a href="{{ route('changerLeMotDePasse') }}"
                                        class="nav-item nav-link  {{ $menu == 'lock' ? 'active' : null }}">Changer le
                                        mot de passe</a>
                                </div>
                            </div> --}}



                            <div class="nav-item-divider"></div>
                            <div id="modeTuto"
                                class="{{ Auth::user() && Auth::user()->configuration->tuto == 0 ? 'd-none' : null }}">
                                <button class="btnModeTuto">Desactiver le mode tutoriel</button>
                            </div>
                            <div id="modeDecouverte"
                                class="{{ Auth::user() && Auth::user()->is_abonne() ? 'd-none' : null }}">
                                <button class="btnModeDecouverte" data-bs-toggle="modal" data-bs-target="#InfoDemoMain" >Mode découverte</button>
                            </div>

                        </div>

                        @php
                            $params = in_array($menu, ['monprofil', 'contact']);
                        @endphp

                            <div class="nav-item dropdown ms-auto d-flex justify-content-center nom_dans_menu">
                            <a href="#" class="nav-link dropdown-toggle {{ $params ? 'active' : null }}"
                                data-bs-toggle="dropdown">{{ Auth::user()->prenom }} {{ Auth::user()->name }}</a>

                            <div class="dropdown-menu" style="left: inherit !important; right: 0">
                                <a href="#"
                                    class="nav-item  {{ $menu == 'monprofil' ? 'active' : null }}">{{session()->get('nom_de_la_classe')}}</a>
                                <a href="{{ route('monprofil') }}"
                                    class="nav-item nav-link  {{ $menu == 'monprofil' ? 'active' : null }}">Mon
                                    profil</a>
                                <a href="{{ route('subscribe.index') }}"
                                    class="nav-item nav-link  {{ $menu == 'abonnement' ? 'active' : null }}">Mon
                                    abonnement</a>

                                <a href="{{ route('changerLeMotDePasse') }}"
                                    class="nav-item nav-link  {{ $menu == 'lock' ? 'active' : null }}">Changer le
                                    mot de passe</a>
                                <a class="nav-item nav-link  {{ $menu == 'contact' ? 'active' : null }}"
                                    href="{{ route('contact') }}">Nous contacter</a>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <a href="{{ route('changerLeMotDePasse') }}"
                                class="nav-item nav-link disabled commentaire" style="font-size: 14px; color: lightgray">Changer de classe</a>                               
                                @foreach (Auth::user()->autresClasses() as $classe)
                                    <a href="{{ route('changerClasse',['classe' => $classe->id]) }}"
                                    class="nav-item nav-link  {{ $menu == 'lock' ? 'active' : null }}">{{$classe->description}}</a>
                                @endforeach
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <a href="{{ route('deco') }}" class="nav-item nav-link"><i
                                        class="fal fa-sign-out-alt"></i>
                                    Se déconnecter</a>
                            </div>
                        </div>


                    </div>
                </div>
            </nav>

        </header>

        <div class="position-relative">

            @if (Session::has('message'))
                <p class="alerteMessage mt-4 alert {{ Session::get('alert-class', 'alert-info') }}">
                    {{ Session::get('message') }}</p>
            @endif


            <div class='position-relative h-100 container' id="appli">
                @yield('content')
            </div>

        </div>
    @else
            <div class='h-100'>
                @yield('content')
            </div>

    @endif
    




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
        <img src="{{ asset('img/tutos/fleche.png') }}" alt="" height="160" width="100" id="arrowTuto"
            class="position-absolute" style=" z-index: 8000;">
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

<div class="modal fade" id="InfoDemo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="top: 200px;">
      <div class="modal-content  position-relative">
      
  


        <div class="modal-body text-center">
            Vous utilisez un version "découverte" de l'application<br>
            Cette version est limitée à 10 notations.<br><br>
            Abonnez-vous pour 12€99 / an pour profiter<br>
             pleinement de votre application
            <div>
                <button class="btnAction mx-auto" data-bs-dismiss="modal" aria-label="Close">J'ai compris</button>
            </div>
        </div>
  
      </div>
    </div>
  </div>

<div class="modal fade" id="InfoDemoMain" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="top: 200px;">
      <div class="modal-content  position-relative">
        <div class="modal-body text-center">
            Vous utilisez un version "découverte" de l'application<br>
            Cette version est limitée à 10 notations.<br><br>
            Abonnez-vous pour 12€99 / an pour profiter<br>
             pleinement de votre application
            <div>
                <a href="/app/register/start" class="btnAction mx-auto" style="background-color: rgb(116, 205, 116)">Je m'abonne</a>
                <button class="btnAction mx-auto" data-bs-dismiss="modal" aria-label="Close">je teste l'application</button>
            </div>
        </div>
  
      </div>
    </div>
  </div>




    <script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>

    <!-- Include jQuery UI from a CDN -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" defer></script>


    @include('components.modals.confirmation')

</body>

</html>
