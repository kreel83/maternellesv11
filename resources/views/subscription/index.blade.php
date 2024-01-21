@extends('layouts.mainMenu2', ['titre' => 'Détail de mon abonnement', 'menu' => 'abonnement'])

@section('content')

<style>
  .card_login {
    width: 800px;
    height: 600px;
    background-color: white;
  }

  .card:hover {
    transform: none !important;
  }
</style>

<div class="container my-5 page" id="">

  <nav class="pb-4" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('depart')}}">Tableau de bord</a></li>        
        <li class="breadcrumb-item active" aria-current="page">Mon abonnement</li>
      </ol>
  </nav>

  <div id="detail_abo">

  {{--@if (!$is_abonne)--}}
  <div class="card mx-auto w-75">
    <div class="card-body">
      <h4 class="card-title mb-3">Détail de mon abonnement</h4>
      {{-- <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6> --}}
      @if ($status != 'actif')
          <div class="mb-3">
            Vous n'avez pas d'abonnement en cours.
          </div>
          <div class="mb-3">
            L'abonnement au service {{ env('APP_NAME') }} est au prix de {{ env('PRIX_ABONNEMENT') }} € pour 1 an et sera prolongé automatiquement à la fin de la période.
          </div>
          <div class="mb-3">
            Vous pourrez résilier votre abonnement à tout moment.
          </div>
          <div class="mb-3">
            {{-- <a class="btn btn-primary" href="{{ route('subscribe.cardform') }}"> --}}
              <div class="alert alert-info">L'abonnement au service sera bientôt disponible. Vous pouvez nous contacter en <a class="alert-link" href="{{ route('contact') }}">cliquant ici.</a></div>
            <a class="btn btn-secondary">
              Je souhaite m'abonner au service
            </a>
          </div>
      @else
          <div class="mb-3">
            Statut : {{ $status }}
          </div>
                          
          @if($status == 'actif')
            <div class="mb-3">
              Votre abonnement se terminera le {{ Carbon\Carbon::parse($expirationDate)->format('d/m/Y')}}.
            </div>
          @endif

          <div class="mb-3">{{ $message }}</div>
          <div class="mb-3">{{ $msgIfCanceled }}</div>
      @endif
      {{-- <a href="#" class="card-link">Card link</a>
      <a href="#" class="card-link">Another link</a> --}}

      <div class="d-flex flex-row">
          @if($licenceType == 'self' && $status == 'actif')
              <div class="me-3">
              @if($onGracePeriode)
                  <a class="btn btn-primary" href="{{ route('subscribe.resume') }}">Réactiver mon abonnement</a>
              @else
                  <a class="btn btn-outline-secondary" href="{{ route('subscribe.cancel') }}">Résilier mon abonnement</a>
              @endif
              </div>
          @endif

          @if($invoices > 0)
              <div class="me-3">
                  <a class="btn btn-primary" href="{{ route('subscribe.invoice') }}">Mes factures</a>
              </div>
          @endif
      </div>
      
    </div>

  </div>

</div>

{{-- @if ($status != 'actif')
    <p>Vous n'avez pas d'abonnement en cours.</p>
    <p><a href="{{ route('subscribe.cardform') }}">Je souhaite m'abonner au service <i>{{ env('APP_NAME') }}</i></a></p>
@else
    <p>Statut : {{ $status }}</p>
                    
    @if($status == 'actif')
        <p>Votre abonnement se terminera le {{ Carbon\Carbon::parse($expirationDate)->format('d/m/Y')}}.</p>
    @endif

    <p>{{ $message }}</p>
    <p>{{ $msgIfCanceled }}</p>
@endif --}}

{{-- <style>
  p {
    color: white !important;
  }
</style> --}}

{{-- @if($licenceType == 'self' && $status == 'actif')

  @if($onGracePeriode)
    <a class="btn btn-primary" href="{{ route('subscribe.resume') }}">Réactiver mon abonnement</a>
  @else
    <a class="btn btn-primary" href="{{ route('subscribe.cancel') }}">Résilier mon abonnement</a>
  @endif

@endif

@if($invoices > 0)
  <a class="btn btn-primary" href="{{ route('subscribe.invoice') }}">Mes factures</a>
@endif --}}

    
      {{-- <div class="d-flex justify-content-center align-items-center vh-100">
        
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
    </div> --}}


  </div>
@endsection