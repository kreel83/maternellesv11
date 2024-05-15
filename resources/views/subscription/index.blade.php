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

<div class="container my-5 page">

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
      
      {{-- <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6> --}}
      @if ($status != 'actif')

      <div style="width: 50%; margin: 0 auto; margin-bottom: 16px; text-align: center; color: var(--main-color)">

        <h3 class="mb-3">Abonnez-vous à notre service de gestion de classe de maternelle</h3>
      </div>

        @if ($checkout == 'cancel')
            <div class="mb-3">
              <div class="alert alert-warning">Votre paiement a été annulé et aucun abonnement n'a été souscrit.</div>
            </div>     
        @endif

        <p class="px-5">Bienvenue sur {{ config('app.name') }}, la plateforme complète de gestion de classe de maternelle qui simplifie votre quotidien éducatif. Nous comprenons l'importance de créer un environnement pédagogique fluide et efficace pour vous, enseignants de maternelle.</p>

        <div class="mb-4">
          {{-- <a class="btn btn-primary" href="{{ route('subscribe.cardform') }}"> --}}
            <div class="alert alert-info"><i class="fa-solid fa-circle-info me-1"></i> L'abonnement au service {{ config('app.name') }} sera bientôt disponible. Vous pouvez nous contacter en <a class="alert-link" href="{{ route('contact') }}">cliquant ici.</a></div>
          {{-- <a class="btnAction mx-auto">
            Je souhaite m'abonner au service
          </a> --}}

          @if (Auth::id() == 47)
            <a class="btn btn-primary" href="{{ route('subscribe.checkout') }}" target="_blank">Checkout</a>
          @endif
        </div>

        <div class="row">

            {{-- <div class="col-lg-6">
                <img src="chemin/vers/votre/image.jpg" class="img-fluid" alt="Image d'illustration">
            </div> --}}

            <div class="col-lg-12">

              <style>
                .corps_abonnement h4 {
                  color: var(--main-color);
                  display: flex;
                  align-items: center;
                  align-content: center;
                  font-weight: 400;

                }
                .corps_abonnement h4 i {
                  font-size: 18px;
                 
                }
                .corps_abonnement p {
                  display: inline-block;
                  padding-left: 30px;
                  padding-right: 70px;
                }
                .corps_abonnement strong {
                  color: var(--main-color);
                 
                  align-items: center;
                  align-content: center;
                  font-weight: 400;
                }
              </style>

              <div class="corps_abonnement">
                  <h3 class="mb-4"  style="color: var(--main-color)">Pourquoi choisir {{ config('app.name') }} ?</h3>

                  <h4><i class="fa-regular fa-star me-1" style="color: var(--main-color)"></i> Une gestion de classe simplifiée</h4>
                  <p>Notre plateforme a été spécialement conçue pour répondre aux besoins uniques des enseignants de maternelle. Gérez facilement votre classe, suivez les progrès des élèves et organisez vos activités en quelques clics.</p>

                  <h4><i class="fa-regular fa-pen-to-square me-1" style="color: var(--main-color)"></i> Édition des cahiers de réussites intuitive</h4>
                  <p>Créez des cahiers de réussites personnalisés en un rien de temps. Notre interface conviviale vous permet de documenter les réalisations de chaque élève de manière simple et visuelle.</p>

                  <h4><i class="fa-brands fa-cc-stripe me-1" style="color: var(--main-color)"></i> Sécurité de paiement garantie</h4>
                  <p>La sécurité de vos transactions est notre priorité. Nous utilisons des méthodes de paiement sécurisées pour assurer la protection totale de vos informations financières.</p>

                  <h4><i class="fa-regular fa-face-smile me-1" style="color: var(--main-color)"></i></i> Garantie de satisfaction</h4>
                  <p>Nous sommes convaincus que vous adorerez notre service, c'est pourquoi nous offrons une garantie de satisfaction. Si, pour quelque raison que ce soit, vous n'êtes pas entièrement satisfait(e) dans les 30 jours, nous vous rembourserons intégralement.</p>

                  <h3 class="mb-3" style="color: var(--main-color)">Comment s'abonner ?</h3>

                  <ol>
                      <li><strong>Aucun frais cachés</strong> : l'abonnement au service {{ config('app.name') }} est au prix de {{ config('app.custom.prix_abonnement') }} € pour 1 an et sera reconduit automatiquement à la fin de chaque période sauf résiliation de votre part. Vous pourrez résilier votre abonnement à tout moment.</li>
                      <li><strong>Informations de paiement sécurisé</strong> : saisissez vos informations de paiement en toute confiance grâce à notre système sécurisé.</li>
                      <li><strong>Commencez à profiter de tous les avantages</strong> : une fois votre abonnement confirmé, plongez dans l'univers simplifié de la gestion de classe avec {{ config('app.name') }}.</li>
                  </ol>                
              </div>



            </div>

        </div>

          <div class="mb-3">
            {{-- <a class="btn btn-primary" href="{{ route('subscribe.cardform') }}"> --}}
              <div class="alert alert-info"><i class="fa-solid fa-circle-info me-1"></i> L'abonnement au service {{ config('app.name') }} sera bientôt disponible. Vous pouvez nous contacter en <a class="alert-link" href="{{ route('contact') }}">cliquant ici.</a></div>
            {{-- <a class="btnAction mx-auto">
              Je souhaite m'abonner au service
            </a> --}}

            @if (Auth::id() == 47)
              <a class="btn btn-primary" href="{{ route('subscribe.checkout') }}" target="_blank">Checkout</a>
            @endif
          </div>
      @else

          <h4 class="card-title mb-3">Mon abonnement</h4>

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
                  <a class="btnAction" href="{{ route('subscribe.resume') }}">Réactiver mon abonnement</a>
              @else
                  <a class="btnAction" href="{{ route('subscribe.cancel') }}">Résilier mon abonnement</a>
              @endif
              </div>
          @endif

          @if($invoices > 0)
              <div class="me-3">
                  <a class="btnAction" href="{{ route('facture.list') }}">Mes factures</a>
              </div>
          @endif
      </div>
      
    </div>

  </div>

</div>

{{-- @if ($status != 'actif')
    <p>Vous n'avez pas d'abonnement en cours.</p>
    <p><a href="{{ route('subscribe.cardform') }}">Je souhaite m'abonner au service <i>{{ config('app.name') }}</i></a></p>
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