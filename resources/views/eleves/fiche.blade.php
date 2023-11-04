@extends('layouts.mainMenu2',['titre' => 'Ma classe', 'menu' => 'eleve'])

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
    .avatar {
        font-size: 40px;
    }
    
    .avatar.pink {
        color: lightpink;
    }
    .avatar.blue {
        color: lightskyblue;
    }
</style>

@php
    // dd($resultats);
@endphp

@section('content')

@php
    $flag=false;
@endphp

<div class="mt-5" id="fiche_eleve">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('depart') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item"><a href="{{ route('maclasse') }}">Ma classe</a></li>
        <li class="breadcrumb-item active" aria-current="page">Mon élève</li>
    </ol>

    <!-- Validation Errors -->
    @if ($errors->any())
    <div class="alert alert-danger">
       
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
       
    </div>
    @endif
    {{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif --}}

    <div class="row">

        <div class="col-md-6 gauche d-flex justify-content-center align-items-center">
            <style>
                .croix {
                    right: -20px; top: -20px; cursor: pointer;
                    font-size: 30px; color: grey;

                }
            </style>

            <div class="d-none fiche_modify_bloc position-relative">
                <div class="position-absolute croix" style="">
                    <i class="fas fa-times"></i>
                </div>
                <div class="fiche_modify">

                </div>
            </div>

            <form action="{{ route('enregistreEleve') }}" method="post" class="w-100">
            @csrf

            <input type="hidden" id="eleve_form" name="id" value="new" />
            <input type="hidden" id="id" name="id" value="{{ $eleve['id'] }}">
            <input type="hidden" id="btnRetourFicheEnfantValue" name="backUrl" value="{{ old('backUrl') ?? $backUrl }}">

            <div class="d-flex justify-content-between">

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="genre" id="genref" value="F" {{$eleve['genre'] == 'F' ? 'checked' : null}}>
                    <label class="form-check-label" for="genref">Fille</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="genre" id="genreg" value="G" {{$eleve['genre'] == 'G' ? 'checked' : null}}>
                    <label class="form-check-label" for="genreg">Garçon</label>
                </div>

                {{-- <div class="d-flex avatarBloc" data-flag="{{ $flag ?? null}}">
                    <div class="avatar avatar_form pink me-5 {{$eleve->genre == 'F' ? 'selected' : null}}" data-genre="F"><i
                            class="fa-thin fa-user-tie-hair-long"></i></div>
                    <div class="avatar avatar_form blue {{$eleve->genre == 'G' ? 'selected' : null}}"  data-genre="G"><i
                            class="fa-thin fa-user-tie-hair"></i></div>
                </div> --}}

                <div class="d-flex flex-column ms-3 mt-2">

                    <div class="form-check mb-3 " style="height: 15px">
                        <input type="checkbox" class="form-check-input" name="sh" id="sh"
                            value="true" {{$eleve['sh'] == 1 ? 'checked' : null}}>
                        <label class="form-sh-label" for="sh">L'élève est en situation <br>de handicap ?</label>
                    </div>
                    <div>
                        <button type="button" id="eleveCoursAnnee"
                        style="font-size: 14px;color: var(--main-color)" class="btn btn-sm btnCoursAnnéee">Arrivé en cours d'année ?</button>
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


            <div id="selectPeriodeBloc" class="d-none mb-3">
                <label for="">Prochain cahier de réussite prévu pour fin :</label>    
                <select name="periode"  class="custom-select" style="width: 100% !important">
                    <option value="">Choississez une période</option>
                    @foreach ($periodes as $key => $periode)
                        <option value="{{ $key + 1 }}" {{$key == 0 ? 'selected' : null}}>{{ $periode }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <select name="psmsgs" id="psmsgs" value="{{$eleve['psmsgs']}}" class="form-select"">
                    <option value="">Choississez une section</option>
                    <option value="ps" {{$eleve['psmsgs'] == 'ps' ? 'selected' : null}}>Petite section</option>    
                    <option value="ms" {{$eleve['psmsgs'] == 'ms' ? 'selected' : null}}>Moyenne section</option>    
                    <option value="gs" {{$eleve['psmsgs'] == 'gs' ? 'selected' : null}}>Grande section</option>    
                </select>
            </div>    

            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                <input type="text" class="form-control form-control-lg" id="nom_form" name="nom" placeholder="Nom de l'élève" value="{{ old('nom') ?? $eleve['nom'] }}">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                <input type="text" class="form-control form-control-lg" id="prenom_form" name="prenom" placeholder="Prénom de l'élève" value="{{ old('prenom') ?? $eleve['prenom'] }}">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-cake-candles"></i></span>
                <input type="date" class="form-control form-control-lg" id="ddn_form" name="ddn" placeholder="Date de naissance de l'élève" value="{{ old('ddn') ?? $eleve['ddn'] }}">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-note-sticky"></i></span>
                <textarea class="form-control" rows="3" id="commentaire_form" name="comment" placeholder="Commentaire">{{ old('comment') ?? $eleve['comment'] }}</textarea>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fa-sharp fa-solid fa-envelope"></i></span>
                <input type="email" class="form-control form-control-lg" id="mail1_form" name="mail1" id="mail1" value="{{ old('mail1') ?? $eleve['mail1'] }}" placeholder="Mail principal">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fa-sharp fa-solid fa-envelope"></i></span>
                <input type="email" class="form-control form-control-lg" id="mail2_form" name="mail2" id="mail2" value="{{ old('mail2') ?? $eleve['mail2'] }}" placeholder="Mail secondaire">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fa-sharp fa-solid fa-envelope"></i></span>
                <input type="email" class="form-control form-control-lg" id="mail3_form" name="mail3" id="mail3" value="{{ old('mail3') ?? $eleve['mail3'] }}" placeholder="Mail supplementaire">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fa-sharp fa-solid fa-envelope"></i></span>
                <input type="email" class="form-control form-control-lg" id="mail4_form" name="mail4" id="mail4" value="{{ old('mail4') ?? $eleve['mail4'] }}" placeholder="Mail supplementaire">
            </div>

            @if (!isset($flag))
                <div class="d-flex">
                    <button type="button" class="custom_button big submit save_eleve">Sauvegarder</button>

                    <button type="button" data-id="new"
                        class="custom_button submit remove_eleve delete ms-1">Retirer</button>
                </div>
            @else
                <div class="d-flex justify-content-between">
                    {{-- href mis à jour dans cahier.js --}}
                    <a href="" id="btnRetourFicheEnfant" type="button" class="btn btn-outline-secondary">Annuler</a>
                    <button type="submit" class="btn btn-primary" data-id="{{$eleve['id']}}">{{ ($eleve['id'] == 'new' ? 'Créer la fiche' : 'Modifier la fiche')}}</button>
                </div>
            @endif

            </form>

        </div>


        @if ($eleve['id'] != 'new')

            <div class="col-md-6">


                <h4 class="text-center">Compétences acquises</h4>

                @php
                    $section_id = 0;
                @endphp

                <div class="liste_eleves ps-4" style="margin-top: 20px;">
                    <input type="hidden" id="enfant" value="{{$eleve->id}}">

                        <ul class="list-group">
                        @foreach($resultats as $resultat)

                            @if($section_id != $resultat->section_id)
                                
                                </ul>

                                <div class="mb-1 mt-3">
                                    <img width="40" class="img-fluid" src="{{ asset('img/illustrations/'.$resultat->sectionLogo) }}">
                                    <strong>{{ $resultat->sectionName }}</strong>
                                </div>
                            
                                <ul class="list-group">
                                @php
                                    $section_id = $resultat->section_id;
                                @endphp
                            @endif

                            <!--<div class="mb-1 ml-5">-->
                                <li class="list-group-item">

                                @if ($resultat->notation == 2 && $resultat->autonome == 0)
                                    <div class="list-group-item-info" data-fiche="{{$resultat->id}}">
                                @endif

                                {{--
                                 @if ($resultat->notation == 2 && $resultat->autonome == 1) 
                                <li class="list-group-item list-group-item-success">
                                @elseif ($resultat->notation == 2 && $resultat->autonome == 0)
                                <li class="list-group-item list-group-item-info">
                                @elseif ($resultat->notation == 1)
                                <li class="list-group-item list-group-item-warning">
                                @endif
                                --}}
                                    {{ $resultat->itemName }}
                                    @if($resultat->autonome == 0)
                                        (acquis avec aide)
                                    @endif

                                    @if ($resultat->notation == 2 && $resultat->autonome == 0)
                                    </a>
                                    @endif

                                </li>

                                {{--
                                <div class="collapse" id="collapseExample{{$resultat->id}}">
                                    <div class="card card-body">
                                      Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
                                    </div>
                                </div>
                                --}}
                            <!--</div>-->
                            
                        @endforeach
                            </ul>

                </div>

            </div>            
        @endif

    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="modifyFicheModal" tabindex="-1" aria-labelledby="modifyFicheModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

@endsection