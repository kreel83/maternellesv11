@extends('layouts.vitrine')

@section('seo')
    <title>Gestion de votre classe de maternelle en ligne</title>
    <meta name="description" content="Les Maternelles est un service en ligne pour optimiser la gestion d'une classe de maternelle">
@endsection

@section('content')

<!-- ==========Banner Section Starts Here========== -->
<section class="banner-section bg_img" style="background-image: url('{{ asset('img/vitrine/banner/home-banner.jpg') }}')">
    <div class="container">
        <div class="banner-content cl-white">
            <h3 class="cate">Votre classe est la meilleure</h3>
            <!--<h2 class="title">Choisissez le meilleur</h2>-->
            <p>Choisissez le meilleur service en ligne pour simplifier sa gestion et gagner du temps !</p>
            <a href="{{ route('registration.start') }}" class="custom-button"><span>Commencer maintenant</span></a>
        </div>
    </div>
</section>
<!-- ==========Banner Section Ends Here========== -->



<!--<img src="assets/images/slide1.jpg" class="img-fluid">-->

  <!-- ==========About Section Starts Here========== -->
<section class="about-section pos-rel padding-bottom padding-top oh">
    <div class="top-shape-center">
        <img src="{{ asset('img/vitrine/misc/gallery1.png') }}" alt="css">
    </div>
    <div class="bottom-shape-left">
        <img src="{{ asset('img/vitrine/misc/bottom-shape.png') }}" alt="css">
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-header">
                    <span class="cate">Bienvenue sur Les Maternelles</span>
                    <h3 class="title">Le meilleur logiciel<br>de gestion d'une classe de maternelle</h3>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mb-30-none -mx-10">
            <div class="col-md-6 col-lg-5 col-xl-3">
                <div class="feature-item">
                    <div class="feature-thumb">
                        <img src="{{ asset('img/vitrine/feature/01.png') }}" class="ml--8" alt="feature">
                    </div>
                    <div class="feature-content">
                        <h5 class="title">Cahier de réussites</h5>
                        <span class="cate">L'indispensable</span>
                        <p>Il n'a jamais été aussi simple de générer le cahier de réussites de vos élèves !</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-5 col-xl-3">
                <div class="feature-item">
                    <div class="feature-thumb">
                        <img src="{{ asset('img/vitrine/feature/02.png') }}" class="ml--8" alt="feature">
                    </div>
                    <div class="feature-content">
                        <h5 class="title">Mes élèves</h5>
                        <span class="cate">Toutes sections</span>
                        <p>Je gère ma classe avec une grande facilité de la petite à la grande section</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-5 col-xl-3">
                <div class="feature-item">
                    <div class="feature-thumb">
                        <img src="{{ asset('img/vitrine/feature/03.png') }}" class="ml--8" alt="feature">
                    </div>
                    <div class="feature-content">
                        <h5 class="title">Mes activités</h5>
                        <span class="cate">Grande flexibilité</span>
                        <p>Je crée, modifie, assigne mes activités à mes élèves très facilement</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-5 col-xl-3">
                <div class="feature-item">
                    <div class="feature-thumb">
                        <img src="{{ asset('img/vitrine/feature/04.png') }}" class="ml--8" alt="feature">
                    </div>
                    <div class="feature-content">
                        <h5 class="title">Mon calendrier</h5>
                        <span class="cate">L'aide mémoire</span>
                        <p>Je planifie les anniversaires, vacances scolaires et tout autre évènement à venir</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="padding-top about-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="rtl d-none d-lg-block pr-4">
                        <img src="{{ asset('img/vitrine/about/about03.png') }}" alt="about">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-content">
                        <div class="section-header left-style mb-olpo">
                            <span class="cate">{{ env('APP_NAME') }}</span>
                            <h3 class="title">Les points forts de notre service</h3>
                            <p>Notre service en ligne <b>{{ env('APP_NAME') }}</b> offre une flexibilité accrue.
                            Gérez votre classe depuis votre ordinateur ou votre tablette en toute sécurité. L'application mobile (compagnon) est le 
                            complément idéal en classe pour inscrire des notes sur l'instant.
                            </p>
                        </div>
                        <ul class="about-list">
                            <li>
                                <i class="fa-solid fa-circle-check"></i>Accessible 7/7 24/24H avec une connection Internet</span>
                            </li>
                            <li>
                                <i class="fa-solid fa-circle-check"></i>Connection cryptée et sécurisée</span>
                            </li>
                            <li>
                                <i class="fa-solid fa-circle-check"></i>Stockage des données sécurisé dans notre Datacenter</span>
                            </li>
                            <li>
                                <i class="fa-solid fa-circle-check"></i>Mises à niveau régulières pour un service au Top</span>
                            </li>
                            <li>
                                <i class="fa-solid fa-circle-check"></i>Abonnement annuel tout compris. Aucuns frais cachés</span>
                            </li>
                        </ul>                            
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ==========About Section Ends Here========== -->

<!-- ==========Call-In-Section Starts Here========== -->
<section class="call-in-action call-overlay bg_img padding-bottom padding-top" 
style="background-image: url('{{ asset('img/vitrine/bg/call-bg.jpg') }}')">
    <div class="container">
        <div class="call-wrapper">
            <div class="section-header mb-olpo">
                <h3 class="title">Rejoignez nous dès maintenant</h3>
                <p>Si vous souhaitez rejoindre la plateforme Les Maternelles, nous vous souhaitons la bienvenue 
                en tant que nouvel utilisateur.</p>
            </div>
            <div class="text-center">
                <a href="{{ route('registration.start') }}" class="custom-button"><span>Commencer maintenant</span></a>
            </div>
        </div>
    </div>
</section>
<!-- ==========Call-In-Section Ends Here========== -->

<!-- ==========Client Section Starts Here========== -->
<section id="temoignage" class="client-section padding-top padding-bottom bg_img"
style="background-image: url('{{ asset('img/vitrine/client/client-bg.jpg') }}')">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-header cl-white">
                    <span class="cate">Témoignages</span>
                    <h3 class="title">Que disent nos utilisateurs</h3>
                </div>
            </div>
        </div>

        <div id="carouselExample" class="carousel slide">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <div class="client-item">
                    <div class="client-header">
                        <div class="author">
                            <div class="thumb">
                                <img src="{{ asset('img/vitrine/client/client1.png') }}" alt="client">
                            </div>
                            <div class="content">
                                <h6 class="title">Laura K.</h6>
                                <span>Maternelle petite section</span>
                            </div>
                        </div>
                    </div>
                    <div class="client-body">
                        <p>Depuis que j'utilise ce service pour gérer ma classe de petite section franchement 
                        je ne pourrais plus m'en passer. Tout devient facile et rapide, et surtout la création 
                        des cahiers de progrès ne me prends plus de temps. Je les envoient aux parents en quelques clics, 
                        c'est vraiment bien.</p>
                        <div class="ratings">
                            <span><i class="fa-solid fa-star"></i></span>
                            <span><i class="fa-solid fa-star"></i></span>
                            <span><i class="fa-solid fa-star"></i></span>
                            <span><i class="fa-solid fa-star"></i></span>
                            <span><i class="fa-solid fa-star"></i></span>
                        </div>
                    </div>
                </div>
              </div>
              <div class="carousel-item">
                <div class="client-item">
                    <div class="client-header">
                        <div class="author">
                            <div class="thumb">
                                <img src="{{ asset('img/vitrine/client/client2.png') }}" alt="client">
                            </div>
                            <div class="content">
                                <h6 class="title">Roger M.</h6>
                                <span>Maternelle grande section</span>
                            </div>
                        </div>
                    </div>
                    <div class="client-body">
                        <p>Je suis de la vieille école et méfiant vis à vis des nouvelles technologies, je me 
                        demandais si cela allait m'apporter quelque chose ou me simplifier la vie. Je dois dire que 
                        j'ai été bluffé par la simplicité et le gain de temps que cela me procure. Je compte bien me 
                        réabonner chaque année jusqu'à ma retraite.</p>
                        <div class="ratings">
                            <span><i class="fa-solid fa-star"></i></span>
                            <span><i class="fa-solid fa-star"></i></span>
                            <span><i class="fa-solid fa-star"></i></span>
                            <span><i class="fa-solid fa-star"></i></span>
                            <span><i class="fa-solid fa-star"></i></span>
                        </div>
                    </div>
                </div>
              </div>

            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
        </div>

        {{--
        <div class="client-slider oh">
            <div class="client-item">
                <div class="client-header">
                    <div class="author">
                        <div class="thumb">
                            <img src="{{ asset('img/vitrine/client/client1.png') }}" alt="client">
                        </div>
                        <div class="content">
                            <h6 class="title">Laura K.</h6>
                            <span>Maternelle petite section</span>
                        </div>
                    </div>
                </div>
                <div class="client-body">
                    <p>Depuis que j'utilise ce service pour gérer ma classe de petite section franchement 
                    je ne pourrais plus m'en passer. Tout devient facile et rapide, et surtout la création 
                    des cahiers de progrès ne me prends plus de temps. Je les envoient aux parents en quelques clics, 
                    c'est vraiment bien.</p>
                    <div class="ratings">
                        <span><i class="fa-solid fa-star"></i></span>
                        <span><i class="fa-solid fa-star"></i></span>
                        <span><i class="fa-solid fa-star"></i></span>
                        <span><i class="fa-solid fa-star"></i></span>
                        <span><i class="fa-solid fa-star"></i></span>
                    </div>
                </div>
            </div>
            <div class="client-item">
                <div class="client-header">
                    <div class="author">
                        <div class="thumb">
                            <img src="{{ asset('img/vitrine/client/client2.png') }}" alt="client">
                        </div>
                        <div class="content">
                            <h6 class="title">Roger M.</h6>
                            <span>Maternelle grande section</span>
                        </div>
                    </div>
                </div>
                <div class="client-body">
                    <p>Je suis de la vieille école et méfiant vis à vis des nouvelles technologies, je me 
                    demandais si cela allait m'apporter quelque chose ou me simplifier la vie. Je dois dire que 
                    j'ai été bluffé par la simplicité et le gain de temps que cela me procure. Je compte bien me 
                    réabonner chaque année jusqu'à ma retraite.</p>
                    <div class="ratings">
                        <span><i class="fa-solid fa-star"></i></span>
                        <span><i class="fa-solid fa-star"></i></span>
                        <span><i class="fa-solid fa-star"></i></span>
                        <span><i class="fa-solid fa-star"></i></span>
                        <span><i class="fa-solid fa-star"></i></span>
                    </div>
                </div>
            </div>
            <!--
            <div class="client-item">
                <div class="client-header">
                    <div class="author">
                        <div class="thumb">
                            <img src="{{ asset('img/vitrine/client/client1.png') }}" alt="client">
                        </div>
                        <div class="content">
                            <h6 class="title">Angel Witicker</h6>
                            <span>UX Designer</span>
                        </div>
                    </div>
                    <div class="company">
                        <img src="{{ asset('img/vitrine/client/logo2.png') }}" alt="client">
                    </div>
                </div>
                <div class="client-body">
                    <p>Rapidiously buildcollaboration anden deas sharing viaing bleeding and
                        edge nterfaces Energstcally plagiarize team anbuilding and paradgmis
                        whereas goingi forward process mproveents and monetze fully tested
                        ergstcally plariarize team whereas goingi forward process an services
                        whereas going forward process</p>
                    <div class="ratings">
                        <span><i class="far fa-star"></i></span>
                        <span><i class="far fa-star"></i></span>
                        <span><i class="far fa-star"></i></span>
                        <span><i class="far fa-star"></i></span>
                        <span><i class="far fa-star"></i></span>
                    </div>
                </div>
            </div>
            <div class="client-item">
                <div class="client-header">
                    <div class="author">
                        <div class="thumb">
                            <img src="{{ asset('img/vitrine/client/client2.png') }}" alt="client">
                        </div>
                        <div class="content">
                            <h6 class="title">Witicker Alex</h6>
                            <span>Founder & CEO</span>
                        </div>
                    </div>
                    <div class="company">
                        <img src="{{ asset('img/vitrine/client/logo1.png') }}" alt="client">
                    </div>
                </div>
                <div class="client-body">
                    <p>Rapidiously buildcollaboration anden deas sharing viaing bleeding and
                        edge nterfaces Energstcally plagiarize team anbuilding and paradgmis
                        whereas goingi forward process mproveents and monetze fully tested
                        ergstcally plariarize team whereas goingi forward process an services
                        whereas going forward process</p>
                    <div class="ratings">
                        <span><i class="far fa-star"></i></span>
                        <span><i class="far fa-star"></i></span>
                        <span><i class="far fa-star"></i></span>
                        <span><i class="far fa-star"></i></span>
                        <span><i class="far fa-star"></i></span>
                    </div>
                </div>
            </div>
            -->
        </div>
        --}}
    </div>
</section>
<!-- ==========Client Section Ends Here========== -->

@endsection