@extends('layouts.mainMenu2',['titre' => 'Mon profil', 'menu' => 'partager'])

@section('content')

@php
    $roles = array('co' => 'cotitulaire', 'su' => 'suppléant');
@endphp

<div class="container my-5 page" id="">

    <nav class="pb-4" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('depart')}}">Tableau de bord</a></li>        
            <li class="breadcrumb-item" aria-current="page"><a href="{{route('partager')}}">Partager ma classe</a></li>
            <li class="breadcrumb-item active" aria-current="page">Confirmation</li>
          </ol>
    </nav>

    <div class="card ">
        <div class="card-body">
            <h4 class="mb-3">Je partage ma classe</h4>

            <form action="{{ route('sendMailPartage') }}" method="post">
                @csrf

                <input type="hidden" name="email" value="{{ $email }}">
                <input type="hidden" name="role" value="{{ $role }}">
                <input type="hidden" name="prenom" value="{{ $newUser->prenom ?? '' }}">

                @if($newUser)
                    <p>Vous allez partager votre classe avec {{ $newUser->prenom.' '.$newUser->name }}.</p>
                    <p>Un courrier électronique contenant un lien de confirmation va lui être envoyé.</p>
                @else
                    <p>Cette personne ne possède pas encore de compte sur {{ env('APP_NAME') }}.</p>
                    <p>Un courrier électronique va lui être envoyé pour l'inviter à créer son compte et accepter le partage de votre classe.</p>
                @endif

                <p>Le rôle attribué sera : {{ $roles[$role] }}.</p>

                <div class="d-flex">
                    <a href="{{ route('partager') }}" class="btnAction inverse me-3">Annuler</a>
                    <button class="btnAction" role="submit" name="btnsubmit" value="{{ $valueForSubmitBtn }}">Confirmer le partage</button>
                </div>

            </form>
        </div>
    </div>
    
</div>

@endsection
