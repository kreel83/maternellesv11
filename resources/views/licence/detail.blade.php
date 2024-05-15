@extends('layouts.mainMenu2', ['titre' => 'Détail de mon abonnement', 'menu' => 'abonnement'])

@section('content')

<div class="container my-5 page">

  <nav class="pb-4" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('depart')}}">Tableau de bord</a></li>        
        <li class="breadcrumb-item active" aria-current="page">Ma licence</li>
      </ol>
  </nav>

  <div class="card">
  {{-- <div class="card mx-auto w-75"> --}}

    <div class="card-body">

      <h4 class="card-title mb-3">Détail de ma licence</h4>

        <div class="mb-3">
          Type de licence : {{ $type }}
        </div>

        <div class="mb-3">
          Statut : {{ $status }}
        </div>
                        
        @if(($licenceType == 'self' || $licenceType == 'admin') && $status == 'actif')
          <div class="mb-3">
            Votre abonnement se terminera le {{ Carbon\Carbon::parse($expirationDate)->format('d/m/Y')}}.
          </div>
        @endif

        {{-- <div class="mb-3">{{ $message }}</div> --}}
        <div class="mb-3">{{ $msgIfCanceled }}</div>


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
      </div>
      
    </div>

  </div>

  <p><a href="{{ route('depart') }}" class="btnAction">Retour au tableau de bord</a></p>

</div>
@endsection