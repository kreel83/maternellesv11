@extends('layouts.mainMenu')

@section('content')
    <h1>Apercu et édition du cahier de réussite</h1>


    <div style="margin-bottom: 20px" id="nav-apercu" data-reussite="{{$reussite}}"
         >
        <div class="d-flex w-100 justify-content-between align-items-center">
            <button data-section="apercu" data-enfant="{{$enfant->id}}"
                    style="margin-top: 20px" class="btn btn-dark saveTexteReussite">Sauvegarder
            </button>
            <a target="_blank" href="{{route('seepdf',['id' => $enfant->id])}}" data-enfant="{{$enfant->id}}"
               class="btn btn-primary" id="pdf">Voir le pdf</a>
            <div class="form-check form-switch">


                <input {{($definitif == 1) ? "checked" : null }} class="form-check-input"
                       type="checkbox" id="definitif" data-enfant="{{$enfant->id}}" >
                <label class="form-check-label" for="definitif">Définitif</label>
            </div>
        </div>
        <div id="editor" data-section="" data-enfant="92" style="height: 400px" class="ql-container ql-snow">

        </div>
    </div>
@endsection
