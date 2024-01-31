@extends('layouts.template1', ['titre' => 'Mon compte '.config('app.name')])

@section('content')

@if(is_null($user))

    <h3>La validation a échouée !</h3>
    <p>Aucun compte trouvé.</p>

@elseif($user->actif == 1)

    <h3>Ce compte est déjà actif !</h3>
    <p>Veuillez vous identifier en <a href="{{ route('login') }}">cliquant ici</a>.</p>

@else

    <div class="row mb-3">
        <div class="col">
            <img src="{{asset('img/deco/logo.png')}}" alt="" width="150">
        </div>
    </div> 

    <h3 class="mb-3">Création de votre compte {{ config('app.name') }}</h3>
    <p>Félicitations, votre adresse e-mail est validée.</p>
    <p>Pour terminer la création de votre compte, veuillez choisir un mot de passe :</p>

    <!-- Validation Errors -->
    @if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            {{ $error }}<br>
        @endforeach
    </div>
    @endif

    <form method="POST" action="{{ route('user.valideUserFromAdminSavePassword') }}">
        {{ csrf_field() }}
        <input type="hidden" name="token" value="{{ $token }}">

        <!-- password -->
        <div class="mb-3">
            <!--<label for="password" class="form-label">{{ __('Mot de passe') }}</label>-->
            <input placeholder="{{ __('Choisissez un mot de passe') }}" id="password" class="form-control block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" autofocus />
        </div>

        <!-- confirm password -->
        <div class="mb-3">
            <!--<label for="password_confirmation" class="form-label">{{ __('Confirmer le mot de passe') }}</label>-->
            <input placeholder="{{ __('Confirmer le mot de passe') }}" id="password_confirmation" class="form-control block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required />
        </div>

        <div class="text-center">
            <button id="btnsubmit" class="btn btn-primary ml-3">
                {{ __('Confirmer') }}
            </button>
        </div>

    </form>

@endif

@endsection