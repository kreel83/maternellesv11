@extends('layouts.admin', ['titre' => 'Gestion des licences', 'menu' => 'licence'])

@section('content')

<div class="row">
    <div class="col">
    <h1>Gestion des licences</h1>
    </div>
</div>

<h4>Assignation de la licence n° {{ $licence->name }}</h4>

<div class="row mt-3">

    <div class="col-md-12">

        <div id="result"></div>

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

        <div class="alert alert-info">
            <div class="mb-3">
                <i class="fa-solid fa-circle-info me-1"></i> Si l'enseignant(e) ne possède pas de compte dans l'application, celui-ci sera automatiquement crée et un courrier électronique lui sera envoyé pour l'informer de l'attribution d'une licence.<br>
            </div>
            <div>
                <i class="fa-solid fa-circle-info me-1"></i> Si l'enseignant(e) à déjà un compte dans l'application, un courrier électronique lui sera envoyé pour l'informer de l'attribution d'une licence.
            </div>
        </div>

        <form action="{{ route('admin.licence.assign.step1Post') }}" method="post">
        @csrf

            <input type="hidden" name="licence_name" value="{{ $licence->name }}">

            <div class="mb-4">
                <label for="email" class="form-label">Veuillez indiquer l'adresse e-mail professionnelle de l'enseignant(e) :</label>
                <div class="input-group">
                    <div class="input-group-text">@</div>
                    <input type="email" name="email" class="form-control" id="email" required autofocus>
                </div>
            </div>

            <div class="justify-content-start">
                <a class="btn btn-outline-secondary me-2" href="{{ route('admin.licence.index') }}" role="button">Annuler</a>
                <button type="submit" class="btn btn-primary">Assigner la licence</button>
            </div>

        </form>

    </div>
    
</div>

@endsection
