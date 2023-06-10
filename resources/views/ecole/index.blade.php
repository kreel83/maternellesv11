<?php

?>

@extends('layouts.mainMenu', ['titre' => 'Mon école'])

@section('content')

    @if ($ecole)
        <div class="m-4 p-5 bg-primary text-white rounded">
            <h1>{{$ecole->fields->appellation_officielle}}</h1>
            <h3>{{$ecole->fields->libelle_commune}}</h3>
            <p>Académie de {{$ecole->fields->libelle_academie}}</p>
        </div>
    @endif
    <div class="row">
        <div class="col-md-6">
            <h3>Choisir / Modifier mon établissement scolaire</h3>
            <div class="card">
                <div class="card-body">
                    <input type="text" class="form-control" placeholder="entrer un département" id="chercheDpt">
                    <input type="text" class="form-control mt-2" placeholder="entrer une ville" id="chercheVille">
                    <button class="btn btn-outline-primary mt-5" id="chercheCommuneBtn">Chercher</button>

                </div>

            </div>

            <table class="table table-bordered table-hover table-striped table-success" style="cursor: pointer">
                <thead>
                <tr>
                    <td>Liste des communes</td>
                </tr>
                </thead>
                <tbody id="communeContainer">

                </tbody>

            </table>
        </div>
        <div class="col-md-6" id="listeEcoles">

        </div>
    </div>



    <div role="alert" aria-live="assertive" aria-atomic="true" class="toast" data-bs-autohide="false" id="myToast">
        <div class="toast-header">

            <strong class="me-auto">Confirmation</strong>

            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Votre étableissement scolaire a bien été modifié
        </div>
    </div>

    @endsection
