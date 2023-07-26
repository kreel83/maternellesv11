@extends('layouts.mainMenu', ['titre' => 'Mon cahier de réussite', 'menu' => 'item' ])

@section('content')
<div class="container-fluid row">
<h1 class="text-center">Apercu et édition du cahier de réussite de {{$enfant->prenom}}</h1>

<h3 class="text-center mb-5">
   {{$title}}

</h3>



        <div class="col-md-6" style="margin-bottom: 20px" id="nav-apercu" data-reussite="{{$reussite}}">
        
                <div class="d-flex w-100 justify-content-between align-items-center pb-2">

                    @if ($isreussite)
                        <a target="_blank" href="{{route('seepdf',['id' => $enfant->id,'state' => 'see'])}}" data-enfant="{{$enfant->id}}"
                        class="btn btn-primary" id="pdf">Voir le PDF</a>
                        {{-- <a target="_blank" href="{{route('seepdf',['id' => $enfant->id, 'state' => 'save'])}}" data-enfant="{{$enfant->id}}"
                        class="btn btn-primary" id="pdf">Sauvegarder le PDF</a> --}}


                        <div class="form-check form-switch">
                            <input {{($definitif == 1) ? "checked" : null }} class="form-check-input"
                                type="checkbox" id="definitif" data-enfant="{{$enfant->id}}" >
                            <label class="form-check-label" for="definitif">Définitif</label>
                        </div>
                    @endif
                </div>
                <div class="position-relative">

                    <div id="editor" data-section="" data-enfant="92" style="height: 400px" class="ql-container ql-snow">

                    </div>                
                </div>            
            </div>

        <div class="col-md-6">
            <h4>Commentaire général
                @if ($isChrome)
                <span class="ms-5" id="record" role="button">
                <i class="fa-solid fa-microphone-slash"></i>
                </span>
                @endif
            </h4>
            <select id="phraseCommentaireGeneral" class="form-control  mb-2" mt-4 data-section="99" data-enfant="{{$enfant->id}}">
                <option value="null">Veuillez selectionner</option>

                @if (!$commentaires->isEmpty())
                    @foreach ($commentaires as $phrase)
                            <option value="{{$phrase->texte($enfant)}}">{{$phrase->texte($enfant)}}</option>
                    @endforeach
                    @endif
            </select>
            <textarea id="commentaire_general" data-enfant="92" style="width: 100%" rows="10">{{ $isreussite ? $isreussite->commentaire_general : null}}</textarea>
            <div class="mt-3" id="instruction"></div>
            <button data-section="apercu" data-enfant="{{$enfant->id}}"
                class="btnSelection violet btn-sm" id="saveCommentaireGeneral">Sauvegarder
            </button>
        </div>


</div>

@endsection
