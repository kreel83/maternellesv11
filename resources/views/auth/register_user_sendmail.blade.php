@extends('layouts.parentLayout')

@section('content')    

<div class="text-center mt-3">

    <h4>Merci pour votre inscription</h4>

    <p>Un email contenant un lien de vérification a été envoyé sur : {{ $email }}</p>

    <p>Merci de cliquer sur ce lien pour activer votre compte.</p>

</div>
    
@endsection