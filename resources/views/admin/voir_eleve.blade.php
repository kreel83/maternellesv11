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

            <div class="d-flex justify-content-center align-middle">
                <div class="me-4">
                    @if($eleve->genre == 'F')
                        <div class="avatar avatar_form pink selected" data-genre="F"><i class="fa-thin fa-user-tie-hair-long"></i></div>
                    @else
                        <div class="avatar avatar_form blue selected" data-genre="G"><i class="fa-thin fa-user-tie-hair"></i></div>
                    @endif
                </div>
                <div>
                    <h4 class="text-center">{{ $eleve->prenom.' '.$eleve->nom }}</h4>

                    <div class="text-center">                                       
                        {{ $eleve->age }}
                    </div>
                </div>
            </div>

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
                                <a href="{{ route('admin.voirClasse', ['user_id' => $eleve->user_id]) }}" class="btn btn-primary" role="button">Quitter</a>
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
