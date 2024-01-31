@extends('layouts.template1', ['titre' => 'Mon compte '.config('app.name')])

@section('content')


<div class="card mx-auto p-0 text-center w-75">
    <div class="card-body">
        <div class="mt-2">
            @if($user)
                <h2>Félicitations !</h2>
                <h4>Votre compte est maintenant activé</h4>
                @if($acceptePartage)
                    <div class="alert alert-info mt-4 mb-0" role="alert">
                        Vous avez maintenant accès à la classe de {{ $nomTitulaire }}.
                    </div>
                @endif
            @else
                <h3>La validation a échouée !</h3>
                <p>Aucun compte trouvé.</p>
            @endif    
        </div>    
    </div>

    @if($user)
        <div class="card-footer pb-4">
            <a class="btnAction mx-auto" href="{{ route('login') }}">Accéder à l'application</a>
        </div>
    @endif

</div>

@endsection