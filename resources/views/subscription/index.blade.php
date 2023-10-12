@extends('layouts.mainMenu2', ['titre' => 'Détail de mon abonnement', 'menu' => 'abonnement'])


@section('content')

<style>
  .card_login {
    width: 800px;
    height: 600px;
    background-color: white;
  }
</style>

<h3>Détail de mon abonnement</h3>

{{--@if (!$is_abonne)--}}
@if ($status != 'actif')
    <p>Vous n'avez pas d'abonnement en cours.</p>
    <p><a href="{{ route('subscribe.cardform') }}">Je souhaite m'abonner au service <i>{{ env('APP_NAME') }}</i></a></p>
@else
    <p>Statut : {{ $status }}</p>
                    
    @if($status == 'actif')
        <p>Votre abonnement se terminera le {{ Carbon\Carbon::parse($expirationDate)->format('d/m/Y')}}.</p>
    @endif

    <p>{{ $message }}</p>
    <p>{{ $msgIfCanceled }}</p>
@endif

@if($licenceType == 'self' && $status == 'actif')

  @if($onGracePeriode)
    <a class="btn btn-primary" href="{{ route('subscribe.resume') }}">Réactiver mon abonnement</a>
  @else
    <a class="btn btn-primary" href="{{ route('subscribe.cancel') }}">Résilier mon abonnement</a>
  @endif

@endif

@if($invoices > 0)
  <a class="btn btn-primary" href="{{ route('subscribe.invoice') }}">Mes factures</a>
@endif

    
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
  
                    <h3>Détail de mon abonnement</h3>
                    <br><br>

                    <p>Statut : {{ $status }}</p>
                    
                    @if($status == 'actif')
                        <p>Votre abonnement se terminera le {{ Carbon\Carbon::parse($expirationDate)->format('d/m/Y')}}.</p>
                    @endif
        
                    <p>{{ $message }}</p>
                    <p>{{ $msgIfCanceled }}</p>
  
                </div>
              </div>
          
        </div>
      </div>
    </div>



@endsection