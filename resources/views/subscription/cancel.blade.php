@extends('layouts.mainMenu2', ['titre' => 'Abonnement', 'menu' => 'resilier'])



@section('content')

<style>
  .card_login {
    width: 800px;
    height: 600px;
    background-color: white;
  }
</style>

<div class="container my-5 page" id="">

    <nav class="pb-4" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('depart')}}">Tableau de bord</a></li>        
        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('subscribe.index') }}">Mon abonnement</a></li>
        <li class="breadcrumb-item active" aria-current="page">Résilier mon abonnement</li>
        </ol>
    </nav>

    <div class="card mx-auto w-75">
        <div class="card-body">
            <h4 class="card-title mb-3">Résilier mon abonnement</h4>

            @if($onGracePeriode)
                <p>Votre abonnement est maintenant résilié.</p>
                <p>Il restera toutefois actif jusqu'au {{ Carbon\Carbon::parse($finsouscription)->format('d/m/Y')}} et pourra être réactivé à tout moment jusqu'à cette date.</p>        
                <div class="mt-4">
                    <a href="{{ route('subscribe.index') }}">Retour à mon abonnement</a>
                </div>
            @else
                <p>Notre service ne correspond pas à vos attentes ? Aucun problème, vous pouvez résilier votre abonnement en 1 clic.</p>
                <p>Il restera toutefois actif jusqu'au {{ Carbon\Carbon::parse($finsouscription)->format('d/m/Y')}}.</p>

                <div class="d-flex flex-row mt-4">
                    <div class="me-3">
                        <a class="btn btn-outline-secondary" href="{{ route('subscribe.index') }}">Annuler</a>
                    </div> 
                    <div>
                        <a href="{{ route('subscribe.cancelsubscription') }}" class="btn btn-primary">Résilier mon abonnement</a>
                    </div>
                </div>
            @endif

        </div>
    </div>
  
</div>


    
      {{-- <div class="d-flex justify-content-center align-items-center h-100">
        
          <div class="card_login" style="border-radius: 1rem; overflow: hidden">
            <div class="row g-0 h-100">
                <div class="col-md-5 col-lg-5 d-none d-md-block h-100 position-relative">
                    <div style="width: 400px; height: 400px; position: absolute; bottom: 0; left: 0">

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
  
                    <h3 class="text-center">Résilier mon abonnement</h3>

                    @if($onGracePeriode)
                        <p class="text-center">Votre abonnement est maintenant résilié.</p>
                        <p class="text-center">Il restera toutefois actif jusqu'au {{ Carbon\Carbon::parse($finsouscription)->format('d/m/Y')}} et pourra être réactivé à tout moment jusqu'à cette date.</p>        
                        <div class="mt-4 text-center">
                            <a href="{{ route('subscribe.index') }}">Retour à mon abonnement</a>
                        </div>
                    @else
                        <p class="text-center">Notre service ne correspond pas à vos attentes ? Aucun problème, vous pouvez résilier votre abonnement en 1 clic.</p>
                        <p class="text-center">Il restera toutefois actif jusqu'au {{ Carbon\Carbon::parse($finsouscription)->format('d/m/Y')}}.</p>
                        <div class="text-center">
                            <a href="{{ route('subscribe.cancelsubscription') }}" class="btn btn-primary">Résilier mon abonnement</a>
                        </div>
                        <div class="mt-4 text-center">
                            <a href="{{ route('subscribe.index') }}">Annuler</a>
                        </div> 
                    @endif
  
                </div>
              </div>
          
        </div>
      </div>
    </div> --}}



@endsection







