@extends('layouts.parentLayout', ['titre' => 'Bienvenue', 'menu' => 'accueil'])

@section('content')

<p>Bienvenue dans la section de téléchargement du cahier de résussite de votre enfant.</p>

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

<p>Veuillez indiquer sa date de naissance au format JJ/MM/YYYY :</p>

<form class="row row-cols-lg-auto g-3 align-items-center" action="{{ route('cahier.predownload.post') }}" method="POST">
@csrf
<input type="hidden" name="token" value="{{ $token }}">
<input type="hidden" name="id" value="{{ $id }}">

  <div class="col-12">
    <div class="input-group">
      <input type="text" class="form-control" id="jour" name="jour" placeholder="Jour" value="{{ old('jour') }}" required autofocus>
    </div>
  </div>

  <div class="col-12">
    <div class="input-group">
        <input type="text" class="form-control" id="mois" name="mois" placeholder="Mois" value="{{ old('mois') }}" required>
    </div>
  </div>

  <div class="col-12">
    <div class="input-group">
        <input type="text" class="form-control" id="annee" name="annee" placeholder="Année" value="{{ old('annee') }}" required>
    </div>
  </div>

  <div class="col-12">
    <button type="submit" class="btn btn-primary">C'est parti !</button>
  </div>

</form>

@if (session('success'))
    <div class="alert alert-success">
      <p><a href="{{ route('cahier.download', ['id' => $id]) }}">Télécharger le cahier de progrès</a></p>
    </div>
@endif

@endsection