@extends('layouts.mainMenu',['titre' => 'Ma classe', 'menu' => 'eleve'])

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h4>Ma classe</h4>
            {{-- <button class="custom_button tab_button" data-tab="new_eleve" data-id="null">Nouvel elève</button>
            <button class="custom_button tab_button" data-tab="import_eleves" id="import_eleve" data-id="null">importer des élèves</button> --}}
            <div class="liste_eleves" style="margin-top: 20px;">

                @include('eleves.include.tableau_eleves')
                
            
            </div>
        </div>
        <div class="col-md-4">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                <button class="nav-link active" id="create-tab" data-bs-toggle="tab" data-bs-target="#create-tab-pane" type="button" role="tab" aria-controls="create-tab-pane" aria-selected="true">Nouvel elève</button>
                </li>
                <li class="nav-item" role="presentation">
                <button class="nav-link" id="import-tab" data-bs-toggle="tab" data-bs-target="#import-tab-pane" type="button" role="tab" aria-controls="import-tab-pane" aria-selected="false">La cours de l'école</button>
                </li>

            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active pt-3" id="create-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

                    <div class="d-flex flex-column">
                        <label for="">La classe du maitre ou la maitresse de l'année dernière</label>
                        <select name="" id="selectProf" class="form-control" style="font-size: 12px">
                            <option value="null" selected>Tous les enfants</option>
                            @foreach ($profs as $prof)
                            <option value="{{$prof->id}}">{{$prof->nom_complet()}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="import_eleves_container"   id="tableau_tous">
                        @include('eleves.include.tableau_tous')
                            
                    </div>

                </div>
                <div class="tab-pane fade pt-3" id="import-tab-pane" role="tabpanel" aria-labelledby="import-tab" tabindex="0">
                    <form action="{{route('save_eleve')}}" method="post" enctype="multipart/form-data" style="font-size: 12px; padding-top: 60px;">
                        @csrf
            
            
            
                                <input type="hidden" id="eleve_form" name="id" />
                                <div class="form-group">
                                    <label for="">Genre</label>
                                    <select id="genre_form"  name="genre" class="form-control">
                                        <option value="G">Garcon</option>
                                        <option value="F">Fille</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Nom</label>
                                    <input type="text" class="form-control" id="nom_form" name="nom" value="" />
                                </div>
                                <div class="form-group">
                                    <label for="">Prénom</label>
                                    <input type="text" class="form-control" id="prenom_form" name="prenom" value="" />
                                </div>
                                <div class="form-group">
                                    <label for="">Date de naissance</label>
                                    <input type="date" class="form-control" id="ddn_form" name="ddn" value="" />
                                </div>
                                <div class="form-group">
                                    <label for="">Commentaire</label>
                                    <textarea type="date" class="form-control" id="commentaire_form" name="comment"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">groupe</label>
                                    <select id="groupe_form" name="groupe" class="form-control">
                                        <option value="A">Groupe A</option>
                                        <option value="B">Groupe B</option>
                                        <option value="C">Groupe C</option>
                                        <option value="null">Non dféfini</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">mail principal</label>
                                    <input type="email" class="form-control" id="mail1_form" name="mail[]" value="" />
                                </div>
                                <div class="form-group">
                                    <label for="">mail secondaire</label>
                                    <input type="email" class="form-control" id="mail2_form" name="mail[]" value="" />
                                </div>
                        
            
            
            
                
                
                        <button type="submit" class="custom_button mt-3">Sauvegarder</button>
            
                        <button type="button" data-id="new" class="custom_button delete mt-3 d-none">Retirer</button>
                        
                
                    </form>

        
                </div>

            </div>
        </div>


    

        
    </div>    
</div>










@endsection
