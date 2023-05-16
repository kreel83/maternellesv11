@extends('layouts.mainMenu', ['titre' => 'Création'])

@section('content')

<style>
    .mdp{
        font-size: 40px;
        text-align: center;
        line-height: 50px;
    }
    .submit {
        height: 50px;
        font-size: 25px;
        width: 200px;
        line-height: 40px;
        border-radius: 5px;
        color:white;
        cursor: pointer;
        background-color: blue;
    }
    .alert {
        width: 100%;
        height: 40px;
        line-height: 40px;
        background-color: rgba(240, 48, 45, 0.1);
        border-radius: 6px;
        position: relative;
        padding: 5px;
        color: black;
    
    }

    
</style>

<div>
    @if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">

        <strong>{{ $message }}</strong>
</div>
@endif

    <form action="{{route('parent')}}" method="POST">
        @csrf
        <h1>Bienvenue sur la page de téléchargement</h1>
        <h2>Du cahier de progrès de votre enfant</h2>   
        <input type="text" class="mdp" name="mdp"> 
        <button type="submit" class="submit">Valider</button>
    </form>
    
</div>



@endsection