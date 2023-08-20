@extends('layouts.mainMenu', ['titre' => 'Mes périodes', 'menu' => 'periode'])


@section('content')
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif
    @if (\Session::has('error'))
        <div class="alert alert-danger">
            <ul>
                <li>{!! \Session::get('error') !!}</li>
            </ul>
        </div>
    @endif
<h1>Gestion des périodes</h1>

<div class="row">

    <div class="col-md-9 d-flex flex-wrap " id="calendrier_periodes" style="overflow-y: auto">
               
        <input type="hidden" value="{{$conges}}" id="conges">
        <input type="hidden" value="{{$start}}" id="start">
        <input type="hidden" value="{{$end}}" id="end">
        
    
        @for ($j=1; $j<=12;$j++)
            @include('calendrier.include.month',['month', $month])
        @endfor
     
    </div>
    <div class="col-md-3 d-flex flex-column" id="formulaire_periodes">
      
            @include('calendar.include.periodes_form')
          
    </div>
</div>








@endsection
