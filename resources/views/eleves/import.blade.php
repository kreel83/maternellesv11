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



<div class="mt-5" id="fiche_eleve">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('depart') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item"><a href="{{ route('maclasse') }}">Ma classe</a></li>
        <li class="breadcrumb-item active" aria-current="page">Importation des élèves</li>
    </ol>

    <style>

        .prof:hover, .prof.selected {
            color: white;
            background-color: var(--main-color);
            cursor: pointer;
        }
    </style>


    <div class="d-none d-xxl-block position-relative gx-0 navigateur" style="width: 100%; height: 100vh">
        <div class="row my-5">
        {{-- <img src="{{asset('img/deco/fond_1.jpg')}}" alt="" class="position-absolute" width="100%" height="100%" style="top:0;bottom:0;left:0;right:0; height: 100vh"> --}}

        <div class="col-md-6" style="color: var(--main-color); font-weight: bolder; width: 474px;padding: 16px;height: 617px; border: 1px solid var(--main-color); border-radius: 8px">
            <div class="my-2">Les instituteurs de mon école</div>
            <table class="table table-bordered">
                <tr class="prof selected" data-prof="tous">
                    <td>Tous les instituteurs</td>                    
                </tr>
                @foreach ($profs as $prof)
                <tr class="prof" data-prof="{{$prof->id}}">
                    <td class="ps-5">    
                        <span class="{{ env('App_DEMO') ? 'blur' : null}}">{{$prof->name}}</span> {{$prof->prenom}} 
                    </td>
                </tr>
                @endforeach
            </table>
        </div>            
        
            <div class="offset-md-1 col-md-5" style="color: var(--main-color); font-weight: bolder; ; background-color: white">
                <div class="my-2 fs-6">Les élèves de mon école</div>
                <div class="d-flex align-items-center justify-content-between">
                    <div class="icone-input my-3 little">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" class="searchChoix">
                    </div>
                    <div>
                        <button class="btn btn-primary btn-sm d-none" id="importer">Importer</button>
                    </div>
                </div>
                <table class="table table-bordered">
                    <tr>
                        <td>
                            <div style="height: 20px">
                                <input type="checkbox" class="choix choix_tous">
                            </div>
                        </td>
                        <td>
                            <div>
                                Tous les enfants
                            </div>                        
                        </td>
                    </tr>

                    <style>
                        .psmsgs {
                            color: red;
                            margin-left: 20px;
                            
                        }
                    </style>
                    @foreach ($enfants as $enfant)
                    <tr class="enfant" data-prof="{{$enfant->user_n1_id}}" data-texte="{{ $enfant->nom}} {{ $enfant->prenom}}">
                        <td>
                            <input type="checkbox" class="choix choix_liste" data-id="{{$enfant->id}}">
                        </td>
                        <td>
                            <span class="{{ env('App_DEMO') ? 'blur' : null}}">{{$enfant->nom}}</span> {{ $enfant->prenom}} <span class="psmsgs">{{$enfant->psmsgs}}</span>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>







      

    </div>


</div>
@endsection