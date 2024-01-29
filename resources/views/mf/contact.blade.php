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
                        <div class="content text-center mx-auto titre_banner">
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
                <div class="col-lg-6">
                    <div class="content wow fadeInLeft" data-wow-delay="0.3s" data-wow-duration="1s">
                        <h6>Nous contacter</h6>
                        <h2>Envoyez nous votre message</h2>

                        <p>Notre équipe est à votre service du lundi au vendredi de 9H à 17H. Nous nous efforçons de répondre dans les plus brefs délais.</p>
                        {{-- <form action="#!">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" placeholder="Votre nom" required class="inputs">
                                </div>
                                <div class="col-md-12">
                                    <input type="email" placeholder="Votre adresse mail*" required class="inputs">
                                </div>
                                <div class="col-md-12">
                                    <input type="tel" placeholder="Votre numéro de téléphone" required class="inputs">
                                </div>
                                <div class="col-md-12">
                                    <input type="text" placeholder="website*" required class="inputs">
                                </div>
                                <div class="col-md-12">
                                    <button type="submit">submit now</button>
                                </div>
                            </div>
                        </form> --}}
                    </div>
                </div>
                <div class="col-xl-5 offset-xl-1 col-lg-6">
                    <div class="content address wow fadeInRight" data-wow-delay="0.3s" data-wow-duration="1s">
                        
                        @include('include.display_msg_error')

                        <form action="{{ route('mf.contact.send') }}" method="post">
                        @csrf
                        <div class="col-md-12">
                            <input type="email" name="email" placeholder="Votre adresse mail*" required class="inputs" value="{{ old('email') }}">
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="name" placeholder="Votre nom" class="inputs" value="{{ old('name') }}">
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="phone" placeholder="Téléphone" class="inputs" value="{{ old('phone') }}">
                        </div>
                        </div>
                        <div class="col-md-12">
                            <input type="text" name="subject" placeholder="Objet du message*" required class="inputs" value="{{ old('subject') }}">
                        </div>
                        <div class="col-md-12">
                            <textarea class="inputs" name="message" placeholder="Votre message*" required>{{ old('message') }}</textarea>
                            {{-- <input type="text" placeholder="Votre message*" required class="inputs"> --}}
                        </div>
                        <div class="col-md-12">
                            <button type="submit">Envoyer</button>
                        </div>
                        {{-- <h3>Get Answers Advices</h3>
                        <ul>
                            <li class="d-flex">
                                <div class="icon">
                                    <i class="far fa-map"></i>
                                </div>
                                <div class="text">
                                    <h5>Address</h5>
                                    <p>1650 Lombard Street,</p>
                                    <p>San Francisco, CA 94123</p>
                                </div>
                            </li>
                            <li class="d-flex">
                                <div class="icon">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div class="text">
                                    <h5>phone</h5>
                                    <p>+1 (415) 876-3250</p>
                                    <p>+1 (415) 876-3251</p>
                                </div>
                            </li>
                            <li class="d-flex">
                                <div class="icon">
                                    <i class="far fa-envelope"></i>
                                </div>
                                <div class="text">
                                    <h5>E-mail</h5>
                                    <p>demo@example.com</p>
                                </div>
                            </li>
                        </ul> --}}
                        </form>
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