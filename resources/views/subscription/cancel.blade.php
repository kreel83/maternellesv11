@extends('layouts.mainMenu', ['titre' => 'Abonnement'])

@section('content')
<div class="container mt-5">
    
    <h1 class="text-center">Résilier mon abonnement</h1>

    @if($onGracePeriode)
        <p class="text-center">Votre abonnement est maintenant résilié.</p>
        <p class="text-center">Il restera toutefois actif jusqu'au {{ Carbon\Carbon::parse($finsouscription)->format('d/m/Y')}} et pourra être réactivé à tout moment jusqu'à cette date.</p>        
        <div class="mt-4 text-center">
            <a href="{{ route('depart') }}">Retour</a>
        </div> 
    @else
        <p class="text-center">Notre service ne correspond pas à vos attentes ? Aucun problème, vous pouvez résilier votre abonnement en 1 clic.</p>
        <p class="text-center">Il restera toutefois actif jusqu'au {{ Carbon\Carbon::parse($finsouscription)->format('d/m/Y')}}.</p>
        <div class="text-center">
            <a href="{{ route('subscribe.cancelsubscription') }}" class="btn btn-primary">Résilier mon abonnement</a>
        </div>
        <div class="mt-4 text-center">
            <a href="{{ route('depart') }}">Annuler</a>
        </div> 
    @endif



</div>
@endsection
