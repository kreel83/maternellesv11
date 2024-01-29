@extends('layouts.mf')

@section('seo')
    <title>Les tarifs de l'application {{ env('APP_NAME') }}</title>
    <meta name="description" content="Les Maternelles est un service en ligne pour optimiser la gestion d'une classe de maternelle">
@endsection

@section('content')
    <section class="inner-page banner" data-img="{{asset('assets/images/inner/banner-bg2.png')}}">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="content text-center">
                            <h2>Tarification</h2>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end banner area -->

    <!-- start pricing area -->
    <section class="home2 pricing p-120">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                    <div class="section-title wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="1s">
                        <h2>un prix unique <br> un abonnement sécurisé</h2>
                        <p>Votre application complète vous est proposée au prix de {{ env('PRIX_ABONNEMENT') }} € TTC</p>
                        <p>Les abonnements se font par carte bancaire ou par PayPal</p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-lg-4 col-md-6">
                            <div class="item text-center wow fadeInLeft" data-wow-delay="0.2s" data-wow-duration="1s">
                                <div class="price-title">
                                    <h5>DECOUVERTE</h5>
                                   
                                </div>
                                <ul>
                                    <li><i class="fas fa-check"></i>10 évaluations par classe</li>
                                    <li><i class="fas fa-check"></i>Accès à toute les fonctionnalités de l'application</li>

                                </ul>
                                <div class="purchase">
                                    <h3>Gratuit</h3>
                                    <a href="{{ route('registration.start') }}">Je teste</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="item text-center active wow fadeInUp" data-wow-delay="0.4s" data-wow-duration="1s">
                                <div class="price-title">
                                    <span>PREMIUM</span>
                                  
                                    <!-- <h4>"business"</h4> -->
                                </div>
                                <ul>
                                    <li><i class="fas fa-check"></i>Evaluation illimités</li>
                                    <li><i class="fas fa-check"></i>Accès à toute les fonctionnalités de l'application</li>

                                </ul>
                                <div class="purchase">
                                    <h3>{{ env('PRIX_ABONNEMENT') }} € / an <span>TTC</span></h3>
                                    <a href="{{ route('registration.start') }}">je m'abonne</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end pricing area -->



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

    <!-- start custom cursor area -->
    <div class="custom-cursor">
        <div id="cursor">
          <div id="cursor-ball"></div>
        </div>
    </div>
    <!-- end custom cursor area -->


@endsection