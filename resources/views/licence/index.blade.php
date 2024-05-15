@extends('layouts.mainMenu2', ['titre' => 'Bienvenue', 'menu' => 'accueil'])

@section('content')

<div class="container my-5 page">

    @if ($checkout == 'cancel')
        <div class="mb-3">
        <div class="alert alert-warning">Votre paiement a été annulé.</div>
        </div>     
    @endif

    <h2 class="text-center mb-3">Licences {{ config('app.name') }}</h2>

    <div class="row mb-3">
                
        <div class="col">

            <div class="card h-100">
                <div class="card-body">
                    <div class="card-title text-center mb-3">
                        <h4>Licence ESSENTIELLE</h4>
                    </div>

                    <div class="mb-1"><i class="fa fa-check me-1 text-success"></i> Evaluations illimitées</div>
                    <div class="mb-1"><i class="fa fa-check me-1 text-success"></i> Fonctionnalités essentielles</div>
                    <div class="mb-1"><i class="fa fa-xmark me-1 text-danger"></i> Partage de classe</div>
                    <div class="mb-1"><i class="fa fa-xmark me-1 text-danger"></i> Importation des élèves</div>
                    <div class="mb-1"><i class="fa fa-xmark me-1 text-danger"></i> Compagnon mobile</div>

                    {{-- <div class="text-center mb-3 mt-3">
                        <h3><span class="badge text-bg-secondary"><strike>14,90 €</strike></span> <span class="badge text-bg-success">{{ config('app.custom.prix_abonnement') }} € / an <span>TTC</span></span></h3>
                    </div> --}}

                    <div class="alert alert-success mb-3 mt-3">
                        <div class="text-center">
                            <h3>Prix de lancement</h3>
                            <h3><span class="badge text-bg-secondary"><strike>14,90 €</strike></span> <span class="badge text-bg-success">{{ config('app.custom.prix_abonnement') }} € / an <span>TTC</span></span></h3>
                        </div>
                    </div>
                    <div class="alert alert-info mb-3 mt-3">
                        <div class="text-center">
                            <i class="fa-solid fa-badge-check me-1"></i> Recommandé pour découvrir l'application
                        </div>
                    </div>
                    <p><i class="fa-brands fa-cc-stripe fs-5"></i> Vous serez redirigé vers notre plateforme de paiement sécurisée <i>Stripe</i> pour régler votre abonnement.</p>
                </div>
                <div class="card-footer pt-0">
                    {{-- <a class="btnAction mx-auto mb-1" href="{{ route('subscribe.index') }}">Je m'abonne</a> --}}
                    <a class="btnAction mx-auto mb-1" href="{{ route('subscribe.checkout') }}">Je m'abonne</a>
                </div>
            </div>

        </div>

        <div class="col">
            <div class="card h-100">
                <div class="card-body">

                    <div class="card-title text-center mb-3">
                        <h4>Licence INTEGRALE</h4>
                    </div>

                    <div class="mb-1"><i class="fa fa-sparkle me-1 text-warning"></i> Toute la licence ESSENTIELLE</div>
                    <div class="mb-1">Plus :</div>
                    <div class="mb-1"><i class="fa fa-check me-1 text-success"></i> Evaluations illimitées</div>
                    <div class="mb-1"><i class="fa fa-check me-1 text-success"></i> Toutes les fonctionnalités</div>
                    <div class="mb-1"><i class="fa fa-check me-1 text-success"></i> Achat unique</div>
                    <div class="mb-1"><i class="fa fa-check me-1 text-success"></i> Licence nominative à vie</div>
                    <div class="mb-1"><i class="fa fa-check me-1 text-success"></i> Modules complémentaires en option</div>

                    {{-- <div class="text-center mb-3 mt-3">
                        <h3>34,90 € <span>TTC</span></h3>
                    </div> --}}

                    <div class="alert alert-success mb-3 mt-3">
                        <div class="text-center">
                            <h3>34,90 € <span>TTC</span></h3> (une seule fois)
                        </div>
                    </div>
                    <p><i class="fa-brands fa-cc-stripe fs-5"></i> Vous serez redirigé vers notre plateforme de paiement sécurisée <i>Stripe</i> pour régler votre achat.</p>
                </div>
                <div class="card-footer pt-0">
                    <a class="btnAction mx-auto mb-1" href="{{ route('achat.checkout') }}">Je commande</a>
                </div>
            </div>
        </div>

    </div>

    <div class="card">
        <div class="card-body">
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

                {{-- <h3 class="mb-3" style="color: var(--main-color)">Comment s'abonner ?</h3>

                <ol>
                    <li><strong>Aucun frais cachés</strong> : l'abonnement au service {{ config('app.name') }} est au prix de {{ config('app.custom.prix_abonnement') }} € pour 1 an et sera reconduit automatiquement à la fin de chaque période sauf résiliation de votre part. Vous pourrez résilier votre abonnement à tout moment.</li>
                    <li><strong>Informations de paiement sécurisé</strong> : saisissez vos informations de paiement en toute confiance grâce à notre système sécurisé.</li>
                    <li><strong>Commencez à profiter de tous les avantages</strong> : une fois votre abonnement confirmé, plongez dans l'univers simplifié de la gestion de classe avec {{ config('app.name') }}.</li>
                </ol>                 --}}
            </div>
        </div>
    </div>

</div>

@endsection