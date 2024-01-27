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

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon"/>    
        <!-- josefin sans font -->
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">     
        <!-- heebo font -->
        <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@300;400;500;600;700&display=swap" rel="stylesheet" />    
        <title>Maternelle Facile</title>    
        <!-- font-awesome -->
        <link rel="stylesheet" href="{{asset('assets/css/all.min.css')}}">    
        <!-- flaticon -->
        <link rel="stylesheet" href="{{asset('assets/font/flaticon.css')}}">
    
        <!-- bootstrap -->
        <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    
        <!-- menu -->
        <link rel="stylesheet" href="{{asset('assets/css/menu.css')}}">
    
        <!-- odometer -->
        <link rel="stylesheet" href="{{asset('assets/css/odometer.css')}}">
    
        <!-- venobox -->
        <link rel="stylesheet" href="{{asset('assets/css/venobox.css')}}">
    
        <!-- swiper-slider -->
        <link rel="stylesheet" href="{{asset('assets/css/swiper-bundle.min.css')}}">
    
        <!-- scroll animation -->
        <link rel="stylesheet" href="{{asset('assets/css/animate.css')}}">
    
        <!-- style -->
        <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    
        <!-- responsive -->
        <link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}">
 
    {{-- @vite(['resources/scss/app.scss', 'resources/js/app.js']) --}}
    <link rel="icon" href="{{ asset('favicon/favicon.ico') }}">

    <script src="{{asset('assets/plugins/jquery-3.4.1.min.js')}}" defer></script>

    <!-- bootstrap -->
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}" defer></script>

    <!-- menu -->
    <script src="{{asset('assets/plugins/menu.min.js')}}" defer></script>

    <!-- odometer -->
    <script src="{{asset('assets/plugins/appear.min.js')}}" defer></script>
    <script src="{{asset('assets/plugins/odometer.min.js')}}" defer></script>

    <!-- mixitup -->
    <script src="{{asset('assets/plugins/mixitup.min.js')}}" defer></script>

    <!-- directional hover -->
    <script src="{{asset('assets/plugins/jquery.directional-hover.min.js')}}" defer></script>

    <!-- cursor move -->
    <script src="{{asset('assets/plugins/tweenmax.js')}}" defer></script>

    <!-- venobox -->
    <script src="{{asset('assets/plugins/venobox.min.js')}}" defer></script>

    <!-- swiper-slider -->
    <script src="{{asset('assets/plugins/swiper-bundle.min.js')}}" defer></script>

    <!-- wow js -->
    <script src="{{asset('assets/plugins/wow.min.js')}}" defer></script>

    <script src="{{asset('assets/js/script.js')}}" defer></script>

    <!-- Google map -->
    </head>



<body>
<header>
    <!-- start menubar area -->
    <section class="menubar">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar p-0">
                        <!-- header logo -->
                        <a class="navbar-brand p-0" href="index.html">
                            <img src="{{asset('assets/images/logo.png')}}" alt="Logo" width="150" />
                        </a>
                        <div class="header-menu position-static">
                            <ul class="menu">
                                <li class="active">
                                    <a href="{{route('mf.index')}}">Accueil</a>
                                </li>
                                <li><a href="{{route('mf.application')}}">l'application</a></li>
                                <li><a href="{{route('mf.compagnon')}}">le compagnon</a></li>
                                <li><a href="{{route('mf.tarification')}}">tarification</a></li>
                                <li><a href="{{route('mf.contact')}}">contact</a></li>
                            </ul>
                        </div>
                        <div class="right-part">
                            <ul class="d-flex align-items-center">
                                <li>
                                    <button data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="flaticon-loupe"></i></button>
                                </li>
                                <li><a href="{{route('login')}}">Essayez gratuitement</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- end menubar area -->
</header>
    <div id="vitrineView">    
         @yield('content')   
    </div>
    <footer class="footer" data-img="{{asset('assets/images/footer-bg.jpg')}}">
        <!-- start footer-top area -->
        <section class="footer-top pt-100 pb-60">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="content">
                            <div class="title">
                                <h5>Get in Touch</h5>
                            </div>
                            <p class="desc">Lorem ipsum dolor sit am co adipisicing elit, sed do eiusmod tempor</p>
                            <ul class="address">
                                <li class="d-flex align-items-center">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <p>24/A New California</p>
                                </li>
                                <li class="d-flex align-items-center">
                                    <i class="fas fa-phone-alt"></i>
                                    <p>+1 800 123 4567</p>
                                </li>
                                <li class="d-flex align-items-center">
                                    <i class="far fa-envelope"></i>
                                    <p>demo@example.com</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="content">
                            <div class="title">
                                <h5>quick links</h5>
                            </div>
                            <ul class="navigation">
                                <li><a href="index.html">home</a></li>
                                <li><a href="service.html">service</a></li>
                                <li><a href="team.html">our team</a></li>
                                <li><a href="project-detail.html">project</a></li>
                                <li><a href="service-detail.html">android</a></li>
                                <li><a href="service-detail.html">development</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="content">
                            <div class="title">
                                <h5>follow us</h5>
                            </div>
                            <ul class="follow">
                                <li><a href="#!">facebook</a></li>
                                <li><a href="#!">twitter</a></li>
                                <li><a href="#!">google+</a></li>
                                <li><a href="#!">youtube</a></li>
                                <li><a href="#!">instagram</a></li>
                                <li><a href="#!">dribbble</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="content">
                            <div class="title">
                                <h5>subscribe</h5>
                            </div>
                            <p>Lorem ipsum dolor si  consectetur adipisicing elit, sed eiusmotempor incididunt ut labore et</p>
                            <div class="form-area">
                                <input type="email" placeholder="your email" class="inputs">
                                <button><i class="fab fa-telegram-plane"></i></button>
                            </div>
                            <ul class="d-flex social">
                                <li><a href="#!"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#!"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#!"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="#!"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <!-- jquery -->


    <!-- script -->
   
  </body>
  </html>