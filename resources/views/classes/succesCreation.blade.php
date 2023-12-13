@extends('layouts.mainMenu2',['titre' => 'Ma classe', 'menu' => 'createClasse'])

@php
    // dd($resultats);
@endphp

@section('content')

<div class="mt-5 container">

    <div class="card mx-auto w-75">
        <div class="card-header">
            <div class="d-flex justify-content-between pt-2">
                <h5>{{ $title }}</h5>
            </div>
        </div>
        <div class="card-body">

            <h5 class="card-title mb-3">
            @if($classe_id == 'new')
                Félicitations ! vous avez crée la classe :
            @else
                Félicitations ! les modifications ont bien été sauvegardées pour la classe :
            @endif
            </h5>

            <ul>
                <li>{{ $description}}</li>
            </ul>

        </div>        

    </div>

</div>

@endsection
