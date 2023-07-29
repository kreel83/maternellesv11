@extends('layouts.mainMenu',['titre' => 'Mon profil', 'menu' => 'monprofil'])

@section('content')

<div class="container">

    <h1>Mon profil</h1>

    @if(!empty(session('result')))
        <div class="alert alert-success">Votre profil a été mis à jour.</div>
    @endif

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

    <form action="{{route('monprofil')}}" method="post" enctype="multipart/form-data">
    @csrf

        <div class="mb-3">
            <label for="nom" class="form-label">Votre nom</label>
            <input type="text" class="form-control" id="nom" name="nom" value="{{$user->name}}">
        </div>

        <div class="mb-3">
            <label for="prenom" class="form-label">Votre prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" value="{{$user->prenom}}">
        </div>

        <div class="mb-3">
            <label for="mobile" class="form-label">Téléphone mobile (facultatif)</label>
            <input type="text" class="form-control" id="mobile" name="mobile" aria-describedby="mobileHelp" value="{{$user->mobile}}">
            <div id="mobileHelp" class="form-text">Information confidentielle qui ne sera jamais partagée avec un tiers. Peut servir à vous contacter plus rapidement si nécessaire.</div>
        </div>

        <div class="mb-1">
            Identifiant de mon établissement : <strong>{{$user->ecole_id}}</strong>
        </div>
    
        <div class="mb-3">
            <ul>
                <li>{{ $adresseEcole }}</li>
                <li>Adresse e-mail de contact : <strong>{{$user->email}}</strong></li>
                <li>Téléphone de l'établissement : <strong>{{ $telephoneEcole }}</li>
            </ul>
        </div>

        {{--
        <div class="mb-3">
            <label for="nom_ecole" class="form-label">Nom de l'école</label>
            <input type="text" class="form-control" name="nom_ecole" aria-describedby="emailHelp" value="{{$user->nom_ecole}}">
        </div>
        <div class="mb-3">
            <label for="adresse_ecole" class="form-label">Adresse de l'école</label>
            <textarea class="form-control" name="adresse_ecole" aria-describedby="emailHelp">{{$user->adresse_ecole}}</textarea>
        </div>
        --}}

        
        <div class="mb-3">
            <label for="nom_directeur" class="form-label">Nom du directeur ou de la directrice</label>
            <input type="text" class="form-control" name="nom_directeur" aria-describedby="emailHelp" value="{{$user->nom_directeur}}">
        </div>

        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="radio" id="directeur0" name="directeur" value="0" {{$user->directeur == 0 ? 'checked' : null}}>
                <label class="form-check-label" for="directeur0">
                    Directeur
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="directeur1" name="directeur" value="1" {{$user->directeur == 1 ? 'checked' : null}}>
                <label class="form-check-label" for="directeur1">
                    Directrice
                </label>
            </div>
        </div>

        <div class="tab-pane photo_container py-3" id="profile" role="tabpanel" aria-labelledby="profile-tab" style="position: relative">
            <div style="position: absolute; top: 10px; right: 100px; font-size: 24px;color: red; cursor: pointer;display: none;" id="delete_photo"><i class="fas fa-times-circle"></i>
        </div>

        <div style="width: 300px;height: 300px; border: 3px solid lightgrey; padding: 10px; overflow: hidden">
            <img src="{{$user->photo}}" alt="" width="100%" id="photo_form" style="padding: 15px" >
        </div>

        <input type="file" id="photo_input" name="photo" style="display: none">
        <button type="submit" class="btn btn-primary mt-3">Modifier</button>
    </form>

</div>

@endsection
