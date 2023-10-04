@extends('layouts.parentLayout', ['titre' => 'Validation'])

@section('content')

@if($user)

    <h2>Votre compte est maintenant activé !</h2>
    <p>Vous pouvez vous connecter dès à présent en <a href="{{ route('login') }}">cliquant ici</a>.</p>

@else

    <h3>La validation a échouée !</h3>
    <p>Aucun compte trouvé.</p>

@endif

@endsection