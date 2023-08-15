@extends('layouts.admin', ['titre' => 'Bienvenue sur votre espace administration', 'menu' => 'monpasse'])

@section('content')

<div class="mb-3">
    <h4>Changement du mot de passe</h4>
</div>

@if(!empty(session('result')))
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
@endif

<div class="mb-3">

    <form action="{{ route('admin.sauverLeMotDePasse') }}" method="post">
    @csrf

        <!-- password -->
        <div class="mb-3">
            <input placeholder="{{ __('Mot de passe') }}" id="password" class="form-control block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
        </div>

        <!-- confirm password -->
        <div class="mb-3">
            <input placeholder="{{ __('Confirmer le mot de passe') }}" id="password_confirmation" class="form-control block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required />
        </div>

        <button type="submit" class="btn btn-primary mt-3">Modifier le mot de passe</button>

    </form>

</div>


<div class="mt-4">
    <a href="{{ route('admin.index') }}">Annuler</a>
</div>

@endsection
