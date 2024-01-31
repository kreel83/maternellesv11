<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('seo')
    <link rel="stylesheet" href="assets/css/app.css">
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('favicon/favicon.ico') }}">
</head>
<body>

    <nav id="vitrineTopMenu" class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            {{-- <a class="navbar-brand" href="{{ route('vitrine.index') }}"><img src="{{ asset('img/vitrine/logo/logoV2.png') }}" alt="logo"></a> --}}
            <a class="navbar-brand" href="{{ route('vitrine.index') }}"><img src="{{ asset('img/deco/logo-mail.png') }}" height="50" alt="logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle menu-link-lightblue" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-box"></i> <span class="link-green">Services</span></a>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('vitrine.cahier') }}">Cahier de progrès</a></li>
                    <li><a class="dropdown-item" href="{{ route('vitrine.eleves') }}">Mes élèves</a></li>
                    <li><a class="dropdown-item" href="{{ route('vitrine.fiches') }}">Mes fiches</a></li>
                    <li><a class="dropdown-item" href="{{ route('vitrine.calendrier') }}">Calendrier</a></li>
                </ul>
                </li>
                <li class="nav-item">
                <a class="nav-link menu-link-orange" href="{{ route('vitrine.parametrage') }}"><i class="fa-solid fa-gear"></i> Paramétrage</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link-green" href="{{ route('vitrine.compagnon') }}"><i class="fa-solid fa-mobile"></i> Le Compagnon</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link-#7769FE" href="{{ route('vitrine.tarif') }}"><i class="fa-solid fa-tag"></i> Tarif</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link-red" href="{{ route('vitrine.contact') }}"><i class="fa-solid fa-paper-plane"></i> Nous contacter</a>
                </li>
                <li class="nav-item ms-2">
                    <a class="btn btn-outline-primary" href="{{ route('login') }}">Connectez-vous</a>
                </li>
                <li class="nav-item ms-3">
                    <a class="btn btn-primary" href="{{ route('registration.start') }}">Créer un compte</a>
                </li>
                
            </ul>
        
            </div>
        </div>
    </nav>

    <div id="vitrineView">
    
    @yield('content')
    
    <footer class="bg_img" style="background-image: url('{{ asset('img/vitrine/footer/footer-bg.jpg') }}')">
        <div class="footer-top">
            <div class="container">
                <div class="row gy-4 mb--50">
                    <div class="col-lg-4 col-md-6">
                        <div class="footer-widget widget-about">
                            <h5 class="title">A propos</h5>
                            <p>{{ config('app.name') }} est un service en ligne pour faciliter la gestion d'une classe de maternelle et l'édition du cahier de réussites.</p>
                            <ul class="contact">
                                <li><i class="fas fa-headphones-alt"></i> 09 08 07 06 05</li>
                                <li><i class="fas fa-home"></i> Notre adresse</li>
                                <li><i class="fas fa-globe-asia"></i> <a href="/">www.maternellefacile.fr</a></li>
                            </ul>
                            <ul class="social-icons">
                                <li>
                                    <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
                                </li>
                                <li>
                                    <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#" class="linkedin"><i class="fab fa-linkedin-in"></i></a>
                                </li>
                                <li>
                                    <a href="#" class="instagram"><i class="fab fa-instagram"></i></a>
                                </li>
                                <li>
                                    <a href="#" class="pinterest"><i class="fab fa-pinterest"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="footer-widget widget-blog">
                            <h5 class="title">Support</h5>
							<ul class="contact">
                                <li><i class="fa-solid fa-caret-right"></i> <a href="{{ route('vitrine.conditions') }}">Conditions d'utilisation</a></li>
                                <li><i class="fa-solid fa-caret-right"></i> <a href="{{ route('vitrine.mentions') }}">Mentions légales</a></li>
								<li><i class="fa-solid fa-caret-right"></i> <a href="{{ route('vitrine.confidentialite') }}">Politique de confidentialité</a></li>
								<li><i class="fa-solid fa-caret-right"></i> <a href="{{ route('vitrine.cookies') }}">Politique de cookies (UE)</a></li>
								<li><i class="fa-solid fa-caret-right"></i> <a href="{{ route('vitrine.contact') }}">Nous contacter</a></li>                                
                            </ul>
							<!--
                            <ul class="footer-blog">
                                <li>
                                    <div class="thumb">
                                        <a href="blog-single.html">
                                            <img src="assets/images/footer/blog1.png" alt="footer">
                                        </a>
                                    </div>
                                    <div class="content">
                                        <a href="blog-single.html">Remo Suppor Center What For Semiconductor
                                            Provider</a>
                                        <span>April 08,2022</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="thumb">
                                        <a href="blog-single.html">
                                            <img src="assets/images/footer/blog2.png" alt="footer">
                                        </a>
                                    </div>
                                    <div class="content">
                                        <a href="blog-single.html">Remo Suppor Center What For Semiconductor
                                            Provider</a>
                                        <span>April 08,2022</span>
                                    </div>
                                </li>
                            </ul>
							-->
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 pl-xl-4">
                        <div class="footer-widget widgt-form">
                            <h5 class="title">Inscription à la Newsletter</h5>
                            <p>Entrez votre email et recevez les dernières mises à jour et informations sur notre plateforme.</p>
                            <form class="footer-form" action="#" method="post">
                                <input type="text" placeholder="Entrez votre email" name="email">
                                <button type="submit">
                                    <span class="shape"></span>
                                    <span>S'inscrire</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <p>
                    <i class="fa-regular fa-copyright"></i> 2023 Tous droits réservés.
                </p>
            </div>
        </div>
    </footer>

    </div>

    {{-- https://cookie.eurowebpage.com/ --}}
    {{-- https://www.cnil.fr/fr/cookies-et-autres-traceurs/regles/cookies/comment-mettre-mon-site-web-en-conformite --}}
	<!-- <script type="text/javascript" src="//cookie.eurowebpage.com/cookie.js?learnmore=Ne%20pas%20accepter&amp;morelink=https%3A%2F%2Fwww.lesmaternelles.kreel.fr%2Fcookies&amp;accept_text=Accepter"></script> -->
	
    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>-->

  </body>
  </html>