@extends('layouts.admin', ['titre' => 'Gestion des licences', 'menu' => 'licence'])

@section('content')

<h4>Retirer une licence pour un utilisateur</h4>

@if($licence)

    <p>Veuillez confirmer le retrait de la licence numéro {{ $licence->licenceName }} 
        pour <strong>{{ $licence->prenom.' '.$licence->nom }}</strong></p>

    <form action="{{ route('admin.licence.remove.post') }}" method="post">
    @csrf
        <input type="hidden" name="id" value="{{ $licence->id }}">
        <div class="row">
            <div class="col-auto">
                <button class="btn btn-primary">Je confirme le retrait</button>
            </div>
            <div class="col-auto">
                <a href="{{ route('admin.licence.index') }}" class="btn btn-default">Annuler</a>
            </div>
        </div>
    </form>

@else

    <div class="alert alert-danger" role="alert">
        Erreur : numéro de licence erroné !
    </div>
    <p>Retrouvez toutes vos licences en <a href="{{ route('admin.licence.index') }}">cliquant ici</a>.</p>

@endif



@endsection
