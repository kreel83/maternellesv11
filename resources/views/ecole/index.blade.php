<?php

?>

@extends('layouts.mainMenu', ['titre' => 'Mon école', 'menu' => 'ecole'])




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
                    <input type="text" class="form-control" placeholder="département, code postal, commune, nom de l'école, " id="chercheDpt">
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


<!-- Modal -->
<div class="modal fade" id="confirmationEcole" tabindex="-1" aria-labelledby="confirmationEcole" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmation de l'école</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ah mais non !</button>
        <button type="button" class="btn btn-primary" id="confirmeEcole" data-id="">C'est bien mon école</button>
      </div>
    </div>
  </div>
</div>


<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div role="alert" aria-live="assertive" aria-atomic="true" class="toast" data-bs-autohide="false" id="myToast">
        <div class="toast-header">

            <strong class="me-auto">Confirmation</strong>

            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Votre établissement scolaire a bien été modifié
        </div>
    </div>
</div>

    @endsection
