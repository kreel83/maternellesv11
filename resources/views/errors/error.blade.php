@extends('layouts.mainMenu2', ['titre' => 'Bienvenue', 'menu' => 'accueil'])

@section('content')

<div class="container mt-5 py-4">

    <div>
        <h2><i class="fa-solid fa-xmark fa-2xl me-3"></i><span class="text-secondary"> Une erreur est survenue.</span></h2>
    </div>
	
	@if(session()->has('msg'))
	<div class="mt-4 alert alert-danger" role="alert">
	  {{ session('msg') }}
	</div>
	@endif

    <div class="mt-4">
        Veuillez réessayer ultérieurement.
    </div>

    <div class="mt-4">
        <a href="{{ route('depart') }}" class="btn btn-primary" role="button">Retour au tableau de bord</a>
    </div>

</div>

@endsection