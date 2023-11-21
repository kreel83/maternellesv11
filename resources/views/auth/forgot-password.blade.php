{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Email Password Reset Link') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}



@extends('layouts.parentLayout', ['titre' => 'Réinitialisation du mot de passe', 'menu' => 'item', 'log' => true])

@section('content')

<div class="mb-3 d-flex justify-content-center">
           
  <a href="{{route('vitrine.index')}}" class="brand-logo">
  <img src="{{asset('img/deco/logo.png')}}" alt="" width="250" class="d-bloc mx-auto">
  </a>

</div>    

<div class="card mx-auto w-75">

    <div class="card-body">

        @if (session()->has('status'))
            <div class="alert alert-info">
                <x-auth-session-status class="mb-4" :status="session('status')" />
            </div>
        @endif
        
        <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Validation Errors -->
        @if ($errors->any())
        <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
        </div>
        @endif

        <h4 class="mb-3">Mot de passe oublié ?</h4>

        <p>Indiquez ci-dessous votre adresse e-mail pour recevoir un lien de réinitialisation de votre mot de passe.</p>

        <div class="input-group mb-3">
            <span class="input-group-text bg-light" id="email">@</span>
            <input type="email" class="form-control" id="email" name="email" value="" placeholder="Votre adresse mail" required>
        </div>

        <div class="mb-3 gap-2 d-grid">
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </div>

        </form>

    </div>

</div>

@endsection



{{-- @extends('layouts.mainMenu2', ['titre' => 'Réinitialisation du mot de passe', 'menu' => 'item', 'log' => true])

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
                <div class="col-md-5 col-lg-5 d-none d-md-block h-100">
                    <div style="width: 700px; height: 100%; position: relative; padding-top: 60px">

                        <img src="{{ asset('img/log/lock.png') }}"
                        alt="login form" width="500px" height="500px" style="border-radius: 1rem 0 0 1rem;" />
                    </div>
                  
                  <!--
                  <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img1.webp"
                    alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                  -->
                </div>
            
              <div class="col-md-7 col-lg-7 d-flex align-items-center p-5" style="background-color: var(--main-color); color: white !important">
                <div class="card-body p-4 p-lg-5"  >
  
                  <x-auth-session-status class="mb-4" :status="session('status')" />
  
                  <form method="POST" action="{{ route('password.email') }}">
                  @csrf
  
                    <!-- <div class="d-flex align-items-center mb-3 pb-1">
                        <img src="{{ asset('img/vitrine/logo/logoV2.png') }}"
                        style="width: 150px;" alt="logo">
                    </div> -->
                    <!-- Validation Errors -->
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
  
                    <h2 class="mb-3 pb-3" style="letter-spacing: 1px;font-size: 36px; color: white; font-weight: bolder">Mot de passe oublié ?</h2>
  

                    <div class="icone-input-login my-4">
                      <i class="fa-solid fa-key"></i>
                      <input type="email" class="custom-input" id="email" name="email" value="" placeholder="Votre adresse mail" />
                    </div> 


                    
                    <div class="pt-1 mb-4">
                      <button type="submit" class="btnLogin btn-block">Envoyer</button>
                    </div>

  
                  </form>
  
                </div>
              </div>
          
        </div>
      </div>
    </div>
  </section>


@endsection --}}
