@extends('layouts.mainMenu2',['titre' => 'Mon profil', 'menu' => 'monprofil'])

@section('content')

<div class="container my-5 page" id="monprofil">

    <nav class="pb-4" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('depart')}}">Tableau de bord</a></li>        
            <li class="breadcrumb-item active" aria-current="page">Mon profil</li>
          </ol>
    </nav>

    @if(!empty(session('status')))
        <div class="mb-5">
            @include('include.display_msg_error')
        </div>
    @endif

    <div class="grid_profil">

        <div class="gridcadre grid1 d-flex justify-content-between w-100 tuto_aides">
            <div class="gridTitre">Mes aides maternelles</div>
            <form action="{{route('aidematernelle.post')}}" method="post" class="d-flex justify-content-between w-100">
                @csrf
                <div class="groupesAide d-flex flex-wrap justify-content-between w-100 pt-3  flex-column flex-md-row">
                    <div class="d-flex justify-content-between  flex-column flex-md-row">
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


        <div class="gridcadre grid3 d-flex flex-column justify-content-between align-items-center tuto_direction">
            <div class="gridTitre">Direction</div>


            <div class="d-flex flex-column w-100 pt-4">
                <div class="">
                    <form action="{{route('directeur.post')}}" method="POST" class="w-100 d-flex justify-content-between align-items-center flex-column flex-md-row">
                        @csrf
                        <div class="d-flex flex-column w-100 justify-content-end align-items-center ">

                            <div class="form-group my-1 ">            
                                <select style="width: 220px" class="custom-select little" name="civilite">

                                    <option value="">Veuillez sélectionner</option>
                                    <option value="M." {{ $directeur && $directeur->civilite == 'M.' ? 'selected' : null}}>Monsieur</option>
                                    <option value="Mme" {{ $directeur && $directeur->civilite == 'Mme' ? 'selected' : null}}>Madame</option>
                                </select>
                            </div> 
                            <div class="icone-input little my-1">
                                <i class="fa-solid fa-user"></i>
                                <input type="text" class="custom-input" name="prenom" value="{{$directeur->prenom ?? null}}" placeholder="Prénom" />
                            </div> 
                            <div class="icone-input little" my-1>
                                <i class="fa-solid fa-user"></i>
                                <input type="text" class="custom-input" name="nom" value="{{$directeur->nom ?? null}}" placeholder="Nom" />
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
        <div class="gridcadre grid4 d-flex justify-content-center align-items-center tuto_periodicite">
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


        <style>
            .section_ligne {
                font-size: 12px;
                font-weight: bolder;
                padding: 4px;
                margin: 4px 0;
            }
        </style>

        <div class="gridcadre grid5 d-flex justify-content-center align-items-center tuto_tutoriel">
            <div class="gridTitre">Acquis avec aide</div>
            <div class="mt-3">
                <form action="{{route('activeAcquisAide')}}" class=" d-flex flex-column justify-content-center align-items-center">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="activeAcquisAide" name="activeAcquisAide" {{Auth::user()->classe_active()->desactive_acquis_aide == 0 ? 'checked' : null}}>
                        <label class="form-check-label" for="activeAcquisAide">Afficher les activités <strong>acquises avec aide</strong> dans le cahier de réussites</label>
                    </div>
                    <button type="submit" style="" class="btnAction mt-3">Sauvegarder</button>
                </form>
            </div>
        </div>

        <div class="gridcadre grid6 d-flex justify-content-center align-items-center tuto_tutoriel">
            <div class="gridTitre">Domaine optionnel</div>
            <div class="mt-3">
                <form action="{{route('activeDomaineEleve')}}" class=" d-flex flex-column justify-content-center align-items-center">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="activeDomaineEleve" name="activeDomaineEleve" {{Auth::user()->classe_active()->desactive_devenir_eleve == 0 ? 'checked' : null}}>
                        <label class="form-check-label" for="activeDomaineEleve">Activer le domaine " Devenir élève " dans le cahier de réussites</label>
                    </div>
                    <button type="submit" style="" class="btnAction mt-3">Sauvegarder</button>
                </form>
            </div>
              
        </div>
        <div class="gridcadre grid7 d-flex justify-content-center align-items-center tuto_tutoriel">
            <div class="gridTitre">Activation des aides</div>
            <div class="mt-3">
                <form action="{{route('activeDomaineEleve')}}" class=" d-flex flex-column justify-content-center align-items-center">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="activeDomaineEleve" name="activeDomaineEleve" {{Auth::user()->classe_active()->help == 0 ? 'checked' : null}}>
                        <label class="form-check-label" for="activeDomaineEleve">Activer les bulles d'aides</label>
                    </div>
                    <button type="submit" style="" class="btnAction mt-3">Sauvegarder</button>
                </form>
            </div>
              
        </div>

    </div>




</div>



@endsection
