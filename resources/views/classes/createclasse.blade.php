@extends('layouts.mainMenu2',['titre' => 'Ma classe', 'menu' => 'createClasse'])



@php
    // dd($resultats);
@endphp

@section('content')
<div class="mt-5 container card p-5 w-50 ">
    <form action="{{ route('saveNewClasse') }}" method="post">
        @csrf

    
      <h4 class="my-3 text-center">Creation d'une classe</h4>
    <div class="form-group mb-3">
        <label for="">Code de l'école</label>
        <input type="text" class="form-control w-25" name="ecole">
    </div>
    <div class="form-group mb-3">
        <label for="">Nom de la classe</label>
        <input type="text" class="form-control" name="description">
    </div>
    <div class="form-group mb-3 d-flex justify-content-center">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="ps" name="section[]">
            <label class="form-check-label" for="inlineCheckbox1">PS</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="ms" name="section[]">
            <label class="form-check-label" for="inlineCheckbox2">MS</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="gs" name="section[]">
            <label class="form-check-label" for="inlineCheckbox3">GS</label>
          </div>
        </div>
        <button class="btnAction mx-auto" type="submit">Sauvegarder la classe</button>

</form>
</div>
@endsection
