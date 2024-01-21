<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('seo')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
        <!-- favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon"/>
    
        <!-- josefin sans font -->
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet"> 
    
        <!-- heebo font -->
        <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    
        <title>Rdsto App Landing HTML Template</title>
    
        <!-- font-awesome -->
        <link rel="stylesheet" href="assets/css/all.min.css">
    
        <!-- flaticon -->
        <link rel="stylesheet" href="assets/font/flaticon.css">
    
        <!-- bootstrap -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    
        <!-- menu -->
        <link rel="stylesheet" href="assets/css/menu.css">
    
        <!-- odometer -->
        <link rel="stylesheet" href="assets/css/odometer.css">
    
        <!-- venobox -->
        <link rel="stylesheet" href="assets/css/venobox.css">
    
        <!-- swiper-slider -->
        <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
    
        <!-- scroll animation -->
        <link rel="stylesheet" href="assets/css/animate.css">
    
        <!-- style -->
        <link rel="stylesheet" href="assets/css/style.css">
    
        <!-- responsive -->
        <link rel="stylesheet" href="assets/css/responsive.css">
    </head>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('favicon/favicon.ico') }}">
</head>
<header>
    <!-- start menubar area -->
    <section class="menubar">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar p-0">
                        <!-- header logo -->
                        <a class="navbar-brand p-0" href="index.html">
                            <img src="assets/images/logo.png" alt="Logo" width="200" />
                        </a>
                        <div class="header-menu position-static">
                            <ul class="menu">
                                <li class="active">
                                    <a href="index.html">Accueil</a>
                                </li>
                                <li><a href="{{route('mf.cahier')}}">l'application</a></li>
                                <li><a href="{{route('mf.cahier')}}">le compagnon</a></li>
                                <li><a href="{{route('mf.cahier')}}">tarification</a></li>
                                <li><a href="{{route('mf.cahier')}}">contact</a></li>
                            </ul>
                        </div>
                        <div class="right-part">
                            <ul class="d-flex align-items-center">
                                <li>
                                    <button data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="flaticon-loupe"></i></button>
                                </li>
                                <li><a href="contact.html">Essayez gratuitement</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- end menubar area -->
</header>
<body>



    <div id="vitrineView">
    
    @yield('content')
    
   

    </div>

    {{-- https://cookie.eurowebpage.com/ --}}
    {{-- https://www.cnil.fr/fr/cookies-et-autres-traceurs/regles/cookies/comment-mettre-mon-site-web-en-conformite --}}
	<!-- <script type="text/javascript" src="//cookie.eurowebpage.com/cookie.js?learnmore=Ne%20pas%20accepter&amp;morelink=https%3A%2F%2Fwww.lesmaternelles.kreel.fr%2Fcookies&amp;accept_text=Accepter"></script> -->
	
    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>-->

  </body>
  </html>