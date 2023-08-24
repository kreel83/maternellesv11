@extends('layouts.mainMenu',['titre' => 'Mon profil', 'menu' => 'monprofil'])

@section('content')

<div class="container">



    @if(!empty(session('result')))
        <div class="alert alert-success">Votre profil a été mis à jour.</div>
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
            <form action="{{route('monprofil')}}" method="post">
                @csrf
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
                        <input type="text" class="custom-input" name="phone" value="{{$user->phone}}" placeholder="Téléphone" />
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

        <div class="gridcadre grid3 d-flex justify-content-between w-100">
            <div class="gridTitre">Mes aides maternelles</div>
            <form action="{{route('aidematernelle.post')}}" method="post" class="d-flex justify-content-between w-100">
                @csrf
                <div class="groupesAide d-flex flex-wrap justify-content-between w-100">
                    <div class="d-flex justify-content-between">
                        @for ($i = 0; $i<=3; $i++)
                        <div class="groupeAide">
                            <div class="icone-input my-2 little">
                                <i class="fa-solid fa-user"></i>
                                <input type="text" class="custom-input" name="aide[{{$i}}][prenom]" value="{{$equipes[$i][0] ?? null}}" placeholder="Prénom" />
                            </div> 
                            <div class="icone-input my-2 little">
                                <i class="fa-solid fa-user"></i>
                                <input type="text" class="custom-input" name="aide[{{$i}}][name]" value="{{$equipes[$i][1] ?? null}}" placeholder="Nom" />
                            </div>
                            <div class="form-group">            
                                <select class="custom-select little" name="aide[{{$i}}][fonction]">
                                    <option value="">Choisissez</option>
                                    @foreach(App\Models\User::FONCTIONS as $key=>$fonction)
                                        <option value="{{$key}}" {{(isset($equipes[$i][2]) && ($key == $equipes[$i][2])) ? 'selected' : null }}>{{$fonction}}</option>
                                    @endforeach                                
                                </select>
                                @if(Session::has('error'.$i))
                                <p class="error_message">{{ Session::get('error'.$i) }}</p>
                                @endif
                            </div>               
                        </div>
                        @endfor
                    </div>
                    <div class="d-flex align-items-end mb-4">
                        <button type="submit" class="btnAction" style="height: 34px">Sauvegarder</button>
                    </div>
                </div>
            </form>


            


        </div>






        <div class="gridcadre grid4 d-flex justify-content-between align-items-center">
            <div class="gridTitre">Direction</div>

            <div class="d-flex flex-column w-100">
                <div>
                    <form action="{{route('directeur.post')}}" method="POST" class="w-100 d-flex justify-content-between align-items-center">
                        @csrf
                        <div class="d-flex w-100 justify-content-around align-items-center">

                            <div class="form-group m-4">            
                                <select style="width: 220px" class="custom-select little" name="directeur_civilite">

                                    <option value="mlle" {{ $user->directeur_civilite == 'mlle' ? 'selected' : null}}>Mademoiselle</option>
                                    <option value="mme" {{ $user->directeur_civilite == 'mme' ? 'selected' : null}}>Madame</option>
                                    <option value="mrs" {{ $user->directeur_civilite == 'mrs' ? 'selected' : null}}>Monsieur</option>
                                </select>
                            </div> 
                            <div class="icone-input m-4 little">
                                <i class="fa-solid fa-user"></i>
                                <input type="text" class="custom-input" name="directeur_prenom" value="{{$user->directeur_prenom}}" placeholder="Prénom" />
                            </div> 
                            <div class="icone-input m-4 little w-25">
                                <i class="fa-solid fa-user"></i>
                                <input type="text" class="custom-input" name="directeur_nom" value="{{$user->directeur_nom}}" placeholder="Nom" />
                            </div>                

                        </div>
                        
                        <button type="submit" style="" class="btnAction m-0">Sauvegarder</button>
                    </form>
                </div>
                <div>
                    @if ($errors->any())
                    <div class="error_message">                               
                        
                                {{ $errors->first() }}
                        
                    
                    </div>
                @endif
                </div>

            </div>


        </div>

    </div>




</div>

@endsection
