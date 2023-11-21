@extends('layouts.mainMenu2', ['titre' => "Les groupes d'élèves", 'menu' => 'groupe'])

@section('content')

<style>

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

    .apercu-groupe {
        align-items: center;
        text-align: center;
        height: 37px;
        border-radius: 40px;
        width: 200px;
        border:1px solid grey;
        font-size: 16px;
        padding: 5px 16px;
    }

</style>

<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('depart')}}">Tableau de bord</a></li>        
        <li class="breadcrumb-item active" aria-current="page">Création des groupes</li>
    </ol>
</nav>

@if($id == 'new')
    <h4 class="mb-3">Nouveau groupe</h4>
@else
    <h4 class="mb-3">Edition d'un groupe</h4>
@endif

@include('include.display_msg_error')

<div class="c_ard c_ard-body w_-75">

    <p>Vous pouvez donner un nom à votre groupe et choisir une couleur de fond. 
        Si vous n'indiquez pas de nom le groupe sera juste une couleur.
    </p>

    <form action="{{ route('editerUnGroupePost') }}" method="POST">
    @csrf

        <input type="hidden" name="id" value="{{ $id }}">
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="d-flex flex-column mb-3">
            <div class="p-2">
                <label for="groupName">Nom du groupe (12 caractères maximum)</label><br>
                <input type="text" class="form-control" name="groupName" id="groupName" value="{{ $id != 'new' ? $groupes[$id]['name'] : null}}">
            </div>
            <div class="d-flex flex-row">
                <div class="p-2 me-3 align-middle">
                    <input type="color" value="{{ $id != 'new' ? $groupes[$id]['textColor'] : '#000000' }}" name="groupTextColor" id="groupTextColor" class="style2"/><br>
                    <label for="groupTextColor">Couleur du texte</label>
                </div>
                <div class="p-2">
                    <input type="color" value="{{ $id != 'new' ? $groupes[$id]['backgroundColor'] : '#ffffff' }}" name="groupBackgroundColor" id="groupBackgroundColor" class="style2"/><br>
                    <label for="groupBackgroundColor">Couleur du fond</label>
                </div>
                <div class="p-2 text-center">
                    <div class="icone-input">
                        <input class="text-center" type="text" value="{{ $id != 'new' ? $groupes[$id]['name'] : null }}" 
                        @if($id != 'new')
                            style="background: {{ $groupes[$id]['backgroundColor'] }}; color: {{ $groupes[$id]['textColor'] }}" 
                        @endif
                        class="custom-input br-40" id="apercuGroupe" readonly>
                    </div>
                    <label>Apercu de mon groupe</label>
                </div>
            </div>
        </div>

        <div class="icone-input mb-3">
            Apercu de mon groupe<br>
            <input class="text-center" type="text" value="{{ $id != 'new' ? $groupes[$id]['name'] : null }}" 
            @if($id != 'new')
                style="background: {{ $groupes[$id]['backgroundColor'] }}; color: {{ $groupes[$id]['textColor'] }}" 
            @endif
            class="custom-input br-40" id="apercuGroupe" readonly>
        </div>

        <div class="mb-5">
            <button type="submit" class="custom_button">{{ ($id == 'new') ? 'Créer le groupe' : 'Sauvegarder' }}</button>
        </div>

        <div class="mb-3">
            <a href="{{ route('groupe') }}" class="btn btn-outline-secondary btn-sm">Annuler</a>
        </div>

    </form>
    
</div>

@endsection    