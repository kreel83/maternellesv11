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
    <section class="inner-page banner" data-img="{{asset('assets/images/inner/banner_contact.png')}}">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="content text-center">
                            <h2>nous contacter</h2>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end banner area -->

    <!-- start contact area -->
    <section class="contact-page contact p-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="content wow fadeInLeft" data-wow-delay="0.3s" data-wow-duration="1s">

                        <h6>Nous contacter</h6>
                        <h2>Confirmation de votre demande</h2>

                        <p>Nous vous remercions de nous avoir contactés. Nous vous répondrons dans les meilleurs délais.</p>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end contact area -->





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