@extends('layouts.mainMenu')

@section('content')
    <h1>Mon profil</h1>

    <form action="{{route('monprofil')}}" method="post" enctype="multipart/form-data">
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
            <label for="nom_ecole" class="form-label">Nom de l'école</label>
            <input type="text" class="form-control" name="nom_ecole" aria-describedby="emailHelp" value="{{$user->nom_ecole}}">
        </div>
        <div class="mb-3">
            <label for="adresse_ecole" class="form-label">Adresse de l'école</label>
            <textarea class="form-control" name="adresse_ecole" aria-describedby="emailHelp">{{$user->adresse_ecole}}</textarea>
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
        <div class="mb-3">
            <label for="nom_directeur" class="form-label">Nom du directeur ou de la directrice</label>
            <input type="text" class="form-control" name="nom_directeur" aria-describedby="emailHelp" value="{{$user->nom_directeur}}">
        </div>
        <div class="tab-pane photo_container py-3" id="profile" role="tabpanel" aria-labelledby="profile-tab" style="position: relative">
            <div style="position: absolute; top: 10px; right: 100px; font-size: 24px;color: red; cursor: pointer;display: none;" id="delete_photo"><i class="fas fa-times-circle"></i></div>
            <div style="width: 300px;height: 300px; border: 3px solid lightgrey; padding: 10px; overflow: hidden">
                <img src="{{$user->photo}}" alt="" width="100%" id="photo_form" style="padding: 15px" >
            </div>

                <input type="file" id="photo_input" name="photo" style="display: none">
        <button type="submit" class="btn btn-primary mt-3">Modifier</button>
    </form>
@endsection
