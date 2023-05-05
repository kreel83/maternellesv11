@extends('layouts.mainMenu', ['titre' => 'Mon calendrier'])
@php
    use Carbon\Carbon;


@endphp

@section('content')



    <div class="d-flex flex-wrap justify-content-between" id="calendrier_scolaire">
        <input type="hidden" value="{{$conges}}" id="conges">
        <input type="hidden" value="{{$anniversaires}}" id="anniversaires">
        <input type="hidden" value="{{$ddj}}" id="ddj">
        @for ($j=1; $j<=12;$j++)



            @include('calendrier.include.month',['month', $month])



        @endfor
    </div>

@endsection
