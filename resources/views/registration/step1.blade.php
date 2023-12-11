@extends('layouts.createAccount')

@section('content')

{{--
<div class="mt-3">
    {{__('J\'ai déjà un compte : ') }}
    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
        {{ __('se connecter') }}
    </a>
</div>
--}}



{{-- <div class="mb-3">
    <h5 class="text-center">Etape 1 / 3 : choix de l'établissement</h5>
</div> --}}

<form action="{{ route('registration.step1.post') }}" method="post">
@csrf

    <input type="hidden" name="role" value="{{ $role }}">

    {{-- <div class="card mx-auto p-0" style="width: 36rem; height: 20rem"> --}}
    <div class="card mx-auto w-75">
        <div class="card-header">
            <div class="d-flex justify-content-between pt-2">
                <h5>Création de mon compte {{ env('APP_NAME' )}}</h5>
                <h5><span class="badge bg-info">{{ $role == 'admin' ? 'Administrateur' : 'Enseignant' }}</span></h5>
            </div>
        </div>
        <div class="card-body">
            
            <h5 class="card-title mb-3">Etape 1 / 3 : choix de l'établissement</h5>

            @include('include.display_msg_error')

            <div class="row">
                <div class="col">
                    <label for="ecole_id" class="form-label">Saisissez l'identifiant de votre établissement ci-dessous :</label>
                    <input type="text" class="form-control codeIdentifiantEtablissement" id="ecole_id" name="ecole_id" value="{{ old('ecole_id') }}" aria-describedby="codeHelp">
                    <div id="codeHelp" class="form-text mb-4">Celui-ci se compose de 7 chiffres suivi d'une lettre.</div>
                </div>
                <div class="col">
                    <label for="register_search" class="form-label">Ou faites une recherche d'établissement par code postal :</label>
                    <div class="d-flex">
                        <input type="text" class="form-control me-2" id="register_search" name="register_search" value="{{ old('register_search') }}">
                        <a class="btn btn-primary boutonRechercheEtablissementParCP"><i class="fa-solid fa-magnifying-glass"></i></a>
                    </div>
                </div>
            </div>

            <div id="register_afficheLaListeDesEtablissements" class="mb-3" style="display:none">
                <div class="p-4" style="background:yellow; border-radius: 8px">
                <select class="form-select" id="register_listeDesEcoles"></select>
                </div>
            </div>
            
            @if($role == 'user')
                <div class="alert alert-info">
                    <i class="fa-solid fa-circle-info me-1"></i> Si vous n'êtes pas rattaché à un établissement, veuillez juste l'indiquer ci-dessous et continuer.
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input switchSansIdentifiantEtablissement" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="switch" value="1">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Je ne suis pas rattaché à un établissement.</label>
                </div>
            @endif

        </div>
        <div class="card-footer px-5 pb-3">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('registration.start') }}">Annuler</a>
                <button class="btnAction">
                    {{ __('Suivant') }}
                </button>
            </div>
        </div>        

    </div>

</form>

@endsection
