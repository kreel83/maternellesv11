@extends('layouts.mf')

@section('seo')
    <title>Mentions légales</title>
    <meta name="description" content="Les mentions légales du site internet {{ env('APP_NAME') }}">
@endsection

@section('content')
    <!-- start preloader area -->
    <div class="preloader">
        <div class="circle1"></div>
        <div class="circle2"></div>
    </div>
    <!-- end preloader area -->

    <!-- start top-tp button area -->
    <button class="top-btn">
        <i class="fas fa-chevron-up"></i>
    </button>
    <!-- end top-tp button area -->



    <!-- start banner area -->
    <section class="inner-page banner" data-img="{{asset('assets/images/inner/banner-bg5.jpg')}}">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="content text-center mx-auto titre_banner">
                            <h2>Les mentions légales</h2>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end banner area -->

    <!-- start feature area -->
    <section class="home1 service-page feature pt-120 pb-90">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                    <div class="section-title wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="1s">
                        <h2>Mentions légales</h2>
                        <p>En vigueur au 01/01/2024</p>
                    </div>
                </div>
                <div class="col-lg-12">

                    {{-- https://www.legalplace.fr/ --}}

                    <p>Conformément aux dispositions des Articles 6-III et 19 de la Loi n°2004-575 du 21 juin 2004 pour la
                    Confiance dans l’économie numérique, dite L.C.E.N., il est porté à la connaissance des utilisateurs et
                    visiteurs, ci-après l""Utilisateur", du site {{ env('APP_URL') }} , ci-après le "Site", les
                    présentes mentions légales.</p>

                    <p>La connexion et la navigation sur le Site par l’Utilisateur implique acceptation intégrale et sans réserve
                    des présentes mentions légales.</p>

                    <p>Ces dernières sont accessibles sur le Site à la rubrique « Mentions légales ».</p>

                    <h5 class="mt-3">ARTICLE 1 - L'EDITEUR</h5>

                    <p>L'édition du Site est assurée par ET BAM Solutions, SAS au capital de 1000 euros, immatriculée au
                    Registre du Commerce et des Sociétés de TOULON sous le numéro 983 750 118 dont le siège social
                    est situé au 33 Rue Claire Joie, 83200 Toulon.<br>
                    Adresse e-mail : {{ env('MAIL_FROM_ADDRESS') }}<br>
                    N° de TVA intracommunautaire : **************<br>
                    Le Directeur de la publication est **************<br>
                    ci-après l'"Editeur".
                    </p>

                    <h5 class="mt-3">ARTICLE 2 - L'HEBERGEUR</h5>

                    <p>L'hébergeur du Site est la société Planethoster, dont le siège social est situé au 4416
                    Louis-B.-Mayer Laval, Québec Canada H7P 0G1, avec le numéro de téléphone : +33176604143.</p>

                    <h5 class="mt-3">ARTICLE 3 - ACCES AU SITE</h5>

                    <p>Le Site est accessible en tout endroit, 7j/7, 24h/24 sauf cas de force majeure, interruption
                    programmée ou non et pouvant découlant d’une nécessité de maintenance.</p>

                    <p>En cas de modification, interruption ou suspension du Site, l'Editeur ne saurait être tenu responsable.</p>

                    <h5 class="mt-3">ARTICLE 4 - COLLECTE DES DONNEES</h5>

                    <p>Le Site assure à l'Utilisateur une collecte et un traitement d'informations personnelles dans le respect
                    de la vie privée conformément à la loi n°78-17 du 6 janvier 1978 relative à l'informatique, aux fichiers
                    et aux libertés.</p>

                    <p>En vertu de la loi Informatique et Libertés, en date du 6 janvier 1978, l'Utilisateur dispose d'un droit
                    d'accès, de rectification, de suppression et d'opposition de ses données personnelles. L'Utilisateur
                    exerce ce droit :</p>
                    <p>· via un formulaire de contact ;</p>

                    <p>Toute utilisation, reproduction, diffusion, commercialisation, modification de toute ou partie du Site,
                    sans autorisation de l’Editeur est prohibée et pourra entraînée des actions et poursuites judiciaires
                    telles que notamment prévues par le Code de la propriété intellectuelle et le Code civil.</p>

                    
                </div>
            </div>
        </div>
    </section>
    <!-- end feature area -->


    <!-- start modal area -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">search here</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="search-area">
                        <input type="search" placeholder="search..." class="inputs">
                        <button class="search-btn"><i class="flaticon-loupe"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal area -->


@endsection