@extends('layouts.admin', ['titre' => 'Bienvenue sur votre espace administration', 'menu' => 'dashboard'])

@section('content')

<h1>Bienvenue sur votre espace administrateur</h1>

@isset($saveadminprofile)
    <div class="alert alert-success" role="alert">
        Votre profil a été modifié
    </div>
@endisset

<div class="mb-3">
    <h4>Rechercher un élève</h4>

    <!-- Validation Errors -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.chercherUnEleve') }}" method="post">
    @csrf
        <div class="input-group">
            <input type="text" id="search" name="search" class="form-control">
            <button class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
        <!--
        <div class="row g-3 align-items-center">
            <div class="col-auto">
              <label for="search" class="col-form-label">Nom ou prénom de l'élève</label>
            </div>
            <div class="col-auto">
              <input type="text" id="search" name="search" class="form-control">
            </div>
            <div class="col-auto">
                <button class="btn btn-primary">Envoyer</button>
            </div>
        </div>
        -->
    </form>

    <!-- retour du résultat de recherche ens session -->
    @if(!is_null(session('result')))
        @if(!session('result')->isEmpty())
            @php
                $degrades = App\Models\Enfant::DEGRADE;
            @endphp
            <div class="mt-3" id="result">
                @foreach(session('result') as $enfant)
                    <div class="mb-2">
                        <div class="row g-2 align-items-center">
                            <div class="col-auto">
                            @if ($enfant->background)
                                <div class="m-2 degrade_card_enfant animaux" style="width:35px;height:auto;background-image: {{$degrades[$enfant->background]}}">
                                    <img src="{{asset('/img/animaux/'.$enfant->photo)}}" width="35">
                                </div>
                            @else
                                <img src="{{asset($enfant->photoEleve)}}" width="35">
                            @endif
                            </div>
                            <div class="col-auto">
                            <a href="{{ route('admin.voirEleve', ['user_id' => 0, 'id' => $enfant->id]) }}">{{ $enfant->elevePrenom.' '.$enfant->eleveNom}}</a> 
                            dans la classe de {{ $enfant->userPrenom.' '.$enfant->userNom}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            Aucun élève trouvé !
        @endif
    @endif
</div>

<div class="mb-3">
    <h4>Liste des classes de maternelles</h4>
    @if($enseignants->isEmpty())
        Aucune classe trouvée.
    @else
        <ul>
            @foreach($enseignants as $enseignant)
                <li><a href="{{ route('admin.voirClasse', ['id' => $enseignant->id]) }}">{{ $enseignant->prenom.' '.$enseignant->name }}</a></li>
            @endforeach
        </ul>
    @endif
</div>

<!-- Liste des élèves -->
@if(!empty($listeDesEleves))
    <div class="mb-3">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th class="table-primary text-center" colspan="4">Classe de {{ $prof->prenom.' '.$prof->name }}</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach($listeDesEleves as $eleve)
                <tr>
                    <td><a href="{{ route('admin.voirEleve', ['user_id' => $prof->id, 'id' => $eleve->id]) }}">{{ $eleve->prenom.' '.$eleve->nom }}</a></td>
                    <td>{{ $eleve->genre }}</td>
                    <td>{{Carbon\Carbon::parse($eleve->ddn)->format('d/m/Y')}} <small>({{ $eleve->age }})</small></td>
                    <td>{{ $eleve->groupe }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
<!-- Fin de la liste des élèves -->

@endsection
