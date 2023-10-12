@extends('layouts.mainMenu2', ['titre' => 'Abonnement', 'menu' => 'reactiver'])

@section('content')
<div class="container mt-5">
    
    <h1 class="text-center">Réactiver mon abonnement</h1>

    @if(session()->has('result'))
        @if(session('result'))
            <div class="alert alert-success text-center" role="alert">
                Votre abonnement a été réactivé.
            </div>
        @else
            <div class="alert alert-danger text-center" role="alert">
                Une erreur s'est produite. La réactivation de l'abonnement a échouée.
            </div>
        @endif
        <div class="mt-4 text-center">
            <a href="{{ route('subscribe.index') }}">Retour à mon abonnement</a>
        </div>
    @else
        @if($onGracePeriode)
            <p class="text-center">Votre abonnement est résilié et reste néanmoins actif jusqu'au {{ Carbon\Carbon::parse($finsouscription)->format('d/m/Y')}}.</p>
            <p class="text-center">En réactivant votre abonnement, celui-ci sera automatiquement renouvelé après cette date.</p>
            <div class="text-center">
                <form action="{{ route('subscribe.resumesubscription') }}" method="post">
                    @csrf
                    <button class="btn btn-primary">Je souhaite réactiver mon abonnement</button>
                </form>
            </div>
        @else
            <p class="text-center">Votre abonnement ne peut pas être réactivé car il n'a pas été résilié.</p>
            <div class="mt-4 text-center">
                <a href="{{ route('subscribe.index') }}">Retour à mon abonnement</a>
            </div>
        @endif
    @endif

</div>
@endsection
