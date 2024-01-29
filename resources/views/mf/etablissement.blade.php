@extends('layouts.mf')

@section('seo')
    <title>Liste des établissements référencés dans {{ env('APP_NAME') }}</title>
    <meta name="description" content="Liste des établissements scolaires référencés dans l'application {{ env('APP_NAME') }}">
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
                        <div class="content text-center">
                            <h2>Les établissements référencés</h2>

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
                        <h2>Les établissements référencés</h2>
                    </div>
                </div>
                <div class="col-lg-12">

                    <label class="mb-2" for="searchSchool" style="font-size:1.2em;">Chercher votre établissement parmi plus de 36,000 établissements référencés dans l'application {{ env('APP_NAME') }} :</label>
                    <div class="d-flex">
                        <input type="text" class="form-control" name="searchSchool" id="searchSchool" placeholder="Code établissement, code postal, nom école, ville...">
                        <a class="btn btn-primary boutonSearchSchool">Lancer la recherche</a>
                    </div>

                    <div id="afficheLaListeDesEtablissements" class="mt-3"></div>
                   
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