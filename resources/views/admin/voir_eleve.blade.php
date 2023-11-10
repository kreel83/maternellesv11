@extends('layouts.admin', ['titre' => 'Bienvenue sur votre espace administration', 'menu' => 'dashboard'])

@section('content')

{{-- @include('eleves.include.voir_eleve') --}}

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
        
        <div class="col-md-6">

            <div>

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
                        
                        @php
                            /*
                            dd($eleve);
                            $mail = explode(';', $eleve->mail);
                            $mail1 = (!empty($mail[0])) ? $mail[0] : '';
                            $mail2 = (!empty($mail[1])) ? $mail[1] : '';
                            */
                        @endphp

                        <div class="icone-input my-4">
                            <i class="fa-sharp fa-solid fa-envelope"></i>
                            <input type="email" class="custom-input" id="mail1_form" name="mail[]" value="{{ $eleve->mail1 }}" placeholder="Mail principal" {{$readonly}} />
                        </div>    
                        <div class="icone-input my-4">
                            <i class="fa-sharp fa-solid fa-envelope"></i>
                            <input type="email" class="custom-input" id="mail2_form" name="mail[]" value="{{ $eleve->mail2 }}" placeholder="Mail secondaire" {{$readonly}} />
                        </div>
                        <div class="icone-input my-4">
                            <i class="fa-sharp fa-solid fa-envelope"></i>
                            <input type="email" class="custom-input" id="mail3_form" name="mail[]" value="{{ $eleve->mail3 }}" placeholder="Mail complémentaire" {{$readonly}} />
                        </div>
                        <div class="icone-input my-4">
                            <i class="fa-sharp fa-solid fa-envelope"></i>
                            <input type="email" class="custom-input" id="mail4_form" name="mail[]" value="{{ $eleve->mail4 }}" placeholder="Mail complémentaire" {{$readonly}} />
                        </div>
        

                        <div class="row">
                            @if($source == 'search')
                                {{-- on vient d'une recherche par nom / prenom --}}
                                <a href="{{ route('admin.index') }}" class="btn btn-primary" role="button">Quitter</a>
                            @else
                                {{-- on vient depuis clic dans la classe --}}
                                <a href="{{ route('admin.voirClasse', ['id' => $eleve->user_id]) }}" class="btn btn-primary" role="button">Quitter</a>
                            @endif
                            
                        </div>

                    </form>
        
                <!--</div>-->

            </div>
        </div>

        <div class="col-md-6">

            <h3 class="text-center">Compétences acquises</h3>

            @php
                $section_id = 0;
            @endphp
            <div class="liste_eleves ps-4" style="margin-top: 20px; border:1px solid #808080">

                @if(!$resultats->isEmpty())

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

                @else

                    <div class="mt-3">
                        Aucune compétences acquises.
                    </div>

                @endif

            </div>

        </div>
        
    </div>    
</div>

@endsection
