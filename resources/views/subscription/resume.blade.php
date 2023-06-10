@extends('layouts.mainMenu', ['titre' => 'Abonnement'])

@section('content')
<div class="container mt-5">
    
    <h1 class="text-center">Réactiver mon abonnement</h1>

    @if($onGracePeriode)
        <p class="text-center">Merci. Votre abonnement a été réactivé et est pleinement fonctionnel.</p>
    @else
        <p class="text-center">Votre abonnement ne peut pas être réactivé car il n'a pas été résilié.</p>
    @endif

    <div class="text-center">
        <a href="{{ route('depart') }}" class="btn btn-primary">Continuer</a>
    </div> 

</div>
@endsection
