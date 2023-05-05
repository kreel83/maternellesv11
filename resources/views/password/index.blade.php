@extends('layouts.mainMenu',['titre' => 'Les mots de passe'])

@section('content')
    <h2>Gestion des mots de passe</h2>

    <form action="{{route('password_operation')}}" method="post">
        @csrf
        @foreach($enfants as $key=>$enfant)
            <div class="form-check">
                <input class="form-check-input" name="enfants[]" type="checkbox" value="{{$enfant->id}}" id="enfant{{$key}}" checked>
                <label class="form-check-label" for="enfant{{$key}}">
                    {{ $enfant->prenom }} {{$enfant->nom}}
                </label>
            </div>
        @endforeach
        <button class="btn btn-primary" type="submit" name="submit" value="password">Générer les mots de passe</button>
        <button class="btn btn-primary" type="submit" name="submit" value="pdf">Générer le PDF</button>


    </form>


@endsection
