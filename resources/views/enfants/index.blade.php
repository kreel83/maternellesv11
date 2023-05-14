@extends('layouts.mainMenu', ['titre' => 'Ma classe'])

@section('content')
<div id="page_enfants" class="row p-2">
        <div class="col-md-3"></div>
        <div class="col-md-7 d-flex flex-wrap">
                @foreach ($enfants as $enfant)
                @include('cards.enfant')
                @endforeach                
        </div>
        <div class="col-md-2"></div>


 
</div>


@endsection
