@extends('layouts.login')

@section('content')



<section class="vh-100" style="background-color: #9A616D;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
          <div class="card" style="border-radius: 1rem;">
            <div class="row g-0">
              <div class="col-md-6 col-lg-5 d-none d-md-block">
                <img src="{{ asset('img/login1.jpg') }}"
                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                
                <!--
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img1.webp"
                  alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                -->
              </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">

                  <x-auth-session-status class="mb-4" :status="session('status')" />
  
                  <form action="{{ route('login') }}" method="post">
                  @csrf
  
                    <div class="d-flex align-items-center mb-3 pb-1">
                        <img src="{{ asset('img/vitrine/logo/logoV2.png') }}"
                        style="width: 150px;" alt="logo">
                    </div>
  
                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Connecter vous à votre compte</h5>
  
                    <div class="form-outline mb-4">
                      <input type="email" id="email" name="email" class="form-control form-control-lg"  placeholder="Adresse e-mail"/>
                      <!--<label class="form-label" for="form2Example17">Email address</label>-->
                    </div>
  
                    <div class="form-outline mb-4">
                      <input type="password" id="password" name="password" class="form-control form-control-lg"  placeholder="Mot de passe" />
                      <!--<label class="form-label" for="form2Example27">Password</label>-->
                    </div>
  
                    <div class="pt-1 mb-4">
                      <button class="btn btn-dark btn-lg btn-block">Se connecter</button>
                    </div>
  
                    <a class="small text-muted" href="#!">Mot de passe oublié ?</a>
                    <p class="mb-5 pb-lg-2" style="color: #393f81;">Vous n'avez pas de compte ? <a href="#!"
                        style="color: #393f81;">Créer un compte</a></p>
                    <a href="#!" class="small text-muted">Conditions d'utilisation</a> | 
                    <a href="#!" class="small text-muted">Politique de confidentialité</a>
                  </form>
  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>





















@endsection