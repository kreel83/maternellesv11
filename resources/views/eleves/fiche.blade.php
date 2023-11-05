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
    {{-- @if ($errors->any())
    <div class="alert alert-danger">
       
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
       
    </div>
    @endif --}}
    {{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif --}}

    <div class="position-relative gx-0" style="width: 100%; height: 100%">
        <img src="{{asset('img/deco/fond_1.jpg')}}" alt="" class="position-absolute" width="100%" style="top:0;bottom:0;left:0;right:0">

        <div class="position-absolute" style="top: 80px;left: 250px; width: 470px;padding: 16px;height: 660px; font-size: 50px; color: #6639AC">
            un nouvel élève
        </div>
        <div class="position-absolute" style="top: 110px;left: 717px; width: 474px;padding: 16px;height: 677px; border: 1px solid var(--main-color); border-radius: 8px">
            <style>
                .croix {
                    right: 50px; top: 50px; cursor: pointer;
                    font-size: 30px; color: white;

                }
            </style>

            <div class="d-none fiche_modify_bloc position-relative">
                <div class="position-absolute croix" style="">
                    <i class="fas fa-times"></i>
                </div>
                <div class="fiche_modify w-100 h-100 d-flex justify-content-center align-items-center" style="background-color: #9978C9; border-radius: 15px">

                </div>
            </div>


            <div class="form_bloc">
                <form action="{{ route('enregistreEleve') }}" method="post" class="d-flex flex-column align-items-between">
                                @csrf
                                <div style="overflow-y: auto; height: 550px " class="pe-2 ">
                                    <input type="hidden" id="eleve_form" name="id" value="new" />
                                    <input type="hidden" id="id" name="id" value="{{ $eleve['id'] }}">
                                    <input type="hidden" id="btnRetourFicheEnfantValue" name="backUrl" value="{{ old('backUrl') ?? $backUrl }}">
                                    
                                    {{-- <div class="d-flex justify-content-between px-5 mb-3" style="font-size: 14px; color: grey">
                                        
                                        <div class="form-check form-check-inline input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-venus"></i></span>
                                            <input class="form-check-input" type="radio" name="genre" id="genref" value="F" {{$eleve['genre'] == 'F' ? 'checked' : null}}>

                                        </div>
                                        <div class="form-check form-check-inline input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-mars"></i></span>
                                            <input class="form-check-input ms-2" type="radio" name="genre" id="genreg" value="G" {{$eleve['genre'] == 'G' ? 'checked' : null}}>

                                        </div>
                    
                    
                                    </div> --}}
                                    <style>

                                    </style>

                                    <div class="d-flex justify-content-between mb-2 px-5">
                                        <div class="input-group text-center" style="border-right: 3px solid var(--main-color)">
                                            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-venus"></i></span> 
                                            <input type="radio" class="btn-check" name="genre" id="genref" value="F" {{$eleve['genre'] == 'F' ? 'checked' : null}}>
                                            <label class="btn" for="genref">Fille</label>
                                        </div>
                                        
                                        <div class="input-group d-flex justify-content-end ">
                                            <span class="input-group-text" id="basic-addon2"><i class="fa-solid fa-mars"></i></span> 
                                            <input type="radio" class="btn-check" name="genre" id="genreg" autocomplete="off" value="G" {{$eleve['genre'] == 'G' ? 'checked' : null}}>
                                            <label class="btn" for="genreg">Garcon</label>
                                        </div>
                                        
                                        
                                    </div>
                                    @error('genre')
                                    <div class="error_message">{{ $message }}</div>                                        
                                    @enderror
                    
                    
                    
                    
                                    <div class="input-group mb-2">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-lines-leaning"></i></span>
                                        <select name="psmsgs" id="psmsgs" value="{{$eleve['psmsgs']}}" class="form-select" style="font-size: 14px; color: grey">
                                            <option value="">Choississez une section</option>
                                            <option value="ps" {{$eleve['psmsgs'] == 'ps' ? 'selected' : null}}>Petite section</option>    
                                            <option value="ms" {{$eleve['psmsgs'] == 'ms' ? 'selected' : null}}>Moyenne section</option>    
                                            <option value="gs" {{$eleve['psmsgs'] == 'gs' ? 'selected' : null}}>Grande section</option>    
                                        </select>
                                        @error('psmsgs')
                                        <div class="error_message">{{ $message }}</div>                                        
                                        @enderror
                                    </div>    
                    
                                    <div class="input-group mb-2">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                                        <input type="text" class="form-control form-control-lg" id="nom_form" name="nom" placeholder="Nom de l'élève" value="{{ old('nom') ?? $eleve['nom'] }}">

                                        @error('nom')
                                            <div class="error_message">{{ $message }}</div>                                        
                                        @enderror
                                    

                                    </div>
                    
                                    <div class="input-group mb-2">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                                        <input type="text" class="form-control form-control-lg" id="prenom_form" name="prenom" placeholder="Prénom de l'élève" value="{{ old('prenom') ?? $eleve['prenom'] }}">
                                        @error('prenom')
                                        <div class="error_message">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                    
                                    <div class="input-group mb-2">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-cake-candles"></i></span>
                                        <input type="date" class="form-control form-control-lg" id="ddn_form" name="ddn" placeholder="Date de naissance de l'élève" value="{{ old('ddn') ?? $eleve['ddn'] }}">
                                        @error('ddn')
                                        <div class="error_message">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                    
                                    <div class="input-group mb-2">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-note-sticky"></i></span>
                                        <textarea class="form-control" rows="3" id="commentaire_form" name="comment" placeholder="Commentaire">{{ old('comment') ?? $eleve['comment'] }}</textarea>
                                    </div>
                    
                                    <div class="input-group mb-2">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa-sharp fa-solid fa-envelope"></i></span>
                                        <input type="email" class="form-control form-control-lg" id="mail1_form" name="mail1" id="mail1" value="{{ old('mail1') ?? $eleve['mail1'] }}" placeholder="Mail principal">
                                    </div>
                    
                                    <div class="input-group mb-2">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa-sharp fa-solid fa-envelope"></i></span>
                                        <input type="email" class="form-control form-control-lg" id="mail2_form" name="mail2" id="mail2" value="{{ old('mail2') ?? $eleve['mail2'] }}" placeholder="Mail secondaire">
                                    </div>
                    
                                    <div class="input-group mb-2">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa-sharp fa-solid fa-envelope"></i></span>
                                        <input type="email" class="form-control form-control-lg" id="mail3_form" name="mail3" id="mail3" value="{{ old('mail3') ?? $eleve['mail3'] }}" placeholder="Mail supplementaire">
                                    </div>
                    
                                    <div class="input-group mb-2">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa-sharp fa-solid fa-envelope"></i></span>
                                        <input type="email" class="form-control form-control-lg" id="mail4_form" name="mail4" id="mail4" value="{{ old('mail4') ?? $eleve['mail4'] }}" placeholder="Mail supplementaire">
                                    </div>
                                    <div class="form-check mb-2 ">
                                        <input type="checkbox" class="form-check-input" name="sh" id="sh"
                                            value="true" {{$eleve['sh'] == 1 ? 'checked' : null}}>
                                        <label class="form-sh-label" for="sh" style="font-size: 12px; color: grey;padding-top: 2px">L'élève est en situation de handicap ?</label>
                                    </div>
                                    <div class="form-check mb-2 eleveCoursAnnee_bloc">
                                        <input type="checkbox" class="form-check-input" id="eleveCoursAnnee">
                                        <label class="form-sh-label" for="sh2" style="font-size: 12px; color: grey;padding-top: 2px">L'élève arrive en cours d'année</label>
                                    </div>
                                    <div id="selectPeriodeBloc" class="d-none mb-2">
                                        <label for="" style="font-size: 14px; color: grey">Prochain cahier de réussite prévu pour fin :</label>    
                                        <select name="periode"  class="form-select" style="font-size: 14px; color: grey">
                                            <option value="">Choississez une période</option>
                                            @foreach ($periodes as $key => $periode)
                                                <option value="{{ $key + 1 }}" {{$key == 0 ? 'selected' : null}}>{{ $periode }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div style="height: 55px ">
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
                                        <button type="submit" class="custom_button ms-3" data-id="{{$eleve['id']}}">{{ ($eleve['id'] == 'new' ? 'Créer la fiche' : 'Modifier la fiche')}}</button>
                                    </div>
                                @endif

                                </div>

                    




                </form>                
            </div>


        </div>


        @if ($eleve['id'] != 'new')

            <div class="position-absolute" style="top: 44px; left: 56px;width: 620px;height: 800px; overflow-y: auto">


                <h4 class="text-center">Compétences acquises</h4>

                @php
                    $section_id = 0;
                @endphp

                <div class="liste_eleves ps-4" style="margin-top: 20px;">
                    <input type="hidden" id="enfant" value="{{$eleve['id']}}">

                        <ul class="list-group">
                        @foreach($resultats as $resultat)

                            @if($section_id != $resultat->section_id)
                                
                                </ul>

                                <div class="mb-2 mt-3">
                                    <img width="40" class="img-fluid" src="{{ asset('img/illustrations/'.$resultat->sectionLogo) }}">
                                    <strong>{{ $resultat->sectionName }}</strong>
                                </div>
                            
                                <ul class="list-group">
                                @php
                                    $section_id = $resultat->section_id;
                                @endphp
                            @endif

                            <!--<div class="mb-2 ml-5">-->
                                <li class="list-group-item">

                                
                                    <div class="list-group-item-info" data-fiche="{{$resultat->id}}">
                               

                                {{--
                                 @if ($resultat->notation == 2 && $resultat->autonome == 1) 
                                <li class="list-group-item list-group-item-success">
                                @elseif ($resultat->notation == 2 && $resultat->autonome == 0)
                                <li class="list-group-item list-group-item-info">
                                @elseif ($resultat->notation == 1)
                                <li class="list-group-item list-group-item-warning">
                                @endif
                                --}}

                                @php
                                    if ($resultat->notation == 2 && $resultat->autonome == 1) {
                                        $resultat->notation = 3 ;
                                    }
                                @endphp

                                    <span class="me-2" style="color: var(--niveau_{{$resultat->notation}})"><i class="fa-solid fa-circle"></i></span>{{ $resultat->itemName }}
                                    {{-- @if($resultat->autonome == 0)
                                        (acquis avec aide)
                                    @endif --}}

                                    
                       

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
