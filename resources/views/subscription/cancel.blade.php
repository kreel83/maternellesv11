@extends('layouts.mainMenu2', ['titre' => 'Abonnement', 'menu' => 'resilier'])



@section('content')

<style>
  .card_login {
    width: 800px;
    height: 600px;
    background-color: white;
  }
</style>


    
      <div class="d-flex justify-content-center align-items-center h-100">
        
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
                            <a href="{{ route('depart') }}">Retour</a>
                        </div> 
                    @else
                        <p class="text-center">Notre service ne correspond pas à vos attentes ? Aucun problème, vous pouvez résilier votre abonnement en 1 clic.</p>
                        <p class="text-center">Il restera toutefois actif jusqu'au {{ Carbon\Carbon::parse($finsouscription)->format('d/m/Y')}}.</p>
                        <div class="text-center">
                            <a href="{{ route('subscribe.cancelsubscription') }}" class="btn btn-primary">Résilier mon abonnement</a>
                        </div>
                        <div class="mt-4 text-center">
                            <a href="{{ route('depart') }}">Annuler</a>
                        </div> 
                    @endif
  
                </div>
              </div>
          
        </div>
      </div>
    </div>



@endsection







