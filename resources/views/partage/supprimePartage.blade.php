@extends('layouts.mainMenu2',['titre' => 'Mon profil', 'menu' => 'partager'])

@section('content')

<div class="container my-5 page" id="">

    <nav class="pb-4" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('depart')}}">Tableau de bord</a></li>        
            <li class="breadcrumb-item" aria-current="page"><a href="{{route('partager')}}">Partager ma classe</a></li>
            <li class="breadcrumb-item active" aria-current="page">Supprimer un partage</li>
          </ol>
    </nav>

    <div class="card ">
        <div class="card-body">
    
            <h4 class="mb-3">Je supprime un partage</h4>

            <form action="{{ route('supprimePartageFinal') }}" method="post">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $partage->email }}">
                <input type="hidden" name="classeuser_id" value="{{ $classeuser_id }}">
                <input type="hidden" name="nomDemandeur" value="{{ $nomDemandeur }}">

                <p>Vous êtes sur le point de supprimer le partage de votre classe avec : <strong>{{ $nomDemandeur }}</strong></p>

                <div class="d-flex">
                    <a href="{{ route('partager') }}" class="btnAction inverse me-3">Annuler</a>
                    <button class="btnAction" role="submit">Supprimer le partage</button>
                </div>

            </form>
        </div>
    </div>
    
</div>

@endsection
