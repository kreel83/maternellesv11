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

<div class="mt-3 mb-4">
    <h5>Etape 1 / 3 : choix de l'établissement</h5>
</div>

<form action="{{ route('registration.step1.post') }}" method="post">
@csrf

    <input type="hidden" name="role" value="{{ $role }}">

    <div class="mb-3">
        <label for="ecole_id" class="form-label">Merci de saisir l'identifiant de votre établissement composé de 7 chiffres et 1 lettre</label>
        <input type="text" class="form-control" id="ecole_id" name="ecole_id" value="{{ old('ecole_id') }}" required>
    </div>
    
    <div class="">
        <button class="btn btn-primary ml-3">
            {{ __('Suivant') }}
        </button>
    </div>

    <p class="mt-4"><a href="{{ route('registration.start') }}">Annuler</a></p>

</form>

@endsection
