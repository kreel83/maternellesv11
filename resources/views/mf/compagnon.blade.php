@extends('layouts.mf')

@section('seo')
    <title>Le Compagnon : l'application mobile pour {{ env('APP_NAME') }}</title>
    <meta name="description" content="Le compagnon est le complément de votre application {{ env('APP_NAME') }} et permet l'évaluation des élèves en classe">
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
    <section class="inner-page banner" data-img="{{asset('assets/images/inner/banner-bg6.jpg')}}">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="content text-center">
                            <h2>Le compagnon</h2>

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
                        <h2>L'application mobile qui vous suit partout</h2>
                        <p>L'application mobile disponible sur Google Play et App Store, vous permet d'évaluer vos élèves tout au long de la journée de classe depuis votre mobile ou une tablette.</p>
                    </div>
                </div>
                {{-- <div class="col-lg-12">
                    <div class="row align-items-center">
                        <div class="col-lg-5">
                            <div class="image text-center wow fadeInLeft" data-wow-delay="0.3s" data-wow-duration="1s">
                                <img src="/assets/images/inner/compagnon.jpg" alt="Le compagnon">
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="content wow fadeInRight" data-wow-delay="0.3s" data-wow-duration="1s">
                                <h3>Je créé ma classe</h3>
                                <p></p>
                                <ul>
                                    <li class="d-flex">
                                        <div class="icon">
                                            <i class="flaticon-ribbon"></i>
                                        </div>
                                        <div class="text">
                                            <h6>Accessible 7/7 24/24H avec une connection Internet</h6>
                                            <p></p>
                                        </div>
                                    </li>
                                    <li class="d-flex">
                                        <div class="icon">
                                            <i class="flaticon-24-hours"></i>
                                        </div>
                                        <div class="text">
                                            <h6>Connection cryptée et sécurisée</h6>
                                            <p></p>
                                        </div>
                                    </li>
                                    <li class="d-flex">
                                        <div class="icon">
                                            <i class="flaticon-24-hours"></i>
                                        </div>
                                        <div class="text">
                                            <h6>Stockage des données sécurisé dans notre Datacenter</h6>
                                            <p></p>
                                        </div>
                                    </li>
                                    <li class="d-flex">
                                        <div class="icon">
                                            <i class="flaticon-24-hours"></i>
                                        </div>
                                        <div class="text">
                                            <h6>Mises à niveau régulières pour un service au Top</h6>
                                            <p></p>
                                        </div>
                                    </li>
                                    <li class="d-flex">
                                        <div class="icon">
                                            <i class="flaticon-24-hours"></i>
                                        </div>
                                        <div class="text">
                                            <h6>Disponible pour les appareils Android et Apple</h6>
                                            <p></p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div> --}}

                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6">
                            <div class="item wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="1s">
                                <div class="icon">
                                    <i class="flaticon-setup"></i>
                                </div>
                                <span>01</span>
                                <h5>Disponibilité</h5>
                                <p>Accessible 7/7 24/24H avec une connection Internet</p>
                                {{-- <a href="service-detail.html"><i class="flaticon-arrow-pointing-to-right"></i></a> --}}
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="item wow fadeInUp" data-wow-delay="0.4s" data-wow-duration="1s">
                                <div class="icon">
                                    <i class="flaticon-mobile-app-developing"></i>
                                </div>
                                <span>02</span>
                                <h5>Sécurité</h5>
                                <p>Connection cryptée et sécurisée entre votre appareil et notre serveur</p>
                                {{-- <a href="service-detail.html"><i class="flaticon-arrow-pointing-to-right"></i></a> --}}
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="item wow fadeInUp" data-wow-delay="0.6s" data-wow-duration="1s">
                                <div class="icon">
                                    <i class="flaticon-technology"></i>
                                </div>
                                <span>03</span>
                                <h5>Confidentialité</h5>
                                <p>Stockage des données sécurisé dans notre Datacenter</p>
                                {{-- <a href="service-detail.html"><i class="flaticon-arrow-pointing-to-right"></i></a> --}}
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="item wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="1s">
                                <div class="icon">
                                    <i class="flaticon-mobile-app-developing"></i>
                                </div>
                                <span>04</span>
                                <h5>Evolutivité</h5>
                                <p>Mises à niveau régulières de l'application mobile sans intervention de votre part</p>
                                {{-- <a href="service-detail.html"><i class="flaticon-arrow-pointing-to-right"></i></a> --}}
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="item wow fadeInUp" data-wow-delay="0.4s" data-wow-duration="1s">
                                <div class="icon">
                                    <i class="flaticon-technology"></i>
                                </div>
                                <span>05</span>
                                <h5>Temps réel</h5>
                                <p>Données mises à jour instantanément dans votre compte {{ env('APP_NAME') }}</p>
                                {{-- <a href="service-detail.html"><i class="flaticon-arrow-pointing-to-right"></i></a> --}}
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="item wow fadeInUp" data-wow-delay="0.6s" data-wow-duration="1s">
                                <div class="icon">
                                    <i class="flaticon-setup"></i>
                                </div>
                                <span>06</span>
                                <h5>Tous systèmes</h5>
                                <p>Disponible pour les appareils fonctionnant sous Android et Apple</p>
                                {{-- <a href="service-detail.html"><i class="flaticon-arrow-pointing-to-right"></i></a> --}}
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-around mt-5">
                        
                        <img src="/assets/images/inner/google-play-badge.png" alt="Disponible sur Google Play" class="img-fluid">
                        <img src="/assets/images/inner/appstore.png" alt="Disponible sur APP Store" class="img-fluid">

                    </div>


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