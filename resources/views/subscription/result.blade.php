@extends('layouts.mainMenu', ['titre' => 'Abonnement', 'menu' => 'souscrire'])

@section('content')

<div class="container mt-5">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
   
                <div class="card-body">
   
                    @if($result == 'succeeded' || $result == 'true')
                        <div class="alert alert-success">
                            Merci. Vous êtes abonné(e) au service Les Maternelles pour 1 an.
                        </div>
                    @else
                        <div class="alert alert-danger">
                            Une erreur est survenue : {{ $result }}
                        </div>
                    @endif
   
                </div>
            </div>
        </div>
    </div>

@endsection
