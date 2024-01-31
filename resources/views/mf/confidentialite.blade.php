@extends('layouts.mf')

@section('seo')
    <title>Politique de confidentialité</title>
    <meta name="description" content="La politique de confidentialité du site internet {{ env('APP_NAME') }}">
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
                            <h2>Politique de confidentialité</h2>

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
                        <h2>Politique de confidentialité</h2>
                        <p>En vigueur au 01/01/2024</p>
                    </div>
                </div>
                <div class="col-lg-12">

                    <h5 class="mt-3">1. Introduction</h5>

                    <p>Merci de visiter notre site Internet. Chez {{ env('APP_NAME') }}, nous accordons une grande importance à la protection de vos données personnelles et nous nous engageons à respecter la réglementation en vigueur, notamment le Règlement Général sur la Protection des Données (RGPD).</p>

                    <h5 class="mt-3">2. Collecte des données</h5>

                    <p>Les informations que nous collectons sont les suivantes :</p>

                    <p>a) Données que vous nous fournissez directement :</p>

                    <p>[nom, prénom, adresse e-mail]</p>

                    <p>b) Données collectées automatiquement :</p>

                    <p>[cookies]</p>

                    <h5 class="mt-3">3. Utilisation des données</h5>

                    <p>Nous utilisons les données que nous collectons pour :</p>

                    <ul>
                        <li>Vous fournir les informations, produits ou services demandés ;</li>
                        <li>Améliorer notre site Internet et son contenu ;</li>
                        <li>Personnaliser votre expérience utilisateur ;</li>
                        <li>Vous contacter par e-mail, téléphone ou courrier pour vous informer de nos nouveautés, promotions, etc. (vous pouvez vous désabonner à tout moment) ;</li>
                        <li>Analyser l'utilisation de notre site et recueillir des informations statistiques.</li>
                    </ul>
                    <p></p>

                    <h5 class="mt-3">4. Partage des données</h5>

                    <p>Nous ne partagerons pas vos données personnelles avec des tiers sans votre consentement explicite, sauf dans les cas prévus par la loi.</p>

                    <h5 class="mt-3">5. Vos droits</h5>

                    <p>Vous disposez des droits suivants concernant vos données personnelles :</p>

                    <ul>
                        <li>Accéder à vos données et obtenir des informations sur leur utilisation ;</li>
                        <li>Rectifier vos données si elles sont inexactes ou incomplètes ;</li>
                        <li>Effacer vos données dans certaines circonstances ;</li>
                        <li>Vous opposer au traitement de vos données pour des raisons légitimes ;</li>
                        <li>Demander la limitation du traitement de vos données ;</li>
                        <li>Recevoir vos données dans un format structuré, couramment utilisé et lisible par machine (portabilité des données) ;</li>
                        <li>Retirer votre consentement à tout moment lorsque le traitement est basé sur celui-ci.</li>
                    </ul>
                    <p></p>

                    <h5 class="mt-3">6. Sécurité des données</h5>

                    <p>Nous prenons la sécurité de vos données personnelles au sérieux et mettons en place des mesures appropriées pour les protéger contre tout accès, divulgation, altération ou destruction non autorisée.</p>

                    <h5 class="mt-3">7. Modification de la politique de confidentialité</h5>

                    <p>Nous pouvons mettre à jour cette politique de confidentialité à tout moment. Nous vous conseillons de consulter cette page régulièrement pour rester informé des éventuelles modifications.</p>

                    <h5 class="mt-3">8. Nous contacter</h5>

                    <p>Si vous avez des questions, des commentaires ou des demandes concernant cette politique de confidentialité, veuillez nous contacter en <a href="{{ route('mf.contact') }}">cliquant ici</a>.</p>

                    
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