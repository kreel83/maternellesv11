@extends('layouts.mainMenu2', ['titre' => "Les groupes d'élèves", 'menu' => 'groupe'])

@section('content')

<style>

    .apercu-groupe {
        align-items: center;
        text-align: center;
        height: 37px;
        border-radius: 40px;
        width: 200px;
        border:1px solid grey;
        font-size: 16px;
        padding: 5px 16px;
    }

</style>

    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('depart')}}">Tableau de bord</a></li>        
            <li class="breadcrumb-item active" aria-current="page">Création des groupes</li>
        </ol>
    </nav>

    <h4 class="mb-3">Gestion des groupes</h4>

    @include('include.display_msg_error')

    @if($nbGroupe < 4)
        <div class="mb-3">
            Vous pouvez créer jusqu'à 4 groupes.
        </div>
        <div class="mb-3">
            @php
                $token = md5(Auth::id().'new'.env('HASH_SECRET'));
            @endphp
            <a href="{{ route('editerUnGroupe', ['id' => 'new', 'token' => $token]) }}" class="btn btn-primary"><i class="fa-solid fa-plus me-1"></i> Créer un nouveau groupe</a>
        </div>
    @else
        <div class="alert alert-warning" role="alert">
            Vous avez atteint la limite des 4 groupes crées.
        </div>
    @endif
    
    @if($nbGroupe == 0)
        <div class="alert alert-info" role="alert">
            Vous n'avez encore aucun groupe de défini.
        </div>
    @else
        <div class="mb-3">
            Liste de mes groupes :
        </div>
        @foreach ($groupes as $groupe)
            <div class="d-flex mb-3">
                    <div class="apercu-groupe me-3" style="background-color: {{ $groupes[$loop->index]['backgroundColor'] }}; color: {{ $groupes[$loop->index]['textColor'] }}">{{ $groupes[$loop->index]['name'] ?? null }}</div>
                @php
                    $token = md5(Auth::id().$loop->index.env('HASH_SECRET'));
                @endphp
                <div class="me-3">
                    <a class="btn btn-primary btn-sm" href="{{ route('editerUnGroupe', ['id' => $loop->index, 'token' => $token]) }}">Modifier</a>
                </div>
                {{-- <div class="me-3">
                    <a href="{{ route('supprimerUnGroupe', ['id' => $loop->index, 'token' => $token]) }}">Supprimer</a>
                </div> --}}
            </div>
        @endforeach
    @endif

@endsection
    