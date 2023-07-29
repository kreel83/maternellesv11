@extends('layouts.mainMenu',['titre' => 'Mes aides maternelles','menu' => 'aide'])

@section('content')

<div class="container">

    <h1>Mes aides maternelles</h1>

    <button class="btn btn-primary btn-sm" id="new_equipe" data-id="null" data-photo="{{$photo}}">Nouvelle aide maternelle</button>
    <table class="table table-bordered table-hover table-striped mt-5" id="tableau_equipes">
        <thead>
        <tr>
            <td></td>
            <td>nom</td>
            <td>prénom</td>



        </tr>
        </thead>
        <tbody>

        @foreach ($equipes as $equipe)
            <tr data-id="{{$equipe->id}}" data-photo="{{asset($equipe->photoEquipe)}}">
                <td style="width: 40px"><img src="{{asset($equipe->photoEquipe)}}" alt="" width="40px"></td>
                <td data-value="{{$equipe->name}}">{{$equipe->name}}</td>
                <td data-value="{{$equipe->prenom}}">{{$equipe->prenom}}</td>
                <td data-value="{{$equipe->fonction}}">{{$equipe->fonction}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>





    <!-- Modal -->
    <div class="modal fade" id="EquipeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('aidematernelle.post')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">




                        <!-- Tab panes -->

                                <input type="hidden" id="equipe_form" name="id" />

                                <div class="form-group">
                                    <label for="">Nom</label>
                                    <input type="text" class="form-control" id="nom_form" name="nom" value="" />
                                </div>
                                <div class="form-group">
                                    <label for="">Prénom</label>
                                    <input type="text" class="form-control" id="prenom_form" name="prenom" value="" />
                                </div>
                            <div class="form-group">
                                <label for="">Fonction</label>
                                <input type="text" class="form-control" id="fonction_form" name="fonction" value="" />
                            </div>


                                <div style="width: 300px;height: 300px; border: 1px solid blue; overflow: hidden" class="my-4 p-2">
                                <div style="position: absolute; top: 10px; right: 100px; font-size: 24px;color: red; cursor: pointer;display: none;" id="delete_photo"><i class="fas fa-times-circle"></i></div>


                                    <img src="" alt="" width="100%" id="photo_form" >
                                </div>
                                <div >
                                    <input type="file" id="photo_input" name="photo" style="display: none">

                                </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
                                <button type="submit" class="btn btn-primary">Sauvegarder</button>
                            </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
