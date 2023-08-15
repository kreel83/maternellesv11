@extends('layouts.mainMenu',['titre' => 'Mon profil', 'menu' => 'monprofil'])

@section('content')

<div class="container">



    @if(!empty(session('result')))
        <div class="alert alert-success">Votre profil a été mis à jour.</div>
    @endif

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

    <style>
        .grid_profil {
            display: grid;
            grid-template-columns:1fr 1fr; 
            grid-template-rows: 370px 220px 220px;
            grid-gap: 20px; 
        }
        .grid1 {
            grid-column: 1;
            grid-row: 1
        }
        .grid2 {
            grid-column: 2;
            grid-row: 1
        }
        .grid3 {
            grid-column: 1/3;
            grid-row: 2

        }
        .grid4 {
            grid-column: 1/3;
            grid-row: 3
        }
        .gridcadre {
            width: 100%;
            border: 1px solid grey;
            border-radius: 40px;
            position: relative;
            padding: 10px 40px;
        }
        .gridTitre {
            position: absolute;
            top: -16px;
            left: 30px;
            font-weight: bold;
            font-size: 16px;
            padding: 4px 16px;
            background-color: #F4F9FF;

        }
        .groupeAide {
            position: relative;
           
            padding: 5px;
            margin: 5px;
        }

    </style>


    <div class="grid_profil">
        <div class="gridcadre grid1">
            <div class="gridTitre">Mon profil</div>
            <form action="{{route('monprofil')}}" method="post" enctype="multipart/form-data">
                {{-- <div class="icone-input-login my-4">
                    <i class="fa-solid fa-key"></i>
                    <input type="email" class="custom-input" name="email" value="" placeholder="Votre adresse mail" />
                </div>  --}}
                <div class="icone-input my-4 little">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" class="custom-input" name="prenom" value="{{$user->prenom}}" placeholder="Prénom" />
                </div> 
                <div class="icone-input my-4 little">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" class="custom-input" name="name" value="{{$user->name}}" placeholder="Nom" />
                </div>
                <div class="icone-input my-4 little">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="text" class="custom-input" name="email" value="{{$user->email}}" placeholder="Nom" disabled/>
                </div>
                <div class="icone-input my-4 little">
                    <i class="fa-solid fa-phone"></i>
                    <input type="text" class="custom-input" name="mobile" value="{{$user->mobile}}" placeholder="Téléphone" />
                                    </div>

                <button type="submit" class="btnAction">Sauvegarder</button>
            </form>
        </div>
        <div class="gridcadre grid2">
            <div class="gridTitre">Mon établissement</div>
            <div class="mt-4 text-center">
                <h3><span class="badge bg-secondary">{{$user->ecole_id}}</span></h3>
                <div class="custom-area">
                    <textarea name="" id="" cols="30" rows="10" disabled>{{ $adresseEcole }}</textarea>            
                </div>
                <div class="icone-input my-4 little">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="text" class="custom-input" name="email" value="{{$user->ecole->mail}}" disabled/>
                </div>
                <div class="icone-input my-4 little">
                    <i class="fa-solid fa-phone"></i>
                    <input type="text" class="custom-input" name="email" value="{{$user->ecole->telephone}}" disabled/>
                </div>
            </div>
        


        </div>
        <div class="gridcadre grid3 d-flex ">
            <div class="gridTitre">Mes aides maternelles</div>
            <div class="groupesAide d-flex flex-wrap">
                <div class="groupeAide">
                    <div class="icone-input my-2 little">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" class="custom-input" name="prenom[]" value="{{$user->prenom}}" placeholder="Prénom" />
                    </div> 
                    <div class="icone-input my-2 little">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" class="custom-input" name="name[]" value="{{$user->name}}" placeholder="Nom" />
                    </div>
                    <div class="form-group">            
                        <select class="custom-select little" name="fonction[]">
                                <option value="0">Aide maternelle (ATSEM)</option>
                                <option value="1">AESH</option>
                        </select>
                    </div>                
                </div>
                <div class="groupeAide">
                    <div class="icone-input my-2 little">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" class="custom-input" name="prenom[]" value="{{$user->prenom}}" placeholder="Prénom" />
                    </div> 
                    <div class="icone-input my-2 little">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" class="custom-input" name="name[]" value="{{$user->name}}" placeholder="Nom" />
                    </div>
                    <div class="form-group">            
                        <select class="custom-select little" name="fonction[]">
                                <option value="0">Aide maternelle (ATSEM)</option>
                                <option value="1">AESH</option>
                        </select>
                    </div>                
                </div>
                <div class="groupeAide">
                    <div class="icone-input my-2 little">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" class="custom-input" name="prenom[]" value="{{$user->prenom}}" placeholder="Prénom" />
                    </div> 
                    <div class="icone-input my-2 little">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" class="custom-input" name="name[]" value="{{$user->name}}" placeholder="Nom" />
                    </div>
                    <div class="form-group">            
                        <select class="custom-select little" name="fonction[]">
                                <option value="0">Aide maternelle (ATSEM)</option>
                                <option value="1">AESH</option>
                        </select>
                    </div>                
                </div>
                <div class="groupeAide">
                    <div class="icone-input my-2 little">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" class="custom-input" name="prenom[]" value="{{$user->prenom}}" placeholder="Prénom" />
                    </div> 
                    <div class="icone-input my-2 little">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" class="custom-input" name="name[]" value="{{$user->name}}" placeholder="Nom" />
                    </div>
                    <div class="form-group">            
                        <select class="custom-select little" name="fonction[]">
                                <option value="0">Aide maternelle (ATSEM)</option>
                                <option value="1">AESH</option>
                        </select>
                    </div>                
                </div>                
            </div>

            <button type="submit" class="btnAction">Sauvegarder</button>
        </div>
        <div class="gridcadre grid4">
            <div class="gridTitre">Direction</div>
            <div class="d-flex">
                <div class="form-group m-4">            
                    <select class="custom-select little" name="fonction[]">
                            <option value="mlle">Mademoiselle</option>
                            <option value="mme">Madame</option>
                            <option value="mrs">Monsieur</option>
                    </select>
                </div> 
                <div class="icone-input m-4 little">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" class="custom-input" name="prenom" value="{{$user->prenom}}" placeholder="Prénom" />
                </div> 
                <div class="icone-input m-4 little">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" class="custom-input" name="name" value="{{$user->name}}" placeholder="Nom" />
                </div>                
            </div>

            <button type="submit" class="btnAction">Sauvegarder</button>

        </div>

    </div>




</div>

@endsection
