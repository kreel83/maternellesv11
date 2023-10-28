<form action="{{ route('save_eleve_form') }}" method="post" id="elevePost"
style="font-size: 12px; padding: 10px;" class="affiche_eleve">
@csrf



<input type="hidden" id="eleve_form" name="id" value="new" />
<input type="hidden" id="genre" name="genre" value="F" />
<div class="d-flex justify-content-between">
    <div class="d-flex flex-column">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="psmsgs" id="ps"
                value="ps" {{$eleve->psmsgs == 'ps' ? 'checked' : null}} {{ $flag ?? null}}>
            <label class="form-check-label" for="ps">PS</label>
        </div>
        <div class="form-check">

            <input class="form-check-input" type="radio" name="psmsgs" id="ms"
                checked value="ms" {{$eleve->psmsgs == 'ms' ? 'checked' : null}} {{ $flag ?? null}}>
            <label class="form-check-label" for="ms">MS</label>

        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="psmsgs" id="gs"
                value="gs" {{$eleve->psmsgs == 'gs' ? 'checked' : null}}  {{ $flag ?? null}}>
            <label class="form-check-label" for="gs">GS</label>
        </div>

    </div>
    <div class="d-flex avatarBloc" data-flag="{{ $flag ?? null}}">
        <div class="avatar avatar_form pink me-5 {{$eleve->genre == 'F' ? 'selected' : null}}" data-genre="F"><i
                class="fa-thin fa-user-tie-hair-long"></i></div>
        <div class="avatar avatar_form blue {{$eleve->genre == 'G' ? 'selected' : null}}"  data-genre="G"><i
                class="fa-thin fa-user-tie-hair"></i></div>

    </div>
    <div class="d-flex flex-column ms-3 mt-2">

        <div class="form-check mb-3 " style="height: 15px">
            <input type="checkbox" class="form-check-input" name="sh" id="sh"
                value="true" {{$eleve->sh == 1 ? 'checked' : null}}  {{ $flag ?? null}}>
            <label class="form-sh-label" for="sh">L'élève est en situation <br>de
                handicap ?</label>
        </div>
        <div>
            <button type="button" id="eleveCoursAnnee"
                style="font-size: 14px;color: var(--main-color)" class="btn btn-sm btnCoursAnnéee"  {{ $flag ?? null}}
                >Arrivé en cours d'année ?</button>
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


<div id="selectPeriodeBloc" class="d-none">
    <label for="">Prochain cahier de réussite prévu pour fin :</label>    
    <select name="periode"  class="custom-select" style="width: 100% !important">
        <option value="">Choississez une période</option>
        @foreach ($periodes as $key => $periode)
            <option value="{{ $key + 1 }}" {{$key == 0 ? 'selected' : null}}>{{ $periode }}</option>
        @endforeach
    </select>
</div>    

<div class="icone-input my-4">
    <i class="fa-solid fa-user"></i>
    <input type="text" class="custom-input" id="nom_form" name="nom" value="{{ $eleve->nom }}"
        placeholder="Nom de l'élève"  {{ $flag ?? null}} />
</div>
<div class="icone-input my-4">
    <i class="fa-solid fa-user"></i>
    <input type="text" class="custom-input" id="prenom_form" name="prenom"
    value="{{ $eleve->prenom }}" placeholder="Prénom de l'élève"  {{ $flag ?? null}}/>
</div>
<div class="icone-input my-4">
    <i class="fa-solid fa-cake-candles"></i>
    <input type="date" class="custom-input" id="ddn_form" name="ddn" value="{{ $eleve->ddn }}"
        placeholder="Date de naissance de l'élève"  {{ $flag ?? null}} />
</div>
<div class="custom-area">
    <textarea type="date" class="custom-input" id="commentaire_form" name="comment" placeholder="Commentaire"  {{ $flag ?? null}}>{{ $eleve->comment }}</textarea>
</div>

<div class="icone-input my-4">
    <i class="fa-sharp fa-solid fa-envelope"></i>
    <input type="email" class="custom-input" id="mail1_form" name="mail1" id="mail1" value="{{ $eleve->mail1 }}" placeholder="Mail principal"  {{ $flag ?? null}}/>
</div>
<div class="icone-input my-4">
    <i class="fa-sharp fa-solid fa-envelope"></i>
    <input type="email" class="custom-input" id="mail2_form" name="mail2" id="mail2" value="{{ $eleve->mail2 }}" placeholder="Mail secondaire" {{ $flag ?? null}} />
</div>
<div class="icone-input my-4">
    <i class="fa-sharp fa-solid fa-envelope"></i>
    <input type="email" class="custom-input" id="mail3_form" name="mail3" id="mail3" value="{{ $eleve->mail3 }}" placeholder="Mail supplementaire"  {{ $flag ?? null}}/>
</div>
<div class="icone-input my-4">
    <i class="fa-sharp fa-solid fa-envelope"></i>
    <input type="email" class="custom-input" id="mail4_form" name="mail4" id="mail4" value="{{ $eleve->mail4 }}" placeholder="Mail supplementaire" {{ $flag ?? null}} />
</div>






@if (!isset($flag))
<div class="d-flex">
    <button type="button" class="custom_button big submit save_eleve">Sauvegarder</button>

    <button type="button" data-id="new"
        class="custom_button submit remove_eleve delete ms-1">Retirer</button>
</div>
@else
<div class="d-flex">
    <button type="button" class="custom_button big modif_eleve" data-id="{{$eleve->id}}">Modifier la fiche</button>
</div>
@endif



</form>