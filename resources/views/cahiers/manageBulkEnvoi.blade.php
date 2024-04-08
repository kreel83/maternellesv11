@extends('layouts.mainMenu2', ['titre' => 'Bienvenue', 'menu' => 'accueil'])

@section('content')

<div class="container my-5">

    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb position-relative my-3">
            <li class="breadcrumb-item"><a href="{{route('depart')}}">Tableau de bord</a></li>
            <li class="breadcrumb-item"><a href="{{route('enfants',['type' => "ciu"])}}">Liste des enfants</a></li>
            <li class="breadcrumb-item"><a href="{{route('cahierManage')}}">Gestion des cahiers</a></li>
            <li class="breadcrumb-item active" aria-current="page">Confirmation envoi</li>
            <span class="help position-absolute" data-location="eleves.reussite.main"><i class="fa-light fa-message-question"></i></span>
        </ol>
    </nav>

    <div class="card mb-3">
        <div class="card-body">

        <h5 class="mb-3">Envoi des cahiers de réussites</h5>
        <p>Vous allez envoyer un courrier électronique à tous les parents avec le lien de téléchargement du cahier de réussites de leur enfant.</p>
        <p>Vous avez la possibilité de personnaliser le texte du message en <a href="{{ route('parametresMails') }}">cliquant ici</a>.</p>

        <div id="manageBulkEnvoiGroupButton">
            <div class="d-flex">

                <a href="{{ route('cahierManage') }}" class="btnAction inverse me-3">Annuler</a>

                <form id="manageBulkEnvoiForm" action="{{ route('cahierManage.post') }}" method="post">
                @csrf
                    <input type="hidden" name="periode" value="{{ $periode }}">
                    <button type="button" class="btnAction manageBulkEnvoiButton">Confirmer l'envoi</button>       
                </form>

            </div>
        </div>

        </div>
    </div>

    <div id="manageBulkEnvoiProcessing" style="display: none;">
        <div class="card">
            <div class="card-body">

                <div class="d-flex align-items-center p-2">

                <div> 
                        <h5>Envoi en cours, veuillez patienter...</h5>
                </div>

                    <div>
                        {{-- https://loading.io/asset/724643 --}}
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: none; display: block; shape-rendering: auto; animation-play-state: running; animation-delay: 0s;" width="200px" height="75" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                        <circle cx="30" cy="50" fill="#fb7863" r="20" style="animation-play-state: running; animation-delay: 0s;">
                            <animate attributeName="cx" repeatCount="indefinite" dur="1s" keyTimes="0;0.5;1" values="30;70;30" begin="-0.5s" style="animation-play-state: running; animation-delay: 0s;"></animate>
                        </circle>
                        <circle cx="70" cy="50" fill="#fbb7a4" r="20" style="animation-play-state: running; animation-delay: 0s;">
                            <animate attributeName="cx" repeatCount="indefinite" dur="1s" keyTimes="0;0.5;1" values="30;70;30" begin="0s" style="animation-play-state: running; animation-delay: 0s;"></animate>
                        </circle>
                        <circle cx="30" cy="50" fill="#fb7863" r="20" style="animation-play-state: running; animation-delay: 0s;">
                            <animate attributeName="cx" repeatCount="indefinite" dur="1s" keyTimes="0;0.5;1" values="30;70;30" begin="-0.5s" style="animation-play-state: running; animation-delay: 0s;"></animate>
                            <animate attributeName="fill-opacity" values="0;0;1;1" calcMode="discrete" keyTimes="0;0.499;0.5;1" dur="1s" repeatCount="indefinite" style="animation-play-state: running; animation-delay: 0s;"></animate>
                        </circle>
                        <!-- [ldio] generated by https://loading.io/ --></svg>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div id="manageBulkEnvoiSuccess" style="display:none">
        <div class="mt-2 alert alert-success" role="alert">Les cahiers de réussites ont été envoyés.</div>
    </div>

    <div id="manageBulkEnvoiWarning" style="display:none">
        <div class="mt-2 alert alert-warning" role="alert">Les cahiers de réussites ont été envoyés mais des erreurs ont été détectées.</div>
    </div>

    <div id="manageBulkEnvoiError" style="display:none">
        <div id="manageBulkEnvoiErrorMsg" class="mt-2 alert alert-danger" role="alert"></div>
    </div>

    <div id="manageBulkEnvoiBackBtn" class="mt-4" style="display:none">
        <a class="btnAction" href="{{ route('cahierManage') }}">Retour à la gestion des cahiers de réussites</a>
    </div>

</div>

@endsection