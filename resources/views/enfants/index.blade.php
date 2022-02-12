@extends('layouts.mainMenu')

@section('content')
<div id="page_enfants">
    <div class="d-flex flex-wrap">
        @foreach ($enfants as $enfant)
        @include('cards.enfant')
        @endforeach
    </div>    
</div>


@endsection
