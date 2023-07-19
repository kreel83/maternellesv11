@extends('layouts.admin', ['titre' => 'Bienvenue sur votre espace administration', 'menu' => 'monprofil'])

@section('content')

<h1>Mon profil</h1>

    <form action="{{route('admin.saveprofile')}}" method="post">
    @csrf

        <div class="mb-3">
            <label for="nom" class="form-label">Votre nom</label>
            <input type="text" class="form-control" name="nom" aria-describedby="emailHelp" value="{{$user->name}}">

        </div>
        <div class="mb-3">
            <label for="prenom" class="form-label">Votre prénom</label>
            <input type="text" class="form-control" name="prenom" aria-describedby="emailHelp" value="{{$user->prenom}}">
        </div>
        <div class="mb-3">
            <p>Identifiant de l'établissement</p>
            <p><strong>{{$user->ecole_id}}</strong></p>
        </div>
        <div class="mb-3">
            {{$ecole->nom_etablissement}}<br>
            @if ($ecole->adresse_1 != '')
                {{$ecole->adresse_1}}<br>
            @endif
            @if ($ecole->adresse_2 != '')
                {{$ecole->adresse_2}}<br>
            @endif
            @if($ecole->adresse_3 != '')
                {{$ecole->adresse_3}}
            @endif
        </div>
        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="directeur"  value="0" {{$user->directeur == 0 ? 'checked' : null}}>
                <label class="form-check-label" for="flexRadioDefault1">
                    Directeur
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="directeur" value="1" {{$user->directeur == 1 ? 'checked' : null}}>
                <label class="form-check-label" for="flexRadioDefault2">
                    Directrice
                </label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Enregistrer les modifications</button>

    </form>

    <div class="mt-4">
        <a href="{{ route('admin.index') }}">Annuler</a>
    </div>

@endsection
