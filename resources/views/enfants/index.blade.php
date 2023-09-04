@extends('layouts.mainMenu', ['titre' => 'Ma classe', 'menu' => $type])
@php
    $degrades = App\Models\Enfant::DEGRADE;
@endphp
@section('content')
<div id="page_enfants" class="row d-flex p-5 gx-0 " >
        <form action="{{route('enfants')}}">
                <input type="hidden" value="{{$type}}" name="type">
                <div class="form-group my-5 d-flex flex-column">
                        <div for="ordre">Classement</div>
                        <select name="ordre" id="ordre" class="custom-select w-25 " onchange="this.form.submit()">
                                <option value="alpha" {{$ordre == 'alpha' ? 'selected' : null}}>Par ordre alphabétique</option>
                                <option value="groupe" {{$ordre == 'groupe' ? 'selected' : null}}>Par groupe</option>
                                <option value="age" {{$ordre == 'age' ? 'selected' : null}}>Par âge</option>
                        </select>                
                </div>                
        </form>


        @if ($ordre == 'groupe')
        <div class="col-md-12 d-flex flex-column">
                @foreach ( $enfants as $key=>$groupes )
                <div class="d-flex flex-wrap my-5">
                        @foreach ($groupes as $enfant)
                        @include('cards.enfant',['type' => $type])
                        @endforeach                                
                </div>                              
                @endforeach
        </div>
        @else
                <div class="col-md-12 d-flex flex-wrap">
                        @foreach ($enfants as $enfant)
                        @include('cards.enfant',['type' => $type])
                        @endforeach                
                </div>
        @endif





 
</div>


@endsection
