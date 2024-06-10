{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Reset Password') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}

@extends('layouts.template1', ['titre' => 'Réinitialisation du mot de passe'])

@section('content')

  <div class="card mx-auto w-75">

      <div class="card-body">

          @if (session()->has('status'))
              <div class="alert alert-info">
                  <x-auth-session-status class="mb-4" :status="session('status')" />
              </div>
          @endif
          
          <form method="POST" action="{{ route('password.update') }}">
          @csrf

          <!-- Password Reset Token -->
          <input type="hidden" name="token" value="{{ $request->route('token') }}">

          <!-- Validation Errors -->
          @if ($errors->any())
          <div class="alert alert-danger">
                  @foreach ($errors->all() as $error)
                      {{ $error }}<br>
                  @endforeach
          </div>
          @endif

          <h4 class="mb-3">Réinitialisation du mot de passe</h4>
          
          <p>Indiquez ci-dessous votre adresse mail ainsi que votre nouveau mot de passe.
            <br>
            <small style="color: orangered">Le mot de passe doit contenir entre 9 et 20 caractères et inclure au moins une minuscule, une majuscule, un chiffre et un caractère spécial </small>
          </p>
          
          <!-- Email Address -->
          <div class="input-group mb-3">
              <span class="input-group-text bg-light" id="email"><i class="fa-solid fa-envelope"></i></span>
              <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $request->email) }}" placeholder="Votre adresse mail" required>
          </div>

          <!-- Password -->
          <div class="input-group mb-3">
            <span class="input-group-text bg-dark" id="password"><i class="fa-solid fa-key"></i></span>
            <input type="password" class="form-control" id="password" name="password" placeholder="Nouveau mot de passe" required>
          </div>

          <!-- Confirm Password -->
          <div class="input-group mb-3">
            <span class="input-group-text bg-dark" id="password_confirmation"><i class="fa-solid fa-key"></i></span>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirmation du mot de passe" required>
          </div>

          <div class="mb-3 gap-2 d-grid">
              <button type="submit" class="btnAction" style="width:100%">Envoyer</button>
          </div>

          </form>

      </div>

  </div>

@endsection





{{-- @extends('layouts.mainMenu2', ['titre' => 'Mes fiches', 'menu' => 'item', 'log' => true])

@section('content')

<style>
  .card_login {
    width: 75%;
    height: 75vh;
    background-color: white;
  }
</style>

<section class="vh-100 vw-100">
    
      <div class="d-flex justify-content-center align-items-center h-100">
        
          <div class="card_login" style="border-radius: 1rem; overflow: hidden">
            <div class="row g-0 h-100">
                <div class="col-md-5 col-lg-5 d-none d-md-block h-100">
                    <div style="width: 700px; height: 100%; position: relative">

                        <img src="{{ asset('img/log/img_reset_password.png') }}"
                        alt="login form" width="100%" height="100%" style="border-radius: 1rem 0 0 1rem;" />
                    </div>
                  
                  <!--
                  <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img1.webp"
                    alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                  -->
                </div>
            
              <div class="col-md-7 col-lg-7 d-flex align-items-center p-5" style="background-color: var(--main-color); color: white !important">
                <div class="card-body p-4 p-lg-5"  >
  
                  <x-auth-session-status class="mb-4" :status="session('status')" />
  
                  <!-- <form action="{{ route('admin.sauverLeMotDePasse') }}" method="post"> -->
                    <form action="{{ route('password.update') }}" method="post">
                  @csrf

                  @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
                  @endif

                  <!-- <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <div class="d-flex align-items-center mb-3 pb-1">
                        <img src="{{ asset('img/vitrine/logo/logoV2.png') }}"
                        style="width: 150px;" alt="logo">
                    </div> -->
  
                    <h2 class="mb-3 pb-3" style="letter-spacing: 1px;font-size: 36px; color: white; font-weight: bolder">Réinitialisation du mot de passe</h2>
  

 
                    
                    <div class="icone-input-login my-4">
                      <i class="fa-solid fa-key"></i>
                      <input type="password" class="custom-input" id="password" name="password" value="" placeholder="Nouveau mot de passe" />
                    </div> 
                    <div class="icone-input-login my-4">
                      <i class="fa-solid fa-key"></i>
                      <input type="password" class="custom-input" id="password_confirmation" name="password_confirmation" value="" placeholder="Confirmation du nouveau mot de passe" />
                    </div> 

                    
                    <div class="pt-1 mb-4">
                      <button class="btnLogin btn-block">Envoyer</button>
                    </div>

  
                  </form>
  
                </div>
              </div>
          
        </div>
      </div>
    </div>
  </section>


@endsection --}}
