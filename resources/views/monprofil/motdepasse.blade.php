@extends('layouts.mainMenu2', ['titre' => 'Mot de passe', 'menu' => 'monpasse'])

@section('content')

<div class="container my-5">

    <nav class="pb-4" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('depart')}}">Tableau de bord</a></li>        
            <li class="breadcrumb-item active" aria-current="page">Changement du mot de passe</li>
          </ol>
    </nav>

    <div class="card w-75 mx-auto">

            <div class="card-header">
                <h5>Changement du mot de passe de connexion</h5>
            </div>

            <div class="card-body">

            @include('include.display_msg_error')

            {{-- @if(!empty(session('result')))
                <div class="alert alert-success">Votre mot de passe a été mis à jour.</div>
            @endif

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}

            <div class="mb-3">

                <form action="{{ route('sauverLeMotDePasse') }}" method="post">
                @csrf

                    <!-- password -->
                    <div class="mb-3">
                        <label class="mb-2" for="password">Choisissez un nouveau mot de passe d'un minimum de 8 caractères</label>
                        <input placeholder="{{ __('Nouveau mot de passe') }}" id="password" class="form-control block mt-1 w-full"
                                        type="password"
                                        name="password"
                                        required autocomplete="new-password" autofocus/>
                    </div>

                    <!-- confirm password -->
                    <div class="mb-3">
                        <input placeholder="{{ __('Confirmez le nouveau mot de passe') }}" id="password_confirmation" class="form-control block mt-1 w-full"
                                        type="password"
                                        name="password_confirmation" required />
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btnAction mx-auto">Modifier le mot de passe</button>
                    </div>

                    <div class="text-center mt-3">
                        <a href="{{ route('depart') }}">Annuler</a>
                    </div>

                </form>

            </div>

        </div>

    </div>




</div>

@endsection
