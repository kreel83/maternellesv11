@extends('layouts.mainMenu', ['titre' => 'Mes fiches', 'menu' => 'item', 'log' => true])

@section('content')

<style>
  .card_login {
    width: 1200px;
    height: 75vh;
    background-color: white;
  }
</style>

<section class="vh-100 vw-100">
    
      <div class="d-flex justify-content-center align-items-center h-100">
        
          <div class="card_login" style="border-radius: 1rem; overflow: hidden">
            <div class="row g-0 h-100">
              <div class="col-md-5 col-lg-5 d-flex align-items-center p-5" style="background-color: var(--main-color); color: white !important">
                <div class="card-body p-4 p-lg-5"  >
  
                  <x-auth-session-status class="mb-4" :status="session('status')" />
  
                  <form action="{{ route('login') }}" method="post">
                  @csrf
  
                    {{-- <div class="d-flex align-items-center mb-3 pb-1">
                        <img src="{{ asset('img/vitrine/logo/logoV2.png') }}"
                        style="width: 150px;" alt="logo">
                    </div> --}}
  
                    <h2 class="mb-3 pb-3" style="letter-spacing: 1px;font-size: 36px; color: white; font-weight: bolder">Bienvenue</h2>
  
                    <div class="icone-input-login my-4">
                      <i class="fa-solid fa-user"></i>
                      <input type="email" class="custom-input" id="email" name="email" value="" placeholder="Identifiant" />
                    </div> 
                    <div class="icone-input-login my-4">
                      <i class="fa-solid fa-key"></i>
                      <input type="password" class="custom-input" id="password" name="password" value="" placeholder="Mot de passe" />
                    </div> 
                    <small><a href="{{route('password.request')}}">Mot de passe oublié ?</a></small>

                    
                    <div class="pt-1 mb-4">
                      <button class="btnLogin btn-block">Se connecter</button>
                    </div>

  

  
                    
                    <p class="mb-5" style="color: white;">Vous n'avez pas de compte ? <a href="#!"
                        style="color: white;">Créer un compte</a></p>
                    {{-- <a href="#!" class="small text-muted">Conditions d'utilisation</a> | 
                    <a href="#!" class="small text-muted">Politique de confidentialité</a> --}}
                  </form>
  
                </div>
              </div>
              <div class="col-md-7 col-lg-7 d-none d-md-block h-100">
                <img src="{{ asset('img/log/img_login.png') }}"
                alt="login form" width="100%" height="100%" style="border-radius: 1rem 0 0 1rem;" />
                
                <!--
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img1.webp"
                  alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                -->
              </div>
          
          
        </div>
      </div>
    </div>
  </section>





















@endsection