@extends('layouts.admin', ['titre' => 'Bienvenue sur votre espace administration', 'menu' => 'dashboard'])

@section('content')

<h1>Bienvenue sur votre espace administrateur</h1>

{{-- Gestion des succès / erreurs --}}
@if(session()->has('success'))
    @if(session('success'))
        <div class="alert alert-success" role="alert"><i class="fa-solid fa-circle-check me-1"></i> {{ session('msg') }}</div>
    @else
        <div class="alert alert-danger" role="alert"><i class="fa-solid fa-circle-exclamation me-1"></i> {{ session('msg') }}</div>
    @endif
@endif

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

    <!-- retour du résultat de recherche en session -->
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
                            {{-- <a href="{{ route('admin.voirEleve', ['user_id' => 0, 'id' => $enfant->id, 'source' => 'search']) }}">{{ $enfant->elevePrenom.' '.$enfant->eleveNom}}</a>  --}}
                            <a href="{{ route('admin.voirEleve', ['enfant_id' => $enfant->id, 'source' => 'search']) }}">{{ $enfant->elevePrenom.' '.$enfant->eleveNom}}</a>
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
                <li><a href="{{ route('admin.voirClasse', ['user_id' => $enseignant->id]) }}">{{ $enseignant->prenom.' '.$enseignant->name }}</a></li>
            @endforeach
        </ul>
    @endif
</div>

<!-- Liste des élèves -->
@if(!empty($listeDesEleves))
    @php
    $degrades = App\Models\Enfant::DEGRADE;
    $lesgroupes = json_decode($prof->groupes, true);
    $takeFirst = round($listeDesEleves->count() / 2);
    @endphp
    <div class="div7 cadre_welcome mt-4">
        <h4>Classe de {{ $prof->prenom.' '.$prof->name }}</h4>
        <div class="row">
            <div class="col-md-6">

                <table class="table table-sm classe_dashboard">
                <tbody>
                    @foreach($listeDesEleves->take($takeFirst) as $eleve)
                    @php
                        $groupe = null;
                        if (!is_null($eleve->groupe)){
                        
                        $groupe = $lesgroupes[$eleve->groupe];
                        }
                    @endphp 
                    <tr>
                        <td>
                            <div class="m-2 degrade_card_enfant animaux"  style="background-image: {{$degrades[$eleve->background] ?? $degrades['b1']}}; width: 27px; height: 27px" data-degrade="{{$eleve->background}}"  data-animaux="{{$eleve->photo}}">
                                <img src="{{asset('/img/animaux/'.$eleve->photo)}}" alt="" width="30">    
                            </div>
                        </td>
                        <td class="name {{$eleve->genre}}">
                            <div>
                                <a href="{{ route('admin.voirEleve', ['enfant_id' => $eleve->id]) }}">
                                {{ $eleve->prenom.' '.$eleve->nom }}
                                </a>

                            </div>
                            <div style="color: lightgrey;">
                                {{Carbon\Carbon::parse($eleve->ddn)->format('d/m/Y')}} <small>({{ $eleve->age }})</small>
                            </div>
                        </td>

                        <td>
                            @if (!$eleve->mail)
                            <div class="dashboard_mail">

                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            @endif

                        </td>
                        <td>
                            <div class="groupe-terme {{isset($groupe) ? null : 'd-none'}}"  style="background-color: {{ $groupe["backgroundColor"] ?? '' }}; color:{{ $groupe["textColor"] ?? ''}}">{{$groupe["name"] ?? ''}}</div>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>

            </div>

            <div class="col-md-6">
            <table class="table table-sm classe_dashboard">
            <tbody>
                @foreach($listeDesEleves->skip($takeFirst) as $eleve)
                @php
                $groupe = null;
                if (!is_null($eleve->groupe)){
                
                $groupe = $lesgroupes[$eleve->groupe];
                }
            @endphp 
            <tr class="">
                <td>
                    <div class="m-2 degrade_card_enfant animaux"  style="background-image: {{$degrades[$eleve->background]}}; width: 27px; height: 27px" data-degrade="{{$eleve->background}}"  data-animaux="{{$eleve->photo}}">
                        <img src="{{asset('/img/animaux/'.$eleve->photo)}}" alt="" width="30">    
                    </div>
                </td>
                <td class="name {{$eleve->genre}}">
                    <div>
                        <a href="{{ route('admin.voirEleve', ['enfant_id' => $eleve->id]) }}">
                        {{ $eleve->prenom.' '.$eleve->nom }}
                        </a>

                    </div>
                    <div style="color: lightgrey;">
                        {{Carbon\Carbon::parse($eleve->ddn)->format('d/m/Y')}} <small>({{ $eleve->age }})</small>
                    </div>
                </td>

                <td>
                    @if (!$eleve->mail)
                    <div class="dashboard_mail">

                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    @endif

                </td>
                <td>
                    <div class="groupe-terme {{isset($groupe) ? null : 'd-none'}}"  style="background-color: {{ $groupe["backgroundColor"] ?? '' }}; color:{{ $groupe["textColor"] ?? ''}}">{{$groupe["name"] ?? ''}}</div>

                </td>
            </tr>
                @endforeach
            </tbody>
            </table>
            </div>
        </div>

    </div>
@endif

<!-- Liste des élèves -->
{{-- @if(!empty($listeDesEleves))
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
                    <td><a href="{{ route('admin.voirEleve', ['enfant_id' => $eleve->id]) }}">{{ $eleve->prenom.' '.$eleve->nom }}</a></td>
                    <td>{{ $eleve->genre }}</td>
                    <td>{{Carbon\Carbon::parse($eleve->ddn)->format('d/m/Y')}} <small>({{ $eleve->age }})</small></td>
                    <td>{{ $eleve->groupe }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif --}}
<!-- Fin de la liste des élèves -->

@endsection
