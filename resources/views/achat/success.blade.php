@extends('layouts.mainMenu2', ['titre' => 'Abonnement', 'menu' => 'reactiver'])

@section('content')
<div class="container mt-5">

    <nav class="pb-4" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('depart')}}">Tableau de bord</a></li>
        <li class="breadcrumb-item active" aria-current="page">Merci pour votre achat</li>
        </ol>
    </nav>

    <div class="card mx-auto">
        <div class="card-body">
          <h4 class="card-title mb-3">Commande terminée</h4>

        <p>Nous vous remercions pour l'achat de votre licence Premium {{ config('app.name')}}.</p>
        <p>Votre licence sera activée d'ici quelques instants.</p>

        <div class="mt-3">
            <a class="btnAction" href="{{ route('depart') }}">Retour au tableau de bord</a>
        </div>
    
        </div>
    </div>

</div>
@endsection
