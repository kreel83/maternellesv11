@extends('layouts.mainMenu', ['titre' => "Les groupes d'élèves",'menu' => 'affectation_groupe'])

@section('content')


<style>
    .color_rond {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        margin: 4px;
        cursor: pointer;
    }
    .card-eleve {
        width: 300px;
        height: 100px;
        font-size: 14px;
        padding: 5px;
        border: 4px solid transparent;
        border-radius: 15px;
        margin: 8px;
        background-color: white;
    }
</style>


<div class="d-flex flex-wrap container">
@foreach ($eleves as $eleve)
    @php
        if ($eleve->groupe != null) {
            $c = $user->groupe[$eleve->groupe];
        } else {
            $c = 'transparent';
        }
    @endphp
    <div class="d-flex card-eleve" data-eleve="{{$eleve->id}}" style="border-color:{{$c}}">
        <div class="d-flex flex-column w-75">
            <div>{{$eleve->prenom}}</div>
            <div>{{$eleve->nom}}</div>
            <div>{{$eleve->ddn}}</div>            
        </div>
        
            @if ($user->type_groupe == 'colors')
            <div style="width: 20%" class="d-flex flex-column">
                @foreach ($user->groupe as $key=>$color)
                <div class="color_rond" data-color="{{$color}}" data-id="{{$key}}" style="background-color: {{$color}}"></div>
                @endforeach
            </div>
            @endif
        


    </div>
@endforeach    
</div>

@endsection