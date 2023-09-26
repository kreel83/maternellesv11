@extends('layouts.parentLayout', ['titre' => 'Validation'])

@section('content')

@if(is_null($user))

    <h3>La validation a échouée !</h3>
    <p>Aucun compte trouvé.</p>

@elseif($user->actif == 1)

    <h3>Ce compte est déjà actif !</h3>
    <p>Veuillez vous identifier en <a href="{{ route('login') }}">cliquant ici</a>.</p>

@else

    <h2>Création de votre compte Les Maternelles</h2>
    <p>Pour terminer la création de votre compte veuillez choisir un mot de passe :</p>

    <!-- Validation Errors -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('user.valideUserFromAdminSavePassword') }}">
        {{ csrf_field() }}
        <input type="hidden" name="token" value="{{ $token }}">
        {{--
        <input type="hidden" name="uID" value="{{ $user->id }}">
        <input type="hidden" name="lID" value="{{ $licence_id }}">
        --}}
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