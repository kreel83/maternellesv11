@extends('layouts.mainMenu2', ['title' => 'Mon cahier de réussite', 'menu' => 'reussite'])

@section('content')
    @php
        $degrades = App\Models\Enfant::DEGRADE;
    @endphp

    <style>
        .progress-container {
            width: 600px;
            height: 150px;
           
            display: flex;
            justify-content: start;
            
            align-items: center;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            z-index: 6000;
            padding: 0 25px;                      

        }

    </style>

    <div id="cahierView" class="row gx-0 position-relative mt-5" data-enfant="{{ $enfant->id }}">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('depart')}}">Tableau de bord</a></li>
              <li class="breadcrumb-item"><a href="{{route('enfants',['type' => $type])}}">Liste des enfants</a></li>
              <li class="breadcrumb-item active" aria-current="page">Réussite</li>
            </ol>
          </nav>
        @if ($enfant->genre == 'F')
        <div class="progress-container position-absolute d-none">
            <div class="progress" style="width: 100%">
                <div class="progress-bar  bg-success active" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
            </div>            
        </div>
        @endif

        <div class="liste_section m-0 d-flex justify-content-center">

            
            <div class="d-flex justify-content-center mt-2 mb-5 align-items-center">
                <div class="enfant_pill d-flex ps-0 align-items-center ps-3">
                    <div class="arrowLeft" style="font-size: 30px">
                        <a href="{{ route('enfants',['type' => $type]) }}">
                            <i class="fa-solid fa-arrow-left"></i>
                        </a>
                    </div>
                    @if ($enfant->background)
                        <div class="m-2 degrade_card_enfant animaux little" data-enfant="{{$enfant->id}}"
                            style="background-image: {{ $degrades[$enfant->background] }}">
                            <img src="{{ asset('/img/animaux/' . $enfant->photo) }}" alt="" width="60">
                        </div>                   
                    @endif
                    <div class="ms-1 ms-2 pt-2" style="font-size: 14px">
                        <div  style="font-size: 24px;font-weight: bolder; color: {{$enfant->genre == 'F' ? 'var(--pink)' : 'var(--blue)'}}">{{ $enfant->prenom }} <span class="{{ env('App_DEMO') ? 'blur' : null}}">{{ $enfant->nom }}</span></div>
                        <div>Cahier de réussite | {{ $title }}</div>                                                                  
                    </div>
                    

                    
                </div>
            </div>
        </div>



              
                    {{-- <div class="section_container flex-wrap justify-content-center align-items-end">

                        <style>

                        </style>
                           
                                @foreach ($sections as $sec)
                                @if ($sec->id == 9 && Auth::user()->classe_active()->desactive_devenir_eleve == 1)
                                @else
                                    <div class="d-flex flex-column align-items-center">

                                        <div class='sectionCahier selectSectionFiche'
                                            title="{{$sec->name}}"
                                            data-value="{{ $sec->id }}" data-section="{{ $sec->id }}"
                                            data-titre="{{ $sec->name }}"
                                            data-textes="{{ isset($textes[$sec->id]) ? $textes[$sec->id] : null }}"
                                            data-phrases="" style="background-color: {{ $sec->color }}">
                                            <img src="{{ asset('img/illustrations/' . $sec->logo) }}" alt="" width="45px"
                                                height="45px" >
                                            </div>
                                            @if ($sec->id == 99)
                                            <div class="petit_texte" style="color: {{$sec->color}}">Général</div>
                                            @else
                                            <div class="petit_texte" style="color: {{$sec->color}}">{{$sec->icone}}</div>
                                            @endif
                                            
                                            
                                        </div>
                                        @endif
                                        
                                        @endforeach
                                        

                                </div>   
                            
                      
                    </div>  --}}
            



        


        
        <div class="d-flex justify-content-center flex-column" >
            <div class="d-flex justify-content-center mx-auto">
                <div class="form-check form-switch mt-2 ">
                    <input class="form-check-input seePdf" type="checkbox" id="seePdf1" {{ $reussite->definitif == 1 ? "checked" : null}} data-reussite="{{$reussite->id}}">
                    <label class="form-check-label" for="seePdf1">Prét à l'envoi</label>
                </div> 
                <div style="font-size: 25px; color: rgb(244, 112, 112); cursor: pointer" class="{{$reussite->definitif == 0 ? 'd-none' : null}} ms-5 definitifPDF">
                    <a target="_blank" href="/app/enfants/cahier/apercu/0/{{$enfant->id}}/{{$enfant->periode}}"><i class="fa-solid fa-file-pdf"></i></a>
                </div>  
            </div>
            @foreach ($sections as $sec)
                @if ($sec->id == 9 && session('classe_active')->desactive_devenir_eleve == 1)
                @else
                <div class="position-relative my-5 mx-auto">
                    
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('img/illustrations/' . $sec->logo) }}" alt="" width="45px"
                        height="45px" >
                        <div class="d-flex flex-column ms-3">
                            
                            <div style="color: {{$sec->color}}; font-size: 18px">
                                {{$sec->name}}
                            </div>
                            <div class="row">
                                @if (isset($commentaires[$sec->id]))
                                <div class="col-auto">
                                    <label for="" style="font-size: 12px">Phrases prédéfinies : </label>
                                </div>
                                <div class="col-auto">
                                    <select name="" id="" class="selectionCommentaire form-control form-control-sm" data-prenom="{{$enfant->prenom}}" data-genre="{{$enfant->genre}}" data-section="{{$sec->id}}" style="width: 300px; font-size: 12px">
                                        <option value="null">Veuillez selectionner</option>
                                        @foreach ($commentaires[$sec->id] as $commentaire)
                                        
                                        <option value="{{$commentaire->phrase_masculin}}">{{$commentaire->phrase_masculin}}</option>
                                        @endforeach
                                        
                                    </select>                                
                                </div>

                                @endif
                            </div>
                        </div>
                    </div class="position-relative">
                    <div class="position-absolute d-none sauvegarde" data-section="{{$sec->id}}" style="right: 20px; top: 85px">
                        <div style="font-size: 12px; color: green">Sauvegardé </div>
                    </div>
                    <div class="position-absolute d-none saisie" data-section="{{$sec->id}}" style="right: 20px; top: 85px">
                        <div style="font-size: 12px; color: red">Saisie en cours</div>
                    </div>
                    
                    <div id="editorApercu{{$sec->id}}"  data-texte="{{$resultats[$sec->id] ?? null}}" data-section="{{$sec->id}}" data-enfant="{{$enfant->id}}" style="min-height: 100px; height: auto;max-width: 820px" class="ql-container ql-snow editorApercu position-relative">

                    </div>
                    @endif
                @endforeach
                <div class="d-flex justify-content-center mx-auto mt-5">
                    <div class="form-check form-switch mt-2 ">
                        <input class="form-check-input seePdf" type="checkbox" id="seePdf2" {{ $reussite->definitif == 1 ? "checked" : null}} data-reussite="{{$reussite->id}}">
                        <label class="form-check-label" for="seePdf2">Prét à l'envoi</label>
                    </div> 
                    <div style="font-size: 25px; color: rgb(244, 112, 112); cursor: pointer" class="{{$reussite->definitif == 0 ? 'd-none' : null}} ms-5 definitifPDF">
                        <a taget="_blank" href="/app/enfants/cahier/apercu/0/{{$enfant->id}}/{{$enfant->periode}}"><i class="fa-solid fa-file-pdf"></i></a>
                    </div>  
                </div>
        </div>



        <style>
            .tab-content {
                min-height: calc(100vh-200px)
            }
        </style>

    </div>


<!-- Modal -->
<div class="modal fade" id="informationPDF" tabindex="-1" aria-labelledby="informationPDF" aria-hidden="true">
    <div class="modal-dialog" style="top: 200px">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Information importante</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Vous allez entrer dans la page de génération du PDF.<br><br>
          Cette génération va se faire avec les phrases pré-ecrites que vous avez sélectionnées,
          ainsi que les phrases qui emmanent des activités que l'élève a acquis.
          Assurez-vous que toutes les activités acquises par l'élève soient bien notées.<br><br>
          <div class="alert alert-warning">
              La modification ou l'ajout d'une activité acquise entrainera la regénération du cahier de réussite
              et effacera les éventuelles modifications que vous avez faites.  
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Je vérifie d'abord</button>
          <button type="button" class="btn btn-primary" id="CommitGeneratePDF">J'ai compris</button>
        </div>
      </div>
    </div>
  </div>

@endsection
