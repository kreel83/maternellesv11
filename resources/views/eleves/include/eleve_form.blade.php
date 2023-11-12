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
        <div>
            @if (isset($eleve['user_n1_id']))
                @if ($eleve['user_n1_id'])
                <a href="{{route('removeEleve',['eleve' => $eleve['id']])}}" class="btn btn-danger btn-sm w-100 mt-2 remove_eleve" data-id="{{$eleve['id']}}">retirer l'élève de ma classe</a>
                @else
                <a href="{{route('removeEleve',['eleve' => $eleve['id']])}}" class="btn btn-danger btn-sm w-100 mt-2 remove_eleve" data-id="{{$eleve['id']}}">supprimer l'élève de ma classe</a>
                @endif
            @endif
        </div>
    @endif

    </div>






</form>   