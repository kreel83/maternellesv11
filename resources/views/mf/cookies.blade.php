@extends('layouts.mf')

@section('seo')
    <title>Politique en matière de cookies</title>
    <meta name="description" content="La politique en matière de cookies du site internet {{ config('app.name') }}">
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
    <section class="inner-page banner" data-img="{{asset('assets/images/inner/banner-legal.jpg')}}">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="content text-center mx-auto titre_banner">
                            <h2>Utilisation des Cookies</h2>

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
                        <h2>Utilisation des Cookies</h2>
                        {{-- <p>En vigueur au 01/01/2024</p> --}}
                    </div>
                </div>
                <div class="col-lg-12">

                    <p>Vous avez la possibilité d'accepter ou non l'utilisation de cookies avant de naviguer sur le site internet {{ config('app.url') }} à l'exception des Cookies strictement nécessaires.</p>
                    <p>Pour toute question, vous pouvez nous contacter via notre <a href="{{ route('mf.contact') }}">formulaire de contact</a>.</p>
                    <br>
                    <p><strong>Information sur les cookies</strong></p>
                    <p>Les cookies permettent de stocker des petites quantités de données sur votre ordinateur en fonction des sites internet. Ils sont de différents types :</p>
                    <ul>
                    <li>- Permanent ou de session, respectivement d'une durée de stockage longue ou limitée à l'exécution de votre navigateur.</li>
                    <li>- Internes ou tiers, respectivement liés à notre site internet ou aux services tiers que nous intégrons sur notre site internet.</li>
                    </ul>
                    <br>
                    <p><strong>Acception des cookies lors de la première visite</strong></p>
                    <p>Si nous ne détectons pas de cookie interne lors de votre visite sur nos sites internet nous vous proposerons d'accepter ou non l'utilisation des cookies.</p>


                    <p class="mt-3"><strong>Désactivation des cookies sur votre navigateur</strong></p>
                    <p>Vous pouvez modifier le paramétrage des cookies dans votre navigateur.</p>
                    <p>Internet Explorer : <a href="https://support.microsoft.com/fr-fr/help/17442/windows-internet-explorer-delete-manage-cookies" target="_blank">https://support.microsoft.com/fr-fr/help/17442/windows-internet-explorer-delete-manage-cookies</a></p>
                    <p>Google Chrome : <a href="https://support.google.com/chrome/answer/95647?hl=fr" target="_blank">https://support.google.com/chrome/answer/95647?hl=fr</a></p>
                    <p>Safari : <a href="https://support.apple.com/kb/index?page=search&type=organic&src=support_searchbox_main&locale=fr_FR&q=cookie" target="_blank">https://support.apple.com/kb/index?page=search&type=organic&src=support_searchbox_main&locale=fr_FR&q=cookie</a></p>
                    <p>Firefox : <a href="https://support.mozilla.org/fr/products/firefox/protect-your-privacy/cookies" target="_blank">https://support.mozilla.org/fr/products/firefox/protect-your-privacy/cookies</a></p>

                    <p class="mt-3"><strong>Utilisation des cookies sur {{ config('app.name') }}</strong></p>
                    <p>
                    <strong>Cookie internes permanent</strong><br>
                    - Cookie de stockage du consentement (strictement nécessaire)<br>
                    <strong>Cookie internes de session</strong><br>
                    - Cookie d'identification de session PHP (strictement nécessaire)<br>
                    <strong>Cookie tiers</strong><br>
                    Aucun<br>
                    </p>

                    <p class="mt-3"><strong>Cookies strictement nécessaires</strong></p>
                    <p>Ces cookies sont indispensables au bon fonctionnement de nos sites internet et ne peuvent pas être désactivés. Si vous décidez de les bloquer, certaines parties de nos sites internet ne pourront pas fonctionner.</p>
                    
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