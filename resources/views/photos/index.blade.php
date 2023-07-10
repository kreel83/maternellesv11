@extends('layouts.mainMenu',['titre' => 'Les mots de passe', 'menu' => 'mdp'])



@section('content')
<div class="row">
    <div class="col-md-2">
        <div style="height: 600px ;overflow-y: scroll">
            @foreach($eleves as $key => $eleve)
                <div class="eleve prenom" data-enfant="{{$eleve->id}}"data-prenom="{{$eleve->prenom}}">{{$eleve->prenom}} {{substr(ucfirst($eleve->nom),0,1)}}.</div>
            @endforeach
        </div>
        <div style="height: 140px;" class="d-flex mt-3">
            <div class="choixEnfant position-relative" style="background-image: {{$degrades['b1']}}">
                <div class="curved-text position-absolute" ></div>
                <div class="imageAnimaux position-absolute" style="top:0left:0;right:0;bottom:0; z-index:5000"></div>

            </div>
        </div>
    </div>
    <div class="col-md-10">
        <div style="height: calc(100vh - 250px);overflow-y: auto" class="d-flex flex-wrap">

            @foreach ($files as $file)
                <div class="m-2 degrade animaux"  data-animaux="{{$file}}" style="background-image: {{$degrades['b1']}}">
                    <img src="{{asset('/img/animaux/'.$file)}}" alt="" width="120">
                
                </div>
            @endforeach
        </div>  
        <div style="height: 140px;" class="d-flex justify-content-between pt-1 px-3">
            @foreach ($degrades as $key=>$degrade)
                <div class="degrade choixDegrade" data-id="{{$key}}" style="background-image: {{$degrade}}"></div>
            @endforeach
        </div>      
    </div>


</div>
@endsection
