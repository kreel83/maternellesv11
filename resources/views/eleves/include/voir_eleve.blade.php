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

<div class="container">
    <div class="row">
        <div class="col-md-7">

            <h4>Compétences acquises</h4>

            @php
                $section_id = 0;
            @endphp
            <div class="liste_eleves ps-4" style="margin-top: 20px;">

                    @foreach($resultats as $resultat)

                        @if($section_id != $resultat->section_id)
                            <div class="mb-1 mt-3">
                                <img width="40" class="img-fluid" src="{{ asset('img/illustrations/'.$resultat->sectionLogo) }}">
                                <strong>{{ $resultat->sectionName }}</strong>
                            </div>
                            @php
                                $section_id = $resultat->section_id;
                            @endphp
                        @endif

                        <div class="mb-1 ml-5">
                            {{ $resultat->itemName }}
                            @if($resultat->autonome == 1)
                                (autonome)
                            @endif
                        </div>
                        
                    @endforeach


                {{--
                @foreach($sections as $section)
                    <div class="mb-1">
                        <strong>{{ $section->name }}</strong>
                    </div>
                    @foreach($resultats as $resultat)
                        @if($resultat->section_id == $section->id)
                            <div class="mb-1">
                                {{ $resultat->itemName }}
                                @if($resultat->autonome == 1)
                                    (autonome)
                                @endif
                            </div>
                        @endif
                    @endforeach
                @endforeach
                --}}
            </div>

        </div>
        <div class="col-md-4">

            {{--
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item w-50" role="presentation">
                <button class="w-100 nav-link active btnSelectionType violet droit selected" id="import-tab" data-bs-toggle="tab" data-bs-target="#import-tab-pane" type="button" role="tab" aria-controls="import-tab-pane" aria-selected="true">La cours de l'école</button>
                </li>
                <li class="nav-item w-50" role="presentation">
                <button class="w-100 nav-link btnSelectionType violet droit" id="create-tab" data-bs-toggle="tab" data-bs-target="#create-tab-pane" type="button" role="tab" aria-controls="create-tab-pane" aria-selected="false">Nouvel élève</button>
                </li>

            </ul>
            --}}

            <div class="tab-content_" id="myTabContent_">

                {{--
                <div class="tab-pane fade show active pt-3" id="import-tab-pane" role="tabpanel" aria-labelledby="import-tab" tabindex="0">
                    <div class="d-flex flex-column">
                        <label for="">La classe du maitre ou la maitresse de l'année dernière</label>
                        <select name="" id="selectProf" class="custom-select">
                            <option value="null" selected>Tous les enfants</option>
                            @foreach ($profs as $prof)
                            <option value="{{$prof->id}}">{{$prof->nom_complet()}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="import_eleves_container"   id="tableau_tous">
                        @include('eleves.include.tableau_tous')                            
                    </div>
                </div>
                --}}

                <!--<div class="tab-pane fade" id="create-tab-pane" role="tabpanel" aria-labelledby="import-tab" tabindex="0">-->

                    <form action="{{route('save_eleve')}}" method="post" enctype="multipart/form-data" style="font-size: 12px; padding-top: 10px;">
                    @csrf
            
                        <input type="hidden" id="eleve_form" name="id" value="{{ $eleve->id }}" />
                        <input type="hidden" id="genre" name="genre" value="{{ $eleve->genre }}" />
                        
                        @php
                            $selectedF = ($eleve->genre == 'F') ? "selected" : '';
                            $selectedG = ($eleve->genre == 'G') ? "selected" : '';
                            $readonly = ($role == 'admin') ? 'readonly' : '';
                        @endphp

                        @if($role == 'user')
                            <div class="d-flex justify-content-center">
                                <div class="avatar avatar_form pink me-5 {{$selectedF}}" data-genre="F"><i class="fa-thin fa-user-tie-hair-long"></i></div>
                                <div class="avatar avatar_form blue {{$selectedG}}" data-genre="G"><i class="fa-thin fa-user-tie-hair"></i></div>
                            </div>
                        @else
                            <div class="d-flex justify-content-center">
                                @if($eleve->genre == 'F')
                                    <div class="avatar avatar_form pink {{$selectedF}}" data-genre="F"><i class="fa-thin fa-user-tie-hair-long"></i></div>
                                @else
                                    <div class="avatar avatar_form blue {{$selectedG}}" data-genre="G"><i class="fa-thin fa-user-tie-hair"></i></div>
                                @endif
                            </div>
                        @endif

                        <div class="icone-input my-4">
                            <i class="fa-solid fa-user"></i>
                            <input type="text" class="custom-input" id="nom_form" name="nom" value="{{ $eleve->nom }}" placeholder="Nom de l'élève" {{$readonly}} />
                        </div>    
                        <div class="icone-input my-4">
                            <i class="fa-solid fa-user"></i>
                            <input type="text" class="custom-input" id="prenom_form" name="prenom" value="{{ $eleve->prenom }}" placeholder="Prénom de l'élève" {{$readonly}} />
                        </div>    
                        <div class="icone-input my-4">
                            <i class="fa-solid fa-cake-candles"></i>
                            <input type="date" class="custom-input" id="ddn_form" name="ddn" value="{{ $eleve->ddn }}" placeholder="Date de naissance de l'élève" {{$readonly}} />
                        </div>    
                        <div class="custom-area">                                       
                            <textarea type="date" class="custom-input" id="commentaire_form" name="comment" placeholder="Commentaire" {{$readonly}}>{{ $eleve->comment }}</textarea>
                        </div>
                        
                        <div class="icone-input my-4">
                            <i class="fa-sharp fa-solid fa-envelope"></i>
                            <input type="email" class="custom-input" id="mail1_form" name="mail[]" value="{{ $eleve->mail1 }}" placeholder="Mail principal" {{$readonly}} />
                        </div>    
                        <div class="icone-input my-4">
                            <i class="fa-sharp fa-solid fa-envelope"></i>
                            <input type="email" class="custom-input" id="mail2_form" name="mail[]" value="{{ $eleve->mail2 }}" placeholder="Mail secondaire" {{$readonly}} />
                        </div>    
        
                        @if($role == 'user')
                            <div class="d-flex">
                                <button type="submit" class="custom_button big submit">Sauvegarder</button>
                                <a href="{{ route('depart') }}" class="btn btn-info" role="button">Retour</a>
                                {{--<button type="button" data-id="new" class="custom_button submit remove_eleve delete ms-1">Retirer</button>--}}
                            </div>
                        @elseif($role == 'admin')
                            <div class="row">
                                @if(empty($user_id))
                                    {{-- on vient d'une recherche par nom / prenom --}}
                                    <a href="{{ route('admin.index') }}" class="btn btn-primary" role="button">Quitter</a>
                                @else
                                    {{-- on vient depuis clic dans la classe --}}
                                    <a href="{{ route('admin.voirClasse', ['id' => $user_id]) }}" class="btn btn-primary" role="button">Quitter</a>
                                @endif
                                
                            </div>
                        @endif

                    </form>
        
                <!--</div>-->

            </div>
        </div>


    

        
    </div>    
</div>