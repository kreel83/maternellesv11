@extends('layouts.mainMenu2',['titre' => 'Mon profil', 'menu' => 'partager'])

@section('content')

<div class="container my-5 page" id="">

    <nav class="pb-4" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('depart')}}">Tableau de bord</a></li>        
            <li class="breadcrumb-item active" aria-current="page">Partager ma classe</li>
          </ol>
    </nav>

    @include('include.display_msg_error')
    
    <div class="card ">
        <div class="card-body">
            <h4 class="mb-3">Je partage ma classe</h4>

            <form action="{{ route('ajoutePartage') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="email">Indiquez ici l'adresse de courrier électronique de la personne qui pourra accéder à votre classe pour collaborer</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="Adresse e-mail">
                </div>

                {{-- <div class="mb-3">
                    <label for="email">Indiquez un code de sécurité composé de 6 chiffres</label>
                    <input type="number" name="code" id="code" class="form-control" value="{{ old('code') }}" placeholder="Code de sécurité" aria-describedby="codeHelp">
					<div id="codeHelp" class="form-text">Ce code devra être communiqué à la personne qui partagera votre classe par le moyen de votre choix.</div>
                </div> --}}

                <button class="btn btn-primary" role="submit">Ajouter</button>

            </form>
        </div>
    </div>
    <br>
    <div class="card ">
        <div class="card-body">
            <p>Partages en attente de validation :</p>
            <ul>
                @if($pendings->count() > 0)
                    @foreach ($pendings as $pending)
                        @php
                            $token = md5($pending->id.env('HASH_SECRET'));
                            //dd($pending);
                        @endphp
                        <li>
                            @if(isset($pending->prenom))
                                @php 
                                    $nomComplet = $pending->prenom.' '.$pending->name;
                                @endphp
                            @else
                                @php
                                    $nomComplet = $pending->email;
                                @endphp
                            @endif
                            {{-- <span class="me-2">{{ isnul($pending->prenom) && isnull($pending->name) ? $pending->email : $pending->prenom.' '.$pending->name }}</span> --}}
                            <span class="me-2">{{ $nomComplet }}</span>
                            <a class="me-2" href="{{ route('supprimePartage', ['classeuser_id' => $pending->id, 'token' => $token]) }}" title="Supprimer le partage">
                                Supprimer le partage
                            </a>
                        </li>
                    @endforeach
                @else
                    <li>Aucun partage en attente.</li>
                @endif
            </ul>
        </div>
    </div>
    <br>
    <div class="card ">
        <div class="card-body">
            <p>Personnes disposant de l'accès à votre classe :</p>
            <ul>
                @if($partages->count() > 0)
                    @foreach ($partages as $partage)
                        @php
                            $token = md5($partage->id.env('HASH_SECRET'));
                        @endphp
                        <li>
							<span class="me-2">{{ $partage->prenom.' '.$partage->name }}</span> 
                            <a class="me-2" href="{{ route('supprimePartage', ['classeuser_id' => $partage->id, 'token' => $token]) }}" title="Supprimer le partage">
                                {{--<i class="fa-solid fa-trash fa-sm"></i>--}}Supprimer le partage
                            </a>
                            {{-- <span class="me-2">|</span>
                            <a class="me-2" href="{{ route('sendCodePartage', ['classeuser_id' => $partage->id, 'token' => $token]) }}">
                                Recevoir le code de sécurité par mail
                            </a>
                            <span class="me-2">|</span>
                            <a role="button" class="me-2 codeDeSecuritePartage" data-code="{{ $partage->code }}">
                                Voir le code de sécurité
                            </a> --}}
                        </li>
                    @endforeach
                @else
                    <li>Aucun partage trouvé.</li>
                @endif
            </ul>
        </div>
    </div>


</div>

@endsection
