@extends('layouts.parentLayout', ['titre' => 'Validation'])

@section('content')

@if(is_null($user))

    <h3>La validation a échouée !</h3>
    <p>Aucun compte trouvé.</p>

@else

    <h2>Validation confirmée</h2>
    <p>Vous pouvez maintenant vous connecter à votre compte en <a href="{{ route('login') }}">cliquant ici</a>.</p>

@endif

@endsection