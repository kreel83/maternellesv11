@extends('layouts.mainMenu',['titre' => 'Ma classe', 'menu' => 'eleve'])

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


<div class="container">
    <div class="row">
        <div class="col-md-7">
            <h4>Ma classe</h4>
            {{-- <button class="custom_button tab_button" data-tab="new_eleve" data-id="null">Nouvel elève</button>
            <button class="custom_button tab_button" data-tab="import_eleves" id="import_eleve" data-id="null">importer des élèves</button> --}}
            <div class="liste_eleves ps-4" style="margin-top: 20px;">

                @include('eleves.include.tableau_eleves')
                
            
            </div>
        </div>
        <div class="col-md-4">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item w-50" role="presentation">
                <button class="w-100 nav-link active btnSelectionType violet droit selected" id="import-tab" data-bs-toggle="tab" data-bs-target="#import-tab-pane" type="button" role="tab" aria-controls="import-tab-pane" aria-selected="true">La cours de l'école</button>
                </li>
                <li class="nav-item w-50" role="presentation">
                <button class="w-100 nav-link btnSelectionType violet droit" id="create-tab" data-bs-toggle="tab" data-bs-target="#create-tab-pane" type="button" role="tab" aria-controls="create-tab-pane" aria-selected="false">Nouvel élève</button>
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
                    <form action="{{route('save_eleve')}}" method="post" enctype="multipart/form-data" style="font-size: 12px; padding-top: 10px;">
                        @csrf
            
            
            
                                <input type="hidden" id="eleve_form" name="id" value="new" />
                                <input type="hidden" id="genre" name="genre" value="F" />
                                <div class="d-flex justify-content-center">
                                    <div class="avatar avatar_form pink me-5 selected" data-genre="F"><i class="fa-thin fa-user-tie-hair-long"></i></div>
                                    <div class="avatar avatar_form blue" data-genre="G"><i class="fa-thin fa-user-tie-hair"></i></div>
                                    <div class="d-flex flex-column ms-3 mt-2" >
                                        <div class="form-check " style="height: 15px">
                                            <input type="checkbox" name="sh" class="form-check-input" id="sh">
                                            <label class="form-sh-label" for="sh">Situation de handicap ?</label>
                                        </div>
                                        <div class="form-check"  style="height: 15px">
                                            <input type="checkbox" name="reussite" class="form-check-input" id="reussite" checked>
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
                                    <input type="email" class="custom-input" id="mail1_form" name="mail[]" value="" placeholder="Mail principal" />
                                </div>    
                                <div class="icone-input my-4">
                                    <i class="fa-sharp fa-solid fa-envelope"></i>
                                    <input type="email" class="custom-input" id="mail2_form" name="mail[]" value="" placeholder="Mail secondaire" />
                                </div>    

                        
            
            
            
                
                                <div class="d-flex">
                                    <button type="submit" class="custom_button big submit">Sauvegarder</button>
                        
                                    <button type="button" data-id="new" class="custom_button submit remove_eleve delete ms-1">Retirer</button>                                    
                                </div>

                        
                
                    </form>

        
                </div>

            </div>
        </div>


    

        
    </div>    
</div>










@endsection
