@extends('layouts.mainMenu', ['titre' => 'Ma classe', 'menu' => 'cahier'])
@php
    $degrades = App\Models\Enfant::DEGRADE;
@endphp
@section('content')
<div id="page_enfants" class="row d-flex p-5 " >
        
        <div class="col-md-12 d-flex flex-wrap">
                @foreach ($enfants as $enfant)
                @include('cards.enfant',['type' => 'reussite'])
                @endforeach                
        </div>



 
</div>


@endsection
