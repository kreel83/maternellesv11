@extends('layouts.mainMenu2', ['titre' => 'Bienvenue', 'menu' => 'accueil'])

@section('content')

<div class="container mt-5 py-4 d-flex justify-content-center alignb-items-center">

    <div class="d-flex align-items-center flex-column mt-5 mx-0" style="width:50%">
        <div>
            <h3 style="color: var(--main-color)"><i class="fa-solid fa-xmark me-3" ></i><span> Une erreur est survenue.</span></h3>
        </div>

            @if(session()->has('msg'))
            <div class="mt-4 alert" role="alert" style="background-color: var(--second-color); color: white">
            {{ session('msg') }}
            </div>
            @endif

            <div class="mt-4">
                Veuillez réessayer ultérieurement.
            </div>

            <div class="mt-4">
                <a href="{{ route('depart') }}" class="btnAction" role="button">Retour au tableau de bord</a>
            </div>        
    </div>
	


</div>

@endsection