@extends('layouts.vitrine')

@section('content')

<section class="faqs-single-section padding-top padding-bottom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-header">
                    <span class="cate">Paramétrage</span>
                    <h3 class="title">Principaux paramètres de l'application</h3>
                </div>
            </div>
        </div>
        <div class="row mb--10">
            <div class="col-lg-6">

                <div class="accordion mb-4" id="accordion1">
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            <h5>Création de commentaires</h5>
                        </button>
                      </h2>
                      <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordion1">
                        <div class="accordion-body">
                            Les commentaires pré-établis peuvent être ajoutés à un élève très facilement 
                            et grâce à un ingénieux système de " Mot Clés " seront automatiquement personnalisés.
                        </div>
                      </div>
                    </div>
                </div>

                <div class="accordion mb-4" id="accordion2">
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <h5>Gestion des élèves</h5>
                        </button>
                      </h2>
                      <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordion2">
                        <div class="accordion-body">
                            Gestion complète des fiches élèves.
                        </div>
                      </div>
                    </div>
                </div>

                <div class="accordion mb-4" id="accordion3">
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <h5>Vos aides maternelles</h5>
                        </button>
                      </h2>
                      <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordion3">
                        <div class="accordion-body">
                            Vous créer et gérez très facilement les profils de vos aides maternelles.
                        </div>
                      </div>
                    </div>
                </div>

                <div class="accordion mb-4" id="accordion4">
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            <h5>Périodes scolaires</h5>
                        </button>
                      </h2>
                      <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordion4">
                        <div class="accordion-body">
                            Indiquez les différentes périodes de vacances scolaires.
                        </div>
                      </div>
                    </div>
                </div>

                
            </div>
            <div class="col-lg-6">

                <div class="accordion mb-4" id="accordion5">
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            <h5>Génération des mots de passe pour le cahier de progrès</h5>
                        </button>
                      </h2>
                      <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordion5">
                        <div class="accordion-body">
                            En 1 clic vous générez un nouveau mot de passe qui sera donné aux parents pour consulter 
                            le cahier de progrès de leur enfant.
                        </div>
                      </div>
                    </div>
                </div>

                <div class="accordion mb-4" id="accordion6">
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                            <h5>Gestion des fiches</h5>
                        </button>
                      </h2>
                      <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordion6">
                        <div class="accordion-body">
                            Vous pouvez créer et personnaliser vos propres fiches en plus de celles par défaut dans l'application.
                        </div>
                      </div>
                    </div>
                </div>

                <div class="accordion mb-4" id="accordion7">
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                            <h5>Votre école</h5>
                        </button>
                      </h2>
                      <div id="collapseSeven" class="accordion-collapse collapse" data-bs-parent="#accordion7">
                        <div class="accordion-body">
                            Vous pouvez paramétrer votre école pour que les informations figurent sur les différents documents.
                        </div>
                      </div>
                    </div>
                </div>

                <div class="accordion mb-4" id="accordion8">
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                            <h5>[Paramètre supplémentaire]</h5>
                        </button>
                      </h2>
                      <div id="collapseEight" class="accordion-collapse collapse" data-bs-parent="#accordion8">
                        <div class="accordion-body">
                            A venir.
                        </div>
                      </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection