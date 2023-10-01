@extends('layouts.mainMenu2',['titre' => 'Mon profil', 'menu' => 'monprofil'])

@section('content')


<div class="container my-5 page" id="mon profil">



    @if(!empty(session('result')))
        <div class="alert alert-success">Votre profil a été mis à jour.</div>
    @endif



    <style>
        .grid_profil {
            display: grid;
            grid-template-columns:1fr 1fr; 
            grid-template-rows: 370px 220px 220px 220px;
            grid-gap: 35px; 
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
            grid-column: 1;
            grid-row: 3
        }
        .grid5 {
            grid-column: 2;
            grid-row: 3
        }
        .grid6 {
            grid-column: 1;
            grid-row: 4
        }
        .gridcadre {
            width: 100%;
            border-radius: 40px;
            position: relative;
            padding: 10px 40px;
            background-color: white;
        }
        .gridTitre {
            position: absolute;
            top: -16px;
            left: 30px;
            font-weight: 400;
            font-size: 16px;
            padding: 4px 16px;
            background-color: white;
            border-radius: 14px;
            box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;

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

        <div class="gridcadre grid3 d-flex justify-content-between w-100 tuto_aides">
            <div class="gridTitre">Mes aides maternelles</div>
            <form action="{{route('aidematernelle.post')}}" method="post" class="d-flex justify-content-between w-100">
                @csrf
                <div class="groupesAide d-flex flex-wrap justify-content-between w-100 pt-3">
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


<style>

</style>



        <div class="gridcadre grid4 d-flex flex-column justify-content-between align-items-center tuto_direction">
            <div class="gridTitre">Direction</div>


            <div class="d-flex flex-column w-100 pt-4">
                <div>
                    <form action="{{route('directeur.post')}}" method="POST" class="w-100 d-flex justify-content-between align-items-center">
                        @csrf
                        <div class="d-flex flex-column w-100 justify-content-end align-items-center">

                            <div class="form-group my-1 ">            
                                <select style="width: 220px" class="custom-select little" name="directeur_civilite">

                                    <option value="mlle" {{ $user->directeur_civilite == 'mlle' ? 'selected' : null}}>Mademoiselle</option>
                                    <option value="mme" {{ $user->directeur_civilite == 'mme' ? 'selected' : null}}>Madame</option>
                                    <option value="mrs" {{ $user->directeur_civilite == 'mrs' ? 'selected' : null}}>Monsieur</option>
                                </select>
                            </div> 
                            <div class="icone-input little my-1">
                                <i class="fa-solid fa-user"></i>
                                <input type="text" class="custom-input" name="directeur_prenom" value="{{$user->directeur_prenom}}" placeholder="Prénom" />
                            </div> 
                            <div class="icone-input little" my-1>
                                <i class="fa-solid fa-user"></i>
                                <input type="text" class="custom-input" name="directeur_nom" value="{{$user->directeur_nom}}" placeholder="Nom" />
                            </div>                

                        </div>
                        
                        <button type="submit" style="" class="btnAction ">Sauvegarder</button>
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
        <div class="gridcadre grid5 d-flex justify-content-center align-items-center tuto_periodicite">
            <div class="gridTitre">Périodocité</div>
            <form action="{{route('periode_save')}}" class="w-50 d-flex flex-column justify-content-center align-items-center">            
                <select name="periode" class="custom-select">
                    <option value="1" {{$periodes == 1 ? 'selected' : null}}>Année entère</option>
                    <option value="2" {{$periodes == 2 ? 'selected' : null}}>Par semestre</option>
                    <option value="3" {{$periodes == 3 ? 'selected' : null}}>Par trimestre</option>
                </select>
                <button type="submit" style="" class="btnAction mt-3">Sauvegarder</button>
            </form>    
        </div>
        <div class="gridcadre grid6 d-flex justify-content-center align-items-center tuto_tutoriel">
            <div class="gridTitre">Tutoriel</div>
            <form action="{{route('modeTuto')}}" class="w-50 d-flex flex-column justify-content-center align-items-center">            
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="tuto_form" name="state" value="on" {{ Auth::user()->configuration->tuto == 1 ? 'checked' : null}}>
                    <label class="form-check-label" for="tuto_form">Mode Tutoriel activé</label>
                  </div>
                <button type="submit" style="" class="btnAction mt-3">Sauvegarder</button>
            </form>    
        </div>

    </div>




</div>



@endsection
