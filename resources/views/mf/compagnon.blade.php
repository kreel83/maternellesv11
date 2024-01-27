@extends('layouts.mf')

@section('seo')
    <title>Gestion de votre classe de maternelle en ligne</title>
    <meta name="description" content="Les Maternelles est un service en ligne pour optimiser la gestion d'une classe de maternelle">
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
    <section class="inner-page banner" data-img="{{asset('assets/images/inner/banner-bg3.png')}}">
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
                        <h2>our services</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod te incididunt ut labore et dolore magna aliqua. Ut enim ad minim to eismud </p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6">
                            <div class="item wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="1s">
                                <div class="icon">
                                    <i class="flaticon-setup"></i>
                                </div>
                                <span>01</span>
                                <h5>social marketing</h5>
                                <p>Lorem ipsum dolor sit amet, co adipisicing elit, sed do eiusmod tempor incididunt uty labore et dolore magna aliqua. Ut enimd minim veniam, quis nostrud</p>
                                <a href="service-detail.html"><i class="flaticon-arrow-pointing-to-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="item wow fadeInUp" data-wow-delay="0.4s" data-wow-duration="1s">
                                <div class="icon">
                                    <i class="flaticon-mobile-app-developing"></i>
                                </div>
                                <span>02</span>
                                <h5>prepare daily report</h5>
                                <p>Lorem ipsum dolor sit amet, co adipisicing elit, sed do eiusmod tempor incididunt uty labore et dolore magna aliqua. Ut enimd minim veniam, quis nostrud</p>
                                <a href="service-detail.html"><i class="flaticon-arrow-pointing-to-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="item wow fadeInUp" data-wow-delay="0.6s" data-wow-duration="1s">
                                <div class="icon">
                                    <i class="flaticon-technology"></i>
                                </div>
                                <span>03</span>
                                <h5>analysis your data</h5>
                                <p>Lorem ipsum dolor sit amet, co adipisicing elit, sed do eiusmod tempor incididunt uty labore et dolore magna aliqua. Ut enimd minim veniam, quis nostrud</p>
                                <a href="service-detail.html"><i class="flaticon-arrow-pointing-to-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="item wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="1s">
                                <div class="icon">
                                    <i class="flaticon-mobile-app-developing"></i>
                                </div>
                                <span>04</span>
                                <h5>prepare daily tasks</h5>
                                <p>Lorem ipsum dolor sit amet, co adipisicing elit, sed do eiusmod tempor incididunt uty labore et dolore magna aliqua. Ut enimd minim veniam, quis nostrud</p>
                                <a href="service-detail.html"><i class="flaticon-arrow-pointing-to-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="item wow fadeInUp" data-wow-delay="0.4s" data-wow-duration="1s">
                                <div class="icon">
                                    <i class="flaticon-technology"></i>
                                </div>
                                <span>05</span>
                                <h5>analysis all data</h5>
                                <p>Lorem ipsum dolor sit amet, co adipisicing elit, sed do eiusmod tempor incididunt uty labore et dolore magna aliqua. Ut enimd minim veniam, quis nostrud</p>
                                <a href="service-detail.html"><i class="flaticon-arrow-pointing-to-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="item wow fadeInUp" data-wow-delay="0.6s" data-wow-duration="1s">
                                <div class="icon">
                                    <i class="flaticon-setup"></i>
                                </div>
                                <span>06</span>
                                <h5>social analysis</h5>
                                <p>Lorem ipsum dolor sit amet, co adipisicing elit, sed do eiusmod tempor incididunt uty labore et dolore magna aliqua. Ut enimd minim veniam, quis nostrud</p>
                                <a href="service-detail.html"><i class="flaticon-arrow-pointing-to-right"></i></a>
                            </div>
                        </div>
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