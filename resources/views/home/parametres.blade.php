@extends('layouts.mainMenu2', ['titre' => 'Mes paramètres'])

@section('content')


    <div class="container">


        <div class="cards">
            <div class="card card-1">
                <div class="card__icon"><i class="fas fa-camera"></i></div>
                <p class="card__exit"><i class="fas fa-times"></i></p>
                <h2 class="card__title">Initalisation Classes</h2>
                <p class="card__apply">
                    <a class="card__link" href="{{route('initClasse')}}">C'est parti ! <i class="fas fa-arrow-right"></i></a>
                </p>
            </div>
        </div>

    </div>

@endsection
