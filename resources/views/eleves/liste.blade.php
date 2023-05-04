@extends('layouts.mainMenu',['titre' => 'Ma classe'])

@section('content')
    <button class="btn btn-primary btn-sm" id="new_eleve" data-id="null">Nouvel elève</button>
    <table class="table table-bordered table-hover table-striped mt-5" id="tableau_eleves">
        <thead>
        <tr>
            <td></td>
            <td>nom</td>
            <td>prénom</td>
            <td>age</td>
            <td>genre</td>
            <td>groupe</td>
            <td>mail</td>


        </tr>
        </thead>
        <tbody>

            @foreach ($eleves as $eleve)
                <tr data-id="{{$eleve->id}}" data-commentaire="{{$eleve->comment}}" data-photo="{{asset($eleve->photoEleve)}}">
                    <td style="width: 40px"><img src="{{asset($eleve->photoEleve)}}" alt="" width="40px"></td>
                    <td data-value="{{$eleve->nom}}">{{$eleve->nom}}</td>
                    <td data-value="{{$eleve->prenom}}">{{$eleve->prenom}}</td>
                    <td data-value="{{$eleve->ddn}}">{{Carbon\Carbon::parse($eleve->ddn)->format('d/m/Y')}}</td>
                    <td data-value="{{$eleve->genre}}">{{ $eleve->genre }}</td>
                    <td data-value="{{$eleve->groupe}}">{{$eleve->groupe}}</td>
                    <td data-value1="{{$eleve->mail1}}" data-value2="{{$eleve->mail2}}">

                            <div>{{$eleve->mail1}}</div>
                            <div>{{$eleve->mail2}}</div>

                    </td>


                </tr>
            @endforeach
        </tbody>
    </table>





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
