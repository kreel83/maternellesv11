<?php

?>

@extends('layouts.mainMenu', ,['titre' => 'Mon école'])

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
                    <input type="text" class="form-control" placeholder="entrer une commune" id="chercheCommune">
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
        <div class="col-md-6">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Ecoles maternelles</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Ecoles primaires</button>
                </li>

            </ul>
            <div class="tab-content" id="ecoleContainer"></div>
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
