@extends('layouts.mainMenu', ['titre' => 'Ma classe', 'menu' => 'evaluation'])
@php
    $degrades = App\Models\Enfant::DEGRADE;
@endphp
@section('content')
<div id="page_enfants" class="row d-flex p-5 gx-0 " >
        
        <div class="col-md-12 d-flex flex-wrap">
                @foreach ($enfants as $enfant)
                @include('cards.enfant',['type' => 'evaluation'])
                @endforeach                
        </div>



 
</div>


@endsection
