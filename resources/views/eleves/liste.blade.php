@extends('layouts.mainMenu2', ['titre' => 'Ma classe', 'menu' => 'eleve'])

@section('content')

    <style>
        .avatar_form {
            width: 60px;
            height: 60px;
            border: 3px solid transparent;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer
        }

        .avatar.pink.selected {
            border-color: pink;
        }

        .avatar.blue.selected {
            border-color: lightblue;
        }
    </style>


    <div id="maclasse" data-modif={{$modif}}>



        <nav class="mt-5" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            @if (isset($modif))
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('depart') }}">Tableau de bord</a></li>
                <li class="breadcrumb-item"><a href="{{ route('maclasse') }}">Edition de la classe</a></li>
                <li class="breadcrumb-item"> <a href="{{ route('voirEleve', ['enfant_id' => $modif]) }}">Edition de l'élève</a></li>
                <li class="breadcrumb-item active" aria-current="page">Modification de l'élève</li>
            </ol>
            @else

            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('depart') }}">Tableau de bord</a></li>
                <li class="breadcrumb-item active" aria-current="page">Création de la classe</li>
            </ol>
            @endif
        </nav>
        <div class="row">
            <div class="col-md-7">
                <h4 class="text-center pt-2" style="color: var(--main-color)">Ma classe</h4>
                {{-- <button class="custom_button tab_button" data-tab="new_eleve" data-id="null">Nouvel elève</button>
            <button class="custom_button tab_button" data-tab="import_eleves" id="import_eleve" data-id="null">importer des élèves</button> --}}
                <div class="liste_eleves p-0" style="margin-top: 20px;">

                    @include('eleves.include.tableau_eleves')


                </div>
            </div>
            <div class="col-md-5 ps-5">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item w-50" role="presentation">
                        <button class="w-100 nav-link active btnSelectionType violet droit selected" id="import-tab"
                            data-bs-toggle="tab" data-bs-target="#import-tab-pane" type="button" role="tab"
                            aria-controls="import-tab-pane" aria-selected="true">La cours de l'école</button>
                    </li>
                    <li class="nav-item w-50 " role="presentation" style="height: 30px">
                        <button class="w-100 nav-link btnSelectionType violet droit" id="create-tab" data-bs-toggle="tab"
                            data-bs-target="#create-tab-pane" type="button" role="tab" aria-controls="create-tab-pane"
                            aria-selected="false">
                            <span class="create_classe">Nouvel élève</span>
                        </button>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active pt-3" id="import-tab-pane" role="tabpanel"
                        aria-labelledby="import-tab" tabindex="0">

                        <div class="d-flex flex-column">
                            <label for="">La classe du maitre ou la maitresse de l'année dernière</label>
                            <select name="" id="selectProf" class="custom-select">
                                <option value="null" selected>Tous les enfants</option>
                                @foreach ($profs as $prof)
                                    <option value="{{ $prof->id }}">{{ $prof->nom_complet() }}</option>
                                @endforeach
                            </select>
                            <div class="input-group my-3">
                                <span class="input-group-text" id="basic-addon1"><i
                                        class="fa-solid fa-magnifying-glass"></i></span>
                                <input type="text" class="form-control" id="search_eleve" placeholder="Chercher un élève"
                                    aria-label="Chercher un élève" aria-describedby="basic-addon1">
                                <span class="input-group-text" id="raz_search_eleve" style="cursor: pointer"><i
                                        class="fa-sharp fa-solid fa-xmark"></i></span>
                            </div>

                        </div>
                        <div class="import_eleves_container" id="tableau_tous">
                            @include('eleves.include.tableau_tous')
                        </div>
                    </div>
                    <div class="tab-pane fade" id="create-tab-pane" role="tabpanel" aria-labelledby="import-tab"
                        tabindex="0">

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

                        @include('eleves.include.eleve_form')




                    </div>

                </div>
            </div>

        </div>

    </div>


    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div role="alert" aria-live="assertive" aria-atomic="true" class="toast" data-bs-autohide="false"
            id="myToast">
            <div class="toast-header">

                <strong class="me-auto">Yes !</strong>

                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                L'élève a bien été créé
            </div>
        </div>
    </div>




    <!-- Modal -->
    <div class="modal fade" id="modalEleveCoursAnnee" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" style="top: 100px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Paramètres avancés de l'élève</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <small>Le prochain cahier de réussite pour cette élève est prévu fin :</small>


                    <hr>
                    <div class="form-check" style="height: 15px">
                        <input type="checkbox" class="form-check-input" id="reussite" value="true">
                        <label class="form-sh-label" for="reussite">Suspendre la création de cahier de réussite ?</label>
                    </div>
                    <div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="button" id="valideEleveCoursAnnee"data-bs-dismiss="modal"
                            class="btn btn-primary">Sauvegarder</button>
                    </div>
                </div>
            </div>
        </div>


    @endsection
