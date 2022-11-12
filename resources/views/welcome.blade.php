@extends('layouts.mainMenu')

@section('content')
<div class="container mt-5">
    @if ($anniversaires->isEmpty())
        <h1>non !!</h1>
        @else
    <div class="anniversaire_texte">Les anniversaires du mois de <br> {{$moisActuel}}</div>
    <div class="anniversaires">
        @foreach($anniversaires as $enfant)
            <div class="anniversaire">
                <div class="day" style="background-color: {{$enfant->genre == 'F' ? 'var(--pink)' : 'var(--blue)'}}">{{$enfant->jour}}</div>
                <div class="name">{{$enfant->prenom}}</div>
            </div>

        @endforeach
    </div>


    @endif



</div>
@endsection
