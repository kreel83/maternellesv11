@extends('layouts.mainMenu', ['titre' => 'Mes paramètres'])

@section('content')


    <div class="main-container">

        <div class="cards">
            <div class="card card-1">
                <div class="card__icon"><i class="fas fa-camera"></i></div>
                <p class="card__exit"><i class="fas fa-times"></i></p>
                <h2 class="card__title">Mes phrases</h2>
                <p class="card__apply">
                    <a class="card__link" href="{{route('phrases')}}">C'est parti ! <i class="fas fa-arrow-right"></i></a>
                </p>
            </div>
        </div>
        <div class="card card-2">
            <div class="card__icon"><i class="fas fa-bolt"></i></div>
            <p class="card__exit"><i class="fas fa-times"></i></p>
            <h2 class="card__title">Mes fiches</h2>
            <p class="card__apply">
                <a class="card__link" href="{{route('fiches')}}">C'est parti ! <i class="fas fa-arrow-right"></i></a>
            </p>
        </div>
    </div>

@endsection
