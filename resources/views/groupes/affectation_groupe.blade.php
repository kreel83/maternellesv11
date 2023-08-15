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
        height: auto;
        min-height: 100px
        font-size: 14px;
        padding: 5px;
        border: 4px solid transparent;
        border-radius: 15px;
        margin: 8px;
        background-color: white;
    }

    .badge_termes {
        padding: 2px 4px;
        font-size: 12px;
        border-radius: 40px;
        border: 1px solid purple;
        color: purple;
        background-color: white;
        width: fit-content;
        min-width: 25px;
        min-height: 25px;
        margin: 4px 0;
        cursor: pointer;
    }

    .badge_termes.active {

        border: 2px solid black;


    }


</style>


<div class="d-flex flex-wrap container">
@foreach ($eleves as $eleve)
    @php
        if ($eleve->groupe != null) {
            $c = $groupes[$eleve->groupe][1];
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
        

            <div style="width: 40%" class="d-flex flex-column align-items-end">
                @foreach ($groupes as $key=>$terme)


                <div class="badge_termes {{ $eleve->groupe != null && $key == $eleve->groupe ? 'active' : null}}" data-color="{{$terme[1]}}" style="background-color: {{$terme[1]}}; color: {{$terme[2]}}" data-order="{{$key}}">{{$terme[0]}}</div>
                @endforeach
            </div>
           
        


    </div>
@endforeach    
</div>

@endsection