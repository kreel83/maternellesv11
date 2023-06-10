@extends('layouts.mainMenu', ['titre' => 'Abonnement'])

@section('content')
<div class="container mt-5">
    
    <h1 class="text-center">Souscrire un abonnement</h1>
    <h3 class="text-center">Seulement 9,90 € / an</h3>
    <p class="text-center">Description du service....</p>

    <div class="text-center">
        <a href="{{ route('subscribe.cardform') }}" class="btn btn-primary">Je m'abonne</a>
    </div> 

</div>
@endsection
