@extends('layouts.mainMenu2',['titre' => 'Ma classe', 'menu' => 'createClasse'])



@php
    // dd($resultats);
@endphp

@section('content')
<div class="mt-5 container">
    <form action="{{ route('saveNewClasse') }}" method="post">
        @csrf

    

    <div class="form-group">
        <label for="">Code de l'école</label>
        <input type="text" class="form-control" name="ecole">
    </div>
    <div class="form-group">
        <label for="">Nom de la classe</label>
        <input type="text" class="form-control" name="description">
    </div>
    <div class="form-group">
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
        <button class="btn btn-primary" type="submit">Sauvegarder la classe</button>

</form>
</div>
@endsection
