@extends('layouts.mainMenu2', ['titre' => 'Abonnement', 'menu' => 'reactiver'])

@section('content')
<div class="container mt-5">

    <nav class="pb-4" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('depart')}}">Tableau de bord</a></li>        
        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('subscribe.index') }}">Mon abonnement</a></li>
        <li class="breadcrumb-item active" aria-current="page">Réactiver mon abonnement</li>
        </ol>
    </nav>

    <div class="card mx-auto w-75">
        <div class="card-body">
          <h4 class="card-title mb-3">Réactiver mon abonnement</h4>
    
            @if(session()->has('result'))
                @if(session('result'))
                    <div class="alert alert-success" role="alert">
                        Votre abonnement a été réactivé.
                    </div>
                @else
                    <div class="alert alert-danger" role="alert">
                        Une erreur s'est produite. La réactivation de l'abonnement a échouée.
                    </div>
                @endif
                <div class="mt-4">
                    <a href="{{ route('subscribe.index') }}">Retour à mon abonnement</a>
                </div>
            @else
                @if($onGracePeriode)
                    <p>Votre abonnement est résilié et reste néanmoins actif jusqu'au {{ Carbon\Carbon::parse($finsouscription)->format('d/m/Y')}}.</p>
                    <p>En réactivant votre abonnement, celui-ci sera automatiquement renouvelé après cette date.</p>
                    <div class="d-flex flex-row">
                        <div class="me-3">
                            <a class="btn btn-outline-secondary" href="{{ route('subscribe.index') }}">Annuler</a>
                        </div> 
                        <div>
                            <form action="{{ route('subscribe.resumesubscription') }}" method="post">
                                @csrf
                                <button class="btn btn-primary">Je souhaite réactiver mon abonnement</button>
                            </form>
                        </div>
                    </div>

                    
                @else
                    <p>Votre abonnement ne peut pas être réactivé car il n'a pas été résilié.</p>
                    <div class="mt-4">
                        <a class="btn btn-primary" href="{{ route('subscribe.index') }}">Retour à mon abonnement</a>
                    </div>
                @endif
            @endif
        </div>
    </div>

</div>
@endsection
