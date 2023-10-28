@extends('layouts.mainMenu2',['titre' => 'Ma classe', 'menu' => 'eleve'])

<style>
    .avatar_form {
        width: 60px;
        height: 60px;
        border: 3px solid transparent;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer
    }  
    .avatar.pink.selected {
        border-color: pink;
    }    
    .avatar.blue.selected {
        border-color: lightblue;
    }
    .avatar {
        font-size: 40px;
    }
    
    .avatar.pink {
        color: lightpink;
    }
    .avatar.blue {
        color: lightskyblue;
    }
</style>

@php
    // dd($resultats);
@endphp

@section('content')
<div class="mt-5">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('depart') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item"><a href="{{ route('maclasse') }}">Ma classe</a></li>
        <li class="breadcrumb-item active" aria-current="page">Mon élève</li>
    </ol>
    <div class="row">
        <div class="{{($resultats->isEmpty()) ?  'offset-md-2 col-md-8' : 'col-md-6'}}">

            @include('eleves.include.eleve_form')
        </div>
        @if (!$resultats->isEmpty())
            <div class="col-md-6">

                <h4 class="text-center">Compétences acquises</h4>

                @php
                    $section_id = 0;
                @endphp
                <div class="liste_eleves ps-4" style="margin-top: 20px;">

                        @foreach($resultats as $resultat)

                            @if($section_id != $resultat->section_id)
                                <div class="mb-1 mt-3">
                                    <img width="40" class="img-fluid" src="{{ asset('img/illustrations/'.$resultat->sectionLogo) }}">
                                    <strong>{{ $resultat->sectionName }}</strong>
                                </div>
                                @php
                                    $section_id = $resultat->section_id;
                                @endphp
                            @endif

                            <div class="mb-1 ml-5">
                                {{ $resultat->itemName }}
                                @if($resultat->autonome == 1)
                                    (autonome)
                                @endif
                            </div>
                            
                        @endforeach

                </div>

            </div>            
        @endif

    </div>

</div>

@endsection
