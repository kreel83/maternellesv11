@extends('layouts.mainMenu2', ['titre' => 'Mes aides maternelles', 'menu' => 'aide'])

@
@section('content')
    <div class="" id="aides">

        <div class="addAide" id="new_equipe" data-id="null" data-photo="{{ $photo }}">
            <i class="fa-solid fa-plus"></i>
        </div>
        <div class="row g-0">
            <div class="col-md-6">
                <h1>Mes aides maternelles</h1>
                <div class="d-flex container flex-wrap">
                    @foreach ($equipes as $equipe)
                        <div class="card_aides" data-donnees="{{ json_encode($equipe) }}"
                            data-photo="{{ asset($equipe->photoEquipe) }}">
                            <div class="left w-50">
                                <div class="img_aides_div"><img src="{{ asset($equipe->photoEquipe) }}" alt="">
                                </div>
                            </div>
                            <div class="right w-50">
                                <div class="prenom">{{ $equipe->prenom }}</div>
                                <div class="nom">{{ $equipe->name }}</div>
                                <div class="fonction">{{ App\Models\Equipe::FONCTIONS[$equipe->fonction] }}</div>
                            </div>
                            <div class="controle border-0">
                                <div class="modif"><i class="fa-solid fa-pen-to-square"></i></div>
                                <button class="delete" data-bs-toggle="modal" data-bs-target="#confirmationModal"><i
                                        class="fa-solid fa-trash"></i></button>

                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
            <div class="col-md-6 vh-100 d-none aideLeft p-5 justify-content-center align-items-center" style="background-color: #7769FE">

                <div id="titreAide">Nouvelle aide</div>
                <form action="{{ route('aidematernelle.post') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex flex-column">

                        <!-- Tab panes -->

                        <input type="hidden" id="equipe_form" name="id" />

                        <div>
                            <div class="icone-input my-4">
                                <i class="fa-solid fa-user"></i>
                                <input type="text" class="custom-input" id="nom_form" name="nom" value=""
                                    placeholder="Nom de l'aide matenelle" />
                            </div>
                            <div class="icone-input my-4">
                                <i class="fa-solid fa-user"></i>
                                <input type="text" class="custom-input" id="prenom_form" name="prenom" value=""
                                    placeholder="Prénom de l'aide matenelle" />
                            </div>


                            <div class="form-group">
                                <label for="">Fonction</label>
                                <select class="custom-select" id="fonction_form" name="fonction">
                                    @foreach (App\Models\Equipe::FONCTIONS as $key => $fonction)
                                        <option value="{{ $key }}">{{ $fonction }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>



                        
                            <div class="position-relative d-flex justify-content-between align-items-center mb-5">
                                <div style="display: flex; justify-content: center;align-items: center;border-radius: 50%; width: 30px; height: 30px;position: absolute; top: 30px; right: 8px; font-size: 20px;color: black; background-color: white; cursor: pointer"
                                    id="delete_photo"><i class="fa-solid fa-times"></i></div>

                                <label for="">Une photo ?<br> c'est pas obligatoire</label>
                                <img src="" alt="" width="100%" id="photo_form">
                            </div>
                          
                                <input type="file" id="photo_input" name="photo" style="display: none">

                      
                        

                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger">Fermer</button>
                        <button type="submit" class="btn btnSelection vert">Sauvegarder</button>
                    </div>
                </form>

            </div>
        </div>



        <!-- Modal -->
        <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmation</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Voulez-vous vraiment supprimer cette aide maternelle ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="button" class="btn btn-primary delete_aide">Je confirme</button>
                    </div>
                </div>
            </div>
        </div>
    @endsection
