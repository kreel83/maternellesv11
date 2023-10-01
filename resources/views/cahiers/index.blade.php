@extends('layouts.mainMenu2', ['title' => 'Mon cahier de réussite', 'menu' => 'classe'])

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

    <div id="cahierView" class="row px-5 gx-0 position-relative" data-enfant="{{ $enfant->id }}">
        @if ($enfant->genre == 'F')
        <div class="progress-container position-absolute d-none">
            <div class="progress" style="width: 100%">
                <div class="progress-bar  bg-success active" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
            </div>            
        </div>
        @endif

        <div data-section="{{ $section->id }}" class="liste_section m-0 d-flex w-100">

            
            <div class="d-flex justify-content-between align-items-center my-5">
                <div class="enfant_pill d-flex ps-0 ">
                    
                        @if ($enfant->background)
                        <div class="m-2 degrade_card_enfant animaux little" data-enfant="{{$enfant->id}}"
                            style="background-image: {{ $degrades[$enfant->background] }}">
                            <img src="{{ asset('/img/animaux/' . $enfant->photo) }}" alt="" width="60">
                        </div>
                    @else
                        <img src="{{ asset($enfant->photoEleve) }}" alt="rover" width="60" />
                    @endif
                    <div class="ms-1 ms-2 pt-2" style="font-size: 14px">
                        <div  style="font-size: 24px;font-weight: bolder; color: {{$enfant->genre == 'F' ? 'var(--pink)' : 'var(--blue)'}}">{{ $enfant->prenom }} {{ substr($enfant->nom, 0, 1) }}</div>
                        <div>Cahier de réussite | {{ $title }}</div>
                        
                    </div>
                    
                </div>
                <div>
                    <div class="section_container">

                        <div class="d-flex flex-column">
                            <div class="d-flex">
                                @foreach ($sections as $sec)
                                    <div class="d-flex flex-column align-items-center">
                                        <div class='sectionCahier selectSectionFiche {{ $sec->id == $section->id ? 'selected' : null }}'
                                            data-value="{{ $sec->id }}" data-section="{{ $sec->id }}"
                                            data-titre="{{ $sec->name }}"
                                            data-textes="{{ isset($textes[$sec->id]) ? $textes[$sec->id] : null }}"
                                            data-phrases="@include('include.card_phrases', ['section' => $sec])" style="background-color: {{ $sec->color }}">
                                            <img src="{{ asset('img/illustrations/' . $sec->logo) }}" alt="" width="45px"
                                                height="45px">
                                        </div>
                                        <div class="tiret_selection {{ $sec->id == $section->id ? null : 'd-none' }}"
                                            data-id="{{ $sec->id }}" style="background-color: {{ $sec->color }}">
                                        </div>
                                    </div>
                                
                                @endforeach
                                <div class="d-flex flex-column align-items-center" style="border-left: 1px solid lightgray">
                                    <div class='sectionApercu selectSectionFiche' data-section="cahier" data-value="cahier" id="nav-cahier"
                                        style="background-color: brown">
                                        <img src="{{ asset('img/illustrations/cahier.png') }}" alt="" width="120px"
                                            height="120px">
                                    </div>
                                    <div class="tiret_selection d-none" data-id="cahier" style="background-color: brown"></div>
                                </div>                   
                            </div>
                </div>
            </div>
            

                   
                </div>

            </div>

        </div>

        <div class="bas d-flex flex-column blocApercu d-none">
            <div class="mb-4 titreSection"></div>
            <div class="d-flex w-50 justify-content-center align-items-center mb-4 w-100 position-relative">



                <div class="form-check form-switch position-relative">
                    <div class="form-check-label labelDefinitif labelDefinitifGauche {{$definitif == 0 ? 'active' : null}}" for="definitif">Modifier le PDF</div>
                    <input {{ $definitif == 1 ? 'checked' : null }} class="form-check-input" type="checkbox" id="definitif"
                        data-enfant="{{ $enfant->id }}">
                    <div class="form-check-label labelDefinitif labelDefinitifDroit {{$definitif == 1 ? 'active' : null}}" for="definitif">Finaliser le PDF</div>
                </div>
                <a target="_blank" href="{{ route('seepdf', ['id' => $enfant->id, 'state' => 'see']) }}"
                    data-enfant="{{ $enfant->id }}" class="btnSelection violet {{ $definitif == 0 ? 'd-none' : null }}"
                    id="pdf" style="margin-top: 0 !important">Voir le PDF</a>
                <div 
                    data-enfant="{{ $enfant->id }}" class="btnSelection violet {{ $definitif == 1 ? 'd-none' : null }}"
                    id="reactualiser" style="margin-top: 0 !important">Réactualiser le texte</div>
                {{-- <button data-enfant="{{ $enfant->id }}" class="btn btn-sm btn-primary"
                    id="reformuler">Reformuler</button> --}}
                {{-- <a target="_blank" href="{{route('seepdf',['id' => $enfant->id, 'state' => 'save'])}}" data-enfant="{{$enfant->id}}"
                    class="btn btn-primary" id="pdf">Sauvegarder le PDF</a> --}}



            </div>
            <div class="position-relative">

                <div id="editorApercu" data-section="" data-enfant="{{$enfant->id}}" style="height: 400px" class="ql-container ql-snow">

                </div>
            </div>
        </div>

        <style>
            .tab-content {
                min-height: calc(100vh-200px)
            }
        </style>

        <div class="bas blocSelectFiche w-100">
            <div  class="mb-4 titreSection">Mobiliser le langage dans toutes les dimensions : l'oral</div>
            <div class="tab-content" id="nav-tabContent" style="margin-bottom: 20px">

                        @foreach ($sections as $key => $sec)
                            <div style="margin-bottom: 20px"
                                class="section_container tab-pane fade {{ $key == 0 ? 'show active' : null }}"
                                data-id="nav-{{ $sec->id }}" id="nav-{{ $sec->id }}" role="tabpanel"
                                aria-labelledby="nav-home-tab">

                                <div class="row">
                                    <div class="col-md-6 pe-3">
                                        @if ($sec->id != 99)
                                        <div class="cadre_activites_acquises position-relative">
                                            <div class="position-absolute titreInsideCahier">Les activitées acquises</div>
                                            <div class="phraseInsideCahier">
                                                @include('include.card_phrases', ['section' => $sec])
                                            </div> 
                                        </div>
                                        @endif
                                        <div class="position-relative w-100 mt-5">
                                            
                                            <div class="cadre_commentaire_complementaire position-relative" data-enfant="{{ $enfant->id }}">
                                                <div class="position-absolute titreInsideCahier">Commentaires complémentaires</div>
                                                <div class="phraseInsideCahier">
                                                @include('include.card_phrases_pre', ['section' => $sec])
                                                </div>
                                            </div>
                                        </div>
                                    
                                    </div>
                                    <div class="col-md-6 partieDroite">
                                        <div class="input-group my-3">
                                            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
                                            <input type="text" class="form-control searchPhrase" placeholder="Chercher une phrase" aria-label="Chercher un élève" aria-describedby="basic-addon1">
                                            <span class="input-group-text raz_search_phrase" style="cursor: pointer"><i class="fa-sharp fa-solid fa-xmark"></i></span>
                                          </div>
                                        {{-- <input type="text" class="form-control input-sm w-25 searchPhrase"> --}}
                                        <div class="badge_phrase_container" data-id="{{ $enfant->id }}">
                                            @include('cahiers.liste_phrases')
                                        </div>             
                
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>








                {{-- <a class="btn btn-outline-primary" href="{{ route('editerPDF', ['enfant' => $enfant->id]) }}">Editer le cahier
                    de réussite</a> --}}


        </div>
    </div>


<!-- Modal -->
<div class="modal fade" id="informationPDF" tabindex="-1" aria-labelledby="informationPDF" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Information importante</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Vous allez entrer dans la page de génération du PDF.
          Cette génération va se faire avec les phrases pré-ecrites que vous avez sélectionner,
          ainsi que les phrases qui emmanent des fiches que l'élève a acquis.
          Assurez-vous que toutes les activité acquises par l'élève sont bien notifiées.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Je vérifie d'abord</button>
          <button type="button" class="btn btn-primary" id="CommitGeneratePDF">J'ai compris</button>
        </div>
      </div>
    </div>
  </div>

@endsection
