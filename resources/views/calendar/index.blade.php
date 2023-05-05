@extends('layouts.mainMenu', ,['titre' => 'Mon calendrier'])
@php
    use Carbon\Carbon;


@endphp

@section('content')
    <div class="d-flex w-100 justify-content-between mt-4">
        <div><h1>Calendrier</h1></div>
        <div><button class="btn btnPeriode btnp1" data-periode="p1"  >periode 1</button></div>
        <div><button class="btn btnPeriode btnp2 hide" data-periode="p2" >période 2</button></div>
        <div><button class="btn btnPeriode btnp3 hide" data-periode="p3" >période 3</button></div>
        <div><button class="btn btn-outline-primary" id="savePeriode" data-annee="{{$start_year}}">Sauvegarder</button></div>


    </div>


    <div class="d-flex flex-wrap justify-content-between" id="calendrier">

        @for ($j=1; $j<=12;$j++)



            @include('calendar.include.month',['month', $month])



        @endfor
    </div>

@endsection
