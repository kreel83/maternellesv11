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

@include('include.display_msg_error')

<div class="mt-5 mb-4">
    <h5 class="text-center">Etape 1 / 3 : choix de l'établissement</h5>
</div>
<form action="{{ route('registration.step1.post') }}" method="post">
@csrf
<div class="card mx-auto p-0" style="width: 36rem; height: 20rem">


    <input type="hidden" name="role" value="{{ $role }}">

    <div class="card-body p-5">
        <label for="ecole_id" class="form-label">Saisissez l'identifiant de votre établissement</label>
        <input type="text" class="form-control" id="ecole_id" name="ecole_id" value="{{ old('ecole_id') }}" required>
        <small>Celui-ci se compose de 7 chiffres suivi d'une lettre</small>
    </div>
    <div class="card-footer mt-5 px-5 d-flex justify-content-between align-items-center">
    
        <a href="{{ route('registration.start') }}">Annuler</a>
        <button class="btnAction">
            {{ __('Suivant') }}
        </button>
    </div>        
    
    



</div>
</form>

@endsection
