@extends('layouts.mainMenu2', ['titre' => 'Ma classe', 'menu' => 'avatar'])
@php
    $degrades = App\Models\Enfant::DEGRADE;

@endphp
@section('content')
<div id="page_enfants" class="row d-flex p-5 gx-0 mt-5 " >
        <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('depart')}}">Tableau de bord</a></li>
                <li class="breadcrumb-item"><a href="{{route('enfants',['type' => $type])}}">Liste des enfants</a></li>
                <li class="breadcrumb-item active" aria-current="page">Avatar</li>
              </ol>
            </nav>
        <div class="col-md-12 d-flex flex-wrap">
                @foreach ($enfants as $kE=>$enfant)
                @include('cards.enfant',['type' => 'avatar','kE' => $kE])
                @endforeach                
        </div>



 
</div>


@endsection
