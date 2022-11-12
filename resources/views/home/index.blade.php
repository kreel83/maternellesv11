@extends('layouts.mainMenu')

@section('content')

<!--

GRADIENT BANNER DESIGN BY SIMON LURWER ON DRIBBBLE:
https://dribbble.com/shots/14101951-Banners

-->
<div class="main-container">

    <div class="cards">
      <div class="card card-1">
        <div class="card__icon"><i class="fas fa-camera"></i></div>
        <p class="card__exit"><i class="fas fa-times"></i></p>
        <h2 class="card__title">Ma classe</h2>
        <p class="card__apply">
          <a class="card__link" href="{{route('enfants')}}">C'est parti ! <i class="fas fa-arrow-right"></i></a>
        </p>
      </div>
      <div class="card card-2">
        <div class="card__icon"><i class="fas fa-bolt"></i></div>
        <p class="card__exit"><i class="fas fa-times"></i></p>
        <h2 class="card__title">Mes cahiers de progrès</h2>
        <p class="card__apply">
          <a class="card__link" href="#">C'est parti ! <i class="fas fa-arrow-right"></i></a>
        </p>
      </div>
      {{--<div class="card card-3">--}}
        {{--<div class="card__icon"><i class="fas fa-bolt"></i></div>--}}
        {{--<p class="card__exit"><i class="fas fa-times"></i></p>--}}
        {{--<h2 class="card__title">Ma correspondance</h2>--}}
        {{--<p class="card__apply">--}}
          {{--<a class="card__link" href="#">C'est parti ! <i class="fas fa-arrow-right"></i></a>--}}
        {{--</p>--}}
      {{--</div>--}}
      <div class="card card-4">
        <div class="card__icon"><i class="fas fa-bolt"></i></div>
        <p class="card__exit"><i class="fas fa-times"></i></p>
        <h2 class="card__title">Mon calendrier</h2>
        <p class="card__apply">
          <a class="card__link" href="#">C'est parti !<i class="fas fa-arrow-right"></i></a>
        </p>
      </div>
      <div class="card card-5">
        <div class="card__icon"><i class="fas fa-bolt"></i></div>
        <p class="card__exit"><i class="fas fa-times"></i></p>
        <h2 class="card__title">Mes paramètres</h2>
        <p class="card__apply">
          <a class="card__link" href="{{route('parametres')}}">C'est parti ! <i class="fas fa-arrow-right"></i></a>
        </p>
      </div>

    </div>
  </div>

  @endsection
