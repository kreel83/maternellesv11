@extends('layouts.mainMenu',['titre' => 'Ma classe'])

@section('content')

<div class="row">
    <div class="col-md-6">
        <h4>Ma classe</h4>
        <button class="btn btn-primary btn-sm" id="new_eleve" data-id="null">Nouvel elève</button>
        <div style="height: 600px; overflow-y: auto">
            <table class="table table-bordered table-hover table-striped mt-5" id="tableau_eleves">
            @include('eleves.include.tableau_eleves')
            </table>
        
        </div>
    </div>

    <div class="col-md-1" style="padding-top: 300px">
        <button class="btn btn-sm btn-primary w-100" id="ajouterEleves" ><i class="fa-light fa-left me-2"></i>ajouter</button>
    </div>

    <div class="col-md-5">
    <h4>Les elèves de mon école</h4>
    <div class="d-flex">
        <select name="" id="selectProf" class="form-control input-sm" style="font-size: 12px">
        <option value="null" selected>Tous les enfants</option>
            @foreach ($profs as $prof)
            <option value="{{$prof->id}}">{{$prof->nom_complet()}}</option>
            @endforeach
        </select>
    </div>
    <div style="height: 600px; overflow-y: auto">
            <table class="table table-bordered table-hover table-striped mt-5" id="allSelectEleve">
                @include('eleves.include.tableau_tous')
            </table>
        </div>
    </div>    
</div>







    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('save_eleve')}}" method="post" enctype="multipart/form-data">
                    @csrf
                <div class="modal-body">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Etat civil</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Photo</button>
                        </li>
                    </ul>


                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
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
                        </div>
                        <div class="tab-pane photo_container" id="profile" role="tabpanel" aria-labelledby="profile-tab" style="position: relative">
                            <div style="position: absolute; top: 10px; right: 100px; font-size: 24px;color: red; cursor: pointer;display: none;" id="delete_photo"><i class="fas fa-times-circle"></i></div>
                            <div style="width: 300px;height: 300px; border: 1px solid blue">


                                <img src="" alt="" width="100%" id="photo_form" >
                            </div>
                        <div>
                            <input type="file" id="photo_input" name="photo" style="display: none">

                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Sauvegarder</button>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection
