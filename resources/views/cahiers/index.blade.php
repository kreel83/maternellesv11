@extends('layouts.mainMenu', ['title' => 'Mon cahier de réussite', 'menu' => 'classe'])

@section('content')
    @php
        $degrades = App\Models\Enfant::DEGRADE;
    @endphp

    <div id="cahierView" class="row px-5 gx-0" data-enfant="{{ $enfant->id }}">
        <div data-section="{{ $section->id }}" class="liste_section mb-5">
            <div class="section_container">
                @if ($enfant->background)
                    <div class="m-2 degrade_card_enfant animaux little"
                        style="background-image: {{ $degrades[$enfant->background] }}">
                        <img src="{{ asset('/img/animaux/' . $enfant->photo) }}" alt="" width="60">

                    </div>
                @else
                    <img src="{{ asset($enfant->photoEleve) }}" alt="rover" width="60" />
                @endif
                <div class="ms-1 me-5 pt-2" style="font-size: 14px">
                    <div>{{ $enfant->prenom }} {{ substr($enfant->nom, 0, 1) }}</div>
                    <div>Cahier de réussite</div>
                    <div> {{ $title }}</div>
                </div>
                @foreach ($sections as $sec)
                    <div class="d-flex flex-column align-items-center">
                        <div class='sectionCahier selectSectionFiche {{ $sec->id == $section->id ? 'selected' : null }}'
                            data-value="{{ $sec->id }}" data-section="{{ $sec->id }}" data-titre="{{$sec->name}}"
                            data-textes="{{ isset($textes[$sec->id]) ? $textes[$sec->id] : null }}"
                            data-phrases="@include('include.card_phrases', ['section' => $sec])" style="background-color: {{ $sec->color }}">
                            <img src="{{ asset('img/illustrations/' . $sec->logo) }}" alt="" width="45px"
                                height="45px">
                        </div>
                        <div class="tiret_selection {{ $sec->id == $section->id ? null : 'd-none' }}"
                            data-id="{{ $sec->id }}" style="background-color: {{ $sec->color }}"></div>
                    </div>
                @endforeach
                <div class="d-flex flex-column align-items-center" style="border-left: 1px solid lightgray">
                    <div class='sectionCahier selectSectionFiche' data-section="carnet" data-value="carnet" id="nav-carnet"
                        data-textes="{{ isset($textes['carnet']) ? $textes['carnet'] : null }}"
                        style="background-color: red">
                        <img src="{{ asset('img/illustrations/commentaires.png') }}" alt="" width="90px"
                            height="45px">
                    </div>
                    <div class="tiret_selection d-none" data-id="carnet" style="background-color: red"></div>
                </div>
                <div class="d-flex flex-column align-items-center" style="border-left: 1px solid lightgray">
                    <div class='sectionApercu selectSectionFiche' data-section="cahier" data-value="cahier" id="nav-cahier"
                        style="background-color: brown">
                        <img src="{{ asset('img/illustrations/cahier.png') }}" alt="" width="120px"
                            height="120px">
                    </div>
                    <div class="tiret_selection d-none" data-id="cahier" style="background-color: brown"></div>
                </div>
            </div>
            <div id="SectionName">
                {{$sections[0]->name}}
            </div>

        </div>




        <div class="bas d-flex flex-column blocApercu d-none">
            <div class="d-flex w-50 justify-content-between align-items-center mb-4">


               
                <div class="form-check form-switch position-relative">
                    <input {{($definitif == 1) ? "checked" : null }} class="form-check-input"
                        type="checkbox" id="definitif" data-enfant="{{$enfant->id}}" >
                    <div class="form-check-label labelDefinitif" for="definitif">Définitif</div>
                </div>
                    <a target="_blank" href="{{route('seepdf',['id' => $enfant->id,'state' => 'see'])}}" data-enfant="{{$enfant->id}}"
                    class="btnSelection violet {{$definitif == 0 ? 'd-none' : null}}" id="pdf" style="margin-top: 0 !important">Voir le PDF</a>
                    <button data-enfant="{{$enfant->id}}" class="btn btn-sm btn-primary" id="reformuler">Reformuler</button>
                    {{-- <a target="_blank" href="{{route('seepdf',['id' => $enfant->id, 'state' => 'save'])}}" data-enfant="{{$enfant->id}}"
                    class="btn btn-primary" id="pdf">Sauvegarder le PDF</a> --}}


               
            </div>
            <div class="position-relative">

                <div id="editorApercu" data-section="" data-enfant="92" style="height: 400px" class="ql-container ql-snow">

                </div>                
            </div>  
        </div>

        <style>
            .tab-content {
                min-height: calc(100vh-200px)
            }
        </style>
        <div class="bas d-flex blocSelectFiche">
            <div class="col-md-6 pe-3">

                <style>
                    .cadre_activitees_acquises {
                        margin: 10px 0; border-radius: 15px;border: 3px solid #7769FE; padding: 4px; height: 100px; overflow-Y: auto;
                    }
                </style>
                <div class="tab-content" id="nav-tabContent" style="margin-bottom: 20px">

                    @foreach ($sections as $key => $sec)
                        <div style="margin-bottom: 20px" class="tab-pane fade {{ $key == 0 ? 'show active' : null }}"
                            data-id="nav-{{ $sec->id }}" id="nav-{{ $sec->id }}" role="tabpanel"
                            aria-labelledby="nav-home-tab">
                            <small>Les activitées acquises</small>
                            <div class="cadre_activitees_acquises">
                                @include('include.card_phrases', ['section' => $sec])
                            </div>
                        </div>
                    @endforeach
                    <div style="margin-bottom: 20px" class="tab-pane fade" data-id="nav-carnet" id="nav-carnet" role="tabpanel"
                        aria-labelledby="nav-carnet-tab">
                        <div style="margin: 10px 0;padding: 4px; height: 50px; overflow-Y: auto" id="carnetContainer">
                            <h4>Commentaire général
                                @if ($isChrome)
                                    <span class="ms-5" id="record" role="button">
                                        <i class="fa-solid fa-microphone-slash"></i>
                                    </span>
                                @endif
                            </h4>

                        </div>
                    </div>

                    <style>
                        .saved {
                            color:green;
                        }
                        .saving {
                            color:grey;
                        }
                        #btnSaveEditor {
                            position: absolute; right: 8px; top: 30px;
                            width: 30px;
                            height: 30px;
                            border-radius: 50%;
                            background-color: white;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            font-size: 20px;
                            
                        }
                    </style>

                    <div class="position-relative w-100">
                        <button data-section="{{ $section->id }}" data-enfant="{{ $enfant->id }}"
                            data-periode="{{ $periode }}" id="btnSaveEditor" style=""
                            class="btn saveTexte saved"><i class="fa-solid fa-floppy-disk"></i></button>
                            <small>Commentaires complémentaires</small>
                        <div id="editor" data-enfant="{{ $enfant->id }}" style="height: 300px; top:0; left:0">
                            {!! $textes[$section->id] ?? '' !!}
                        </div>
                    </div>



                </div>

                {{-- <a class="btn btn-outline-primary" href="{{ route('editerPDF', ['enfant' => $enfant->id]) }}">Editer le cahier
                    de réussite</a> --}}
                
            </div>



            <div class="col-md-6">


                <div class="badge_phrase_container">
                    @include('cahiers.liste_phrases')
                </div>


            </div>
        </div>


    </div>
@endsection
