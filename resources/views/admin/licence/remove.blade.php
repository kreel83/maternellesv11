@extends('layouts.admin', ['titre' => 'Gestion des licences', 'menu' => 'licence'])

@section('content')

<h4>Retirer une licence pour un utilisateur</h4>

@if($licence)

    <div class="mb-3">
        Veuillez confirmer le retrait de la licence n° {{ $licence->internal_name }} 
        pour <strong>{{ $licence->prenom.' '.$licence->nom }}</strong>
    </div>

    <form action="{{ route('admin.licence.remove.post') }}" method="post">
    @csrf
        <input type="hidden" name="licence_name" value="{{ $licence->internal_name }}">
        <div class="justify-content-start">
            <a class="btn btn-outline-secondary me-2" href="{{ route('admin.licence.index') }}" role="button">Annuler</a>
            <button type="submit" class="btn btn-primary">Je confirme le retrait</button>
        </div>
    </form>

@else

    <div class="alert alert-danger" role="alert">
        Erreur : numéro de licence erroné !
    </div>
    <p>Retrouvez toutes vos licences en <a href="{{ route('admin.licence.index') }}">cliquant ici</a>.</p>

@endif



@endsection
