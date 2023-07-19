@extends('layouts.admin', ['titre' => 'Bienvenue sur votre espace administration', 'menu' => 'dashboard'])

@section('content')

<h1>Bienvenue sur votre espace administrateur</h1>

@isset($saveadminprofile)
    <div class="alert alert-success" role="alert">
        Votre profil a été modifié
    </div>
@endisset

@endsection
