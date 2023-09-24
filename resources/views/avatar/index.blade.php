@extends('layouts.mainMenu', ['titre' => 'Ma classe', 'menu' => 'avatar'])
@php
    $degrades = App\Models\Enfant::DEGRADE;
@endphp
@section('content')
<div id="page_enfants" class="row d-flex p-5 gx-0 " >
        
        <div class="col-md-12 d-flex flex-wrap">
                @foreach ($enfants as $kE=>$enfant)
                @include('cards.enfant',['type' => 'avatar','kE' => $kE])
                @endforeach                
        </div>



 
</div>


@endsection
