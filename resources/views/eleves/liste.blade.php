@extends('layouts.mainMenu2',['titre' => 'Ma classe', 'menu' => 'eleve'])

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



    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">

        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('depart')}}">Tableau de bord</a></li>        
            <li class="breadcrumb-item active" aria-current="page">Création de la classe</li>
          </ol>
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
                <button class="w-100 nav-link active btnSelectionType violet droit selected" id="import-tab" data-bs-toggle="tab" data-bs-target="#import-tab-pane" type="button" role="tab" aria-controls="import-tab-pane" aria-selected="true">La cours de l'école</button>
                </li>
                <li class="nav-item w-50 " role="presentation" style="height: 30px">
                <button class="w-100 nav-link btnSelectionType violet droit" id="create-tab" data-bs-toggle="tab" data-bs-target="#create-tab-pane" type="button" role="tab" aria-controls="create-tab-pane" aria-selected="false">
                    <span class="create_classe">Nouvel élève</span>
                </button>
                </li>

            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active pt-3" id="import-tab-pane" role="tabpanel" aria-labelledby="import-tab" tabindex="0">

                    <div class="d-flex flex-column">
                        <label for="">La classe du maitre ou la maitresse de l'année dernière</label>
                        <select name="" id="selectProf" class="custom-select">
                            <option value="null" selected>Tous les enfants</option>
                            @foreach ($profs as $prof)
                            <option value="{{$prof->id}}">{{$prof->nom_complet()}}</option>
                            @endforeach
                        </select>
                        <div class="input-group my-3">
                            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
                            <input type="text" class="form-control" id="search_eleve" placeholder="Chercher un élève" aria-label="Chercher un élève" aria-describedby="basic-addon1">
                            <span class="input-group-text" id="raz_search_eleve" style="cursor: pointer"><i class="fa-sharp fa-solid fa-xmark"></i></span>
                          </div>
                        
                    </div>
                    <div class="import_eleves_container"   id="tableau_tous">
                        @include('eleves.include.tableau_tous')                            
                    </div>
                </div>
                <div class="tab-pane fade" id="create-tab-pane" role="tabpanel" aria-labelledby="import-tab" tabindex="0">

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

                    <form action="{{route('save_eleve')}}" method="post" id="elevePost" style="font-size: 12px; padding: 10px;" class="affiche_eleve">
                        @csrf
            
            
            
                                <input type="hidden" id="eleve_form" name="id" value="new" />
                                <input type="hidden" id="genre" name="genre" value="F" />
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-column">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="psmsgs" id="ps" value="ps" >
                                            <label class="form-check-label" for="ps">
                                              PS
                                            </label>
                                          </div>
                                          <div class="form-check">
                                            <input class="form-check-input" type="radio" name="psmsgs" id="ms" checked  value="ms">
                                            <label class="form-check-label" for="ms">
                                              MS
                                            </label>
                                          </div>
                                          <div class="form-check">
                                            <input class="form-check-input" type="radio" name="psmsgs" id="gs"  value="gs">
                                            <label class="form-check-label" for="gs">
                                              GS
                                            </label>
                                          </div>

                                    </div>
                                    <div class="d-flex">
                                        <div class="avatar avatar_form pink me-5 selected" data-genre="F"><i class="fa-thin fa-user-tie-hair-long"></i></div>
                                        <div class="avatar avatar_form blue" data-genre="G"><i class="fa-thin fa-user-tie-hair"></i></div>

                                    </div>
                                    <div class="d-flex flex-column ms-3 mt-2" >
                                        <div class="form-check " style="height: 15px">
                                            <input type="checkbox" name="sh" class="form-check-input" id="sh" value="true">
                                            <label class="form-sh-label" for="sh">Situation de handicap ?</label>
                                        </div>
                                        <div class="form-check"  style="height: 15px">
                                            <input type="checkbox" name="reussite" class="form-check-input" id="reussite" checked value="true">
                                            <label class="form-sh-label" for="reussite">Cahier de réussite</label>
                                        </div>                                        
                                    </div>


                                </div>
                                {{-- <div class="form-group">
                                    <label for="">Genre</label>
                                    <select id="genre_form"  name="genre" class="form-control">
                                        <option value="G">Garcon</option>
                                        <option value="F">Fille</option>
                                    </select>
                                </div> --}}

                                    <div class="icone-input my-4">
                                        <i class="fa-solid fa-user"></i>
                                        <input type="text" class="custom-input" id="nom_form" name="nom" value="" placeholder="Nom de l'élève" />
                                    </div>    
                                    <div class="icone-input my-4">
                                        <i class="fa-solid fa-user"></i>
                                        <input type="text" class="custom-input" id="prenom_form" name="prenom" value="" placeholder="Prénom de l'élève" />
                                    </div>    
                                    <div class="icone-input my-4">
                                        <i class="fa-solid fa-cake-candles"></i>
                                        <input type="date" class="custom-input" id="ddn_form" name="ddn" value="" placeholder="Date de naissance de l'élève" />
                                    </div>    
                                    <div class="custom-area">                                       
                                        <textarea type="date" class="custom-input" id="commentaire_form" name="comment" placeholder="Commentaire"></textarea>
                                    </div>

                                <div class="icone-input my-4">
                                    <i class="fa-sharp fa-solid fa-envelope"></i>
                                    <input type="email" class="custom-input" id="mail1_form" name="mail1" value="" placeholder="Mail principal" />
                                </div>    
                                <div class="icone-input my-4">
                                    <i class="fa-sharp fa-solid fa-envelope"></i>
                                    <input type="email" class="custom-input" id="mail2_form" name="mail2" value="" placeholder="Mail secondaire" />
                                </div>    
  

                        
            
            
            
                
                                <div class="d-flex">
                                    <button type="button" class="custom_button big submit save_eleve">Sauvegarder</button>
                        
                                    <button type="button" data-id="new" class="custom_button submit remove_eleve delete ms-1">Retirer</button>                                    
                                </div>

                        
                
                    </form>

        
                </div>

            </div>
        </div>
 
</div>


<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div role="alert" aria-live="assertive" aria-atomic="true" class="toast" data-bs-autohide="false" id="myToast">
        <div class="toast-header">

            <strong class="me-auto">Yes !</strong>

            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            L'élève a bien été créé
        </div>
    </div>
</div>







@endsection
