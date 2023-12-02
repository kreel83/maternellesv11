@extends('layouts.mainMenu2', ['titre' => "Les groupes d'élèves", 'menu' => 'groupe'])

@section('content')
@php
    use App\Models\Enfant;
@endphp

<style>

    #myTabContent {
        background-color: var(--third-color);
        border-radius: 26px;
    }

    .terme.selected {
        outline: 6px solid  var(--main-color);
        border-radius: 40px;
    }
    
    
    .ronds {
        border: 1px solid white;
        padding: 2px 18px;
        font-weight: 700;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin: 4px;
        cursor: pointer;
        display: flex;
        justify-content: center;
        align-items: center;
        color: grey;
        font-size: 60px;
    }

    .picker {
        b_order: 1px solid white;
        padding: 2px 18px;
        f_ont-weight: 700;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        m_argin: 4px;
        cursor: pointer;
        d_isplay: flex;
        j_ustify-content: center;
        a_lign-items: center;
        border: none;
        outline: none;
    }

    .couleur_badge_titre {
        color: var(--main-color);
        font-size: 20px;
    }
    
    .br-40 {
        cursor: pointer;
        border-radius: 40px !important;
    }

    .ronds:hover,
    .ronds.active {
        outline: 3px solid gray;
    }

    .fa-circle {
        font-size: 20px;
    }

    .style1 {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    width: 100px;
    height: 100px;
    background-color: transparent;
    border: none;
    cursor: pointer;
    }
    .style1::-webkit-color-swatch {
    border-radius: 15px;
    border: none;
    }
    .style1::-moz-color-swatch {
    border-radius: 15px;
    border: none;
    }

    .style2 {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background-color: transparent;
    width: 100px;
    height: 100px;
    border: none;
    cursor: pointer;
    }
    .style2::-webkit-color-swatch {
    border-radius: 50%;
    border: 1px solid #000000;
    }
    .style2::-moz-color-swatch {
    border-radius: 50%;
    border: 1px solid #000000;
    }

    .container-picker {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 30px;
    }

</style>
@php
    //dd($enfants);
    // dd($groupes);
    //dd($nbGroupe);
@endphp

<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('depart')}}">Tableau de bord</a></li>        
        <li class="breadcrumb-item active" aria-current="page">Création des groupes</li>
    </ol>
</nav>

<h4 class="mb-3">Supprimer un groupe</h4>

@if($enfants->count() > 0)

    <div class="alert alert-danger" role="alert">
        <div class="mb-3">
            ce groupe ne peut pas etre supprimé car il est affecté aux élèves suivants :
        </div>
        <div class="mb-3">
        @foreach ($enfants as $enfant)
            {{ $enfant->prenom}} <span class="{{ env('App_DEMO') ? 'blur' : null}}">{{$enfant->nom}}</span><br>
        @endforeach
        </div>
        <div>
            Veuillez d'abord changer le groupe pour chaque élève.
        </div>
  </div>

@else

    <div class="alert alert-info" role="alert">
        Ce groupe peut-être supprimé car il n'est affecté à aucun élève.
    </div>
    
@endif

<div class="c_ard c_ard-body w_-75">

    <form action="{{ route('supprimerUnGroupePost') }}" method="POST">
    @csrf

        <input type="hidden" name="id" value="{{ $id }}">
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="icone-input mb-3">
            Apercu de mon groupe<br>
            <input type="text" value="{{ $id != 'new' ? $groupes[$id]['name'] : null }}" 
            @if($id != 'new')
                style="background: {{ $groupes[$id]['backgroundColor'] }}; color: {{ $groupes[$id]['textColor'] }}" 
            @endif
            class="custom-input br-40" id="apercuGroupe" readonly>
        </div>

        @if($enfants->count() == 0)
            <div class="mb-5">
                <button type="submit" class="custom_button">Supprimer le groupe</button>
            </div>
            <div class="mb-3">
                <a href="{{ route('groupe') }}" class="btn btn-outline-secondary btn-sm">Annuler</a>
            </div>
        @else
            <div class="mb-3">
                <a href="{{ route('groupe') }}" class="btn btn-outline-secondary btn-sm">Retour aux groupes</a>
            </div>
        @endif

        

    </form>
    
</div>

@endsection
    