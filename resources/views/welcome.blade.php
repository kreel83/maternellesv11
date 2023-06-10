@extends('layouts.mainMenu', ['titre' => 'Bienvenue'])

@section('content')
<div class="container mt-5">

    @if (!$finsouscription)
        <h4 class="text-center">
            <div class="alert alert-warning" role="alert">
                Vous n'avez pas d'abonnement en cours. <a class="alert-link" href="{{ route('subscribe.index') }}">Cliquez ici</a> pour vous abonner
            </div>
        </h4>
    @else
        <h4 class="text-center">
            <div class="alert alert-success" role="alert">
                Votre abonnement se termine le {{ Carbon\Carbon::parse($finsouscription)->format('d/m/Y')}}
            </div>
        </h4>
    @endif
    
    @if ($anniversaires->isEmpty())
        <h1>non !!</h1>
        @else
    <div class="anniversaire_texte">Les anniversaires du mois de <br> {{$moisActuel}}</div>
    <div class="anniversaires">
        @foreach($anniversaires as $enfant)
            <div class="anniversaire">
                <div class="day" style="background-color: {{$enfant->genre == 'F' ? 'var(--pink)' : 'var(--blue)'}}">{{$enfant->jour}}</div>
                <div class="name">{{$enfant->prenom}}</div>
            </div>

        @endforeach
    </div>


    @endif

    <div class="row text-center">
        <div class="col"><a href="{{ route('subscribe.index') }}" class="btn btn-primary">Souscrire un abonnement</a></div>
        <div class="col"><a href="{{ route('subscribe.cancel') }}" class="btn btn-primary">Résilier mon abonnement</a></div>
        <div class="col"><a href="{{ route('subscribe.resume') }}" class="btn btn-primary">Réactiver mon abonnement</a></div>
        <div class="col"><a href="{{ route('subscribe.invoice') }}" class="btn btn-primary">Mes factures</a></div>
    </div>

</div>
@endsection
