@extends('layouts.mainMenu2', ['titre' => "Les groupes d'élèves",'menu' => 'affectation_groupe'])

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
        height: auto;
        min-height: 100px;
        font-size: 14px;
        padding: 5px;
        border: 4px solid transparent;
        border-radius: 15px;
        margin: 8px;
        background-color: white;
    }



    .badge_termes.active {

        border: 2px solid black;


    }


</style>


<div class="d-flex flex-wrap container mt-5">
@foreach ($eleves as $eleve)
    @php
        if (is_null($eleve->groupe)) {
            $c = 'transparent';
        } else {
            $c = $groupes[$eleve->groupe]['backgroundColor'];
        }
     
        
      
    @endphp
    <div class="d-flex card-eleve" data-eleve="{{$eleve->id}}" style="border-color:{{$c}}">
        <div class="d-flex flex-column w-75">
            <div>{{$eleve->prenom}}</div>
            <div>{{$eleve->nom}}</div>
            <div>{{$eleve->ddn}}</div>            
        </div>
        

            <div style="width: 40%" class="d-flex flex-column align-items-end">
                @foreach ($groupes as $key=>$terme)
                    <div class="badge_termes {{ $eleve->groupe != null && $key == $eleve->groupe ? 'active' : null}}" data-color="{{$terme['backgroundColor']}}" style="background-color: {{$terme['backgroundColor']}}; color: {{$terme['textColor']}}; border: 1px solid {{$terme['textColor']}}" data-order="{{$key}}">{{$terme['name']}}</div>
                @endforeach
            </div>
           
        


    </div>
@endforeach    
</div>

@endsection