@extends('layouts.login')

@section('content')

<style>
.gradient-custom-2 {
/* fallback for old browsers */
background: #fccb90;

/* Chrome 10-25, Safari 5.1-6 */
/background: -webkit-linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
}

@media (min-width: 768px) {
.gradient-form {
height: 100vh !important;
}
}
@media (min-width: 769px) {
.gradient-custom-2 {
border-top-right-radius: .3rem;
border-bottom-right-radius: .3rem;
}
}

</style>

<div id="loginform">

<section class="h-100 gradient-form" style="b_ackground-color: #eee;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-xl-10">
          <div class="card rounded-3 text-black">
            <div class="row g-0">
              <div class="col-lg-6">
                <div class="card-body p-md-5 mx-md-4">
  
                  <div class="text-center mb-4">
                    <img src="{{ asset('img/vitrine/logo/logoV2.png') }}"
                      style="width: 185px;" alt="logo">
                    <!--<h4 class="mt-1 mb-5 pb-1">We are The Lotus Team</h4>-->
                  </div>
  
                  <form>
                    <p>Connectez vous à votre compte</p>
  
                    <div class="form-outline mb-4">
                      <input type="email" id="form2Example11" class="form-control"
                        placeholder="Adresse e-mail" />
                      <!--<label class="form-label" for="form2Example11">Username</label>-->
                    </div>
  
                    <div class="form-outline mb-4">
                      <input type="password" id="form2Example22" class="form-control" 
                      placeholder="Mot de passe"/>
                      <!--<label class="form-label" for="form2Example22">Password</label>-->
                    </div>
  
                    <div class="text-center pt-1 mb-2 pb-1">
                      <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="button">Se connecter</button>
                    </div>

                    <div class="text-center pt-1 mb-3 pb-1">
                      @if (Route::has('password.request'))
                      <a class="text-muted" href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                      @endif
                    </div>
  
                    <div class="d-flex align-items-center justify-content-center pb-4">
                      <p class="mb-0 me-2">Vous n'avez pas de compte ?</p>
                      <a href="{{ route('registration.start') }}" class="btn btn-outline-danger">Créer un compte</a>
                    </div>
  
                  </form>
  
                </div>
              </div>
              <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                  <h4 class="mb-4">Nous sommes plus qu'un service</h4>
                  <p class="small mb-0"><q> Pour apprendre à lire, il faut d'abord lire très lentement et ensuite il faut lire très lentement et, toujours, jusqu'au dernier livre qui aura l'honneur d'être lu par vous, il faudra lire très lentement. </q></p>
                  <p class="small mb-0 mt-2"><i>Emile Faguet</i></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>




</div>










@endsection