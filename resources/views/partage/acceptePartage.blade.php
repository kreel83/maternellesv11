@extends('layouts.parentLayout',['titre' => env('APP_NAME')])

@section('content')

<div class="card mx-auto p-0 mt-5" style="width: auto; height: auto">

    <div class="card-body text-center">

        @if($acceptePartage)
            <h4>Merci ! Vous avez accepté le partage de la classe de {{ $nomTitulaire }}.</h4>
        @else
            <h4>Une erreur est survenue. Le partage ne peut pas être finalisé.</h4>
        @endif
        
        
    </div>

    <div class="card-footer text-center">
        <a href="{{ route('login') }}" class="btnAction mx-auto">Se connecter</a>

    </div>

</div>

    
@endsection