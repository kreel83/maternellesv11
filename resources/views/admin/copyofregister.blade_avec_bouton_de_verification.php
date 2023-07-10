@extends('layouts.parentLayout')

@section('content')


<h1 class="mt-3">Création de votre compte administrateur</h1>
<p>Bienvenue dans notre assistant !</p>

{{--

<div id="adminRegistration">

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form action="{{ route('admin.admincreationform') }}" method="get">
    @csrf

        <div class="mb-3">
            <label for="codeEtablissement" class="form-label">Merci de saisir l'identifiant de votre établissement composé de 7 chiffres et 1 lettre :</label>
            <input type="text" class="form-control" id="codeEtablissement" name="codeEtablissement">
        </div>

        <div id="result_msg" class="mb-3"></div>
        <div id="result_mail" class="mb-3"></div>

        <a id="btncheckcode" class="btn btn-primary">Vérifier l'identifiant</a>

        <div id="btns" class="d-none">
            <button id="btnsubmit" class="btn btn-primary">Continuer avec et établissement</button>
            <div class="mt-3">
                <a href="{{ route('admin.register') }}">Annuler</a>
            </div>
        </div>

    </form>

</div>
--}}


<div id="adminRegistration">

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <!--
    <form action="{{ route('admin.create') }}" method="post">
    @csrf
    -->

    <label for="ecole_id" class="form-label">Merci de saisir l'identifiant de votre établissement composé de 7 chiffres et 1 lettre :</label>
        <div class="row row-cols-lg-auto g-3 align-items-center">
        <div class="col-12 mb-3">
            <input type="text" class="form-control" id="ecole_id" name="ecole_id" value="{{ old('ecole_id') }}" placeholder="Identifiant" required>
        </div>

        <div class="col-12 mb-3">
            <button id="btn-checkcode" class="btn btn-primary ml-3">{{ __('Vérifier l\'identifiant') }}</button>
        </div>
        </div>

        <!--
        <div class="mb-3">
            <label for="ecole_id" class="form-label">Merci de saisir l'identifiant de votre établissement composé de 7 chiffres et 1 lettre :</label>
            <input type="text" class="form-control" id="ecole_id" name="ecole_id" value="{{ old('ecole_id') }}" required>
            <button id="btn-checkcode" class="btn btn-primary ml-3">{{ __('Vérifier le code établissement') }}</button>
        </div>
    -->
        <!--
        <div class="mb-3">
            <label for="codeEtablissement" class="form-label">Merci de saisir l'identifiant de votre établissement composé de 7 chiffres et 1 lettre :</label>
            <input type="text" class="form-control" id="codeEtablissement" name="codeEtablissement" value="{{ old('codeEtablissement') }}" required>
        </div>
        -->

        <!--
        <div class="mb-3">
            <input type="text" class="form-control" id="result_msg" name="result_msg" value="{{ old('result_msg') }}" readonly>
        </div>

        <div class="mb-3">
            <input type="text" class="form-control" id="result_mail" name="result_mail" value="{{ old('result_mail') }}" readonly>
        </div>
    -->

        
        <div id="result_msg" class="mb-3"></div>
        <div id="result_mail" class="mb-3"></div>

        <!-- memorise les valeurs pour reafficher en cas d'erreur sur le formulaire -->
        <input type="hidden" id="result_msg_memo" name="result_msg_memo" value="{{ old('result_msg_memo') }}">
        <input type="hidden" id="result_mail_memo" name="result_mail_memo" value="{{ old('result_mail_memo') }}">
        
        <!--<a id="btncheckcode" class="btn btn-primary">Vérifier l'identifiant</a>-->

        <!--<div id="form_step2" style="display:none">-->
            
            <div class="row mt-3 mb-3">
                
                <!-- email -->
                <input id="email" type="hidden" name="email" value="{{ old('email') }}" required />

                <!-- identifiant etablissement -->
                <!--<input id="ecole_id" type="hidden" name="ecole_id" value="{{ old('ecole_id') }}" required />-->
        
                <!-- nom -->
                <div class="col">
                    <!--<label for="name" class="form-label">{{ __('Nom') }}</label>-->
                    <input placeholder="{{ __('Votre nom') }}" id="name" class="form-control block mt-1 w-full" type="text" name="name" value="{{ old('name') }}" required />
                </div>
            
                <!-- prenom -->
                <div class="col">
                    <!--<label for="firstname" class="form-label">{{ __('Prénom') }}</label>-->
                    <input placeholder="{{ __('Votre prénom') }}" id="prenom" class="form-control block mt-1 w-full" type="text" name="prenom" value="{{ old('prenom') }}" required />
                </div>

            </div>

            <!-- password -->
            <div class="mb-3">
                <!--<label for="password" class="form-label">{{ __('Mot de passe') }}</label>-->
                <input placeholder="{{ __('Choisissez un mot de passe') }}" id="password" class="form-control block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- confirm password -->
            <div class="mb-3">
                <!--<label for="password_confirmation" class="form-label">{{ __('Confirmer le mot de passe') }}</label>-->
                <input placeholder="{{ __('Confirmer le mot de passe') }}" id="password_confirmation" class="form-control block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="form-check justify-content-center mb-3">
                <input class="form-check-input me-2" type="checkbox" value="" id="agree" required />
                <label class="form-check-label" for="agree">
                    J'ai lu et j'accepte les <a href="#voirCGU" data-bs-toggle="modal">conditions générales d'utilisation</a><br /> et la <a href="#voirConfidentialite" data-bs-toggle="modal">politique de confidentialité</a>.
                </label>
            </div>

            <div class="text-center">
                <button id="btnsubmit" class="btn btn-primary ml-3">
                    {{ __('Créer le compte') }}
                </button>
            </div>

            <p class="text-center mt-4"><a href="/">Annuler</a></p>

        <!--</div>-->

    <!--</form>-->

</div>

<div class="modal" id="voirCGU" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Conditions générales d'utilisation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Voici les conditions d'utilisation du service <strong>Les Maternelles</strong> :</p>
                <p>...</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="voirConfidentialite" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Politique de confidentialité</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Voici notre politique de confidentialité concernant le service <strong>Les Maternelles</strong> :</p>
                <p>...</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

{{--
<div id="adminRegistration">

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form action="{{ route('admin.createadminuser') }}" method="post">
    @csrf

        <div class="mb-3">
            <label for="codeEtablissement" class="form-label">Merci de saisir l'identifiant de votre établissement composé de 7 chiffres et 1 lettre :</label>
            <input type="text" class="form-control" id="codeEtablissement" name="codeEtablissement" value="{{ old('codeEtablissement') }}">
        </div>

        <div id="result_msg" class="mb-3"></div>
        <div id="result_mail" class="mb-3"></div>

        <a id="btncheckcode" class="btn btn-primary">Vérifier l'identifiant</a>

        <div id="form_step2" style="display:none">
            
            <div class="row mt-3 mb-3">
                
                <!-- email -->
                <input id="email" type="hidden" name="email" value="{{ old('email') }}" required />

                <!-- identifiant etablissement -->
                <input id="ecole_id" type="hidden" name="ecole_id" value="{{ old('ecole_id') }}" required />
        
                <!-- nom -->
                <div class="col">
                    <!--<label for="name" class="form-label">{{ __('Nom') }}</label>-->
                    <input placeholder="{{ __('Votre nom') }}" id="name" class="form-control block mt-1 w-full" type="text" name="name" value="{{ old('name') }}" required autofocus />
                </div>
            
                <!-- prenom -->
                <div class="col">
                    <!--<label for="firstname" class="form-label">{{ __('Prénom') }}</label>-->
                    <input placeholder="{{ __('Votre prénom') }}" id="prenom" class="form-control block mt-1 w-full" type="text" name="prenom" value="{{ old('prenom') }}" required autofocus />
                </div>

            </div>

            <!-- password -->
            <div class="mb-3">
                <!--<label for="password" class="form-label">{{ __('Mot de passe') }}</label>-->
                <input placeholder="{{ __('Choisissez un mot de passe') }}" id="password" class="form-control block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- confirm password -->
            <div class="mb-3">
                <!--<label for="password_confirmation" class="form-label">{{ __('Confirmer le mot de passe') }}</label>-->
                <input placeholder="{{ __('Confirmer le mot de passe') }}" id="password_confirmation" class="form-control block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="form-check justify-content-center mb-4">
                <input class="form-check-input me-2" type="checkbox" value="" id="agree" required />
                <label class="form-check-label" for="agree">
                    J'ai lu et j'accepte les <a href="#voirCGU" data-bs-toggle="modal">conditions générales d'utilisation</a> et la <a href="#voirConfidentialite" data-bs-toggle="modal">politique de confidentialité</a>
                </label>
            </div>

            <div class="text-center">
                <button id="btnsubmit" class="btn btn-primary ml-3">
                    {{ __('Créer le compte') }}
                </button>
            </div>

            <p class="text-center mt-4"><a href="/">Annuler</a></p>

        </div>

    </form>

</div>

<div class="modal" id="voirCGU" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Conditions générales d'utilisation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Voici les conditions d'utilisation du service <strong>Les Maternelles</strong> :</p>
                <p>...</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="voirConfidentialite" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Politique de confidentialité</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Voici notre politique de confidentialité concernant le service <strong>Les Maternelles</strong> :</p>
                <p>...</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
--}}


@endsection
