@extends('layouts.createAccount')

@section('content')


<div class="card mx-auto p-0 text-center" style="width: 36rem; height: 20rem">
    <div class="card-body p-5">
    @if($user)
        <h2>Félicitation !</h2>
        <br>
        <h4>Votre compte est maintenant activé</h4>
        

    @else

        <h3>La validation a échouée !</h3>
        <p>Aucun compte trouvé.</p>

    @endif        
    </div>
    @if($user)
    <div class="card-footer">
        <a class="btnAction mx-auto" href="{{ route('login') }}">Accéder à l'application</a>
    </div>
    @endif

</div>

@endsection