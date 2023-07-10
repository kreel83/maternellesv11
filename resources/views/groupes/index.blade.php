@extends('layouts.mainMenu', ['titre' => "Les groupes d'élèves",'menu' => 'groupe'])

@section('content')
<div id="page_groupes" class="row p-2">
        
<h1>les groupes</h1>



<div class="form-group">
    <label for="">Methode</label>
    <select name="" id="" class="form-select">
        <option value="null" selected disabled>Veuillez selectionner</option>
        <option value="couleur">Par couleur</option>
        <option value="couleur">Par mot</option>
    </select>
    <button class="btn btn-primary mt-5">Ajouter un groupe</button>
    <div class="mt-3">
        <div>
            <div>1er groupe</div>
            <div><button class="btn btn-success btn-sm">Choisir une couleur</button></div>
            <div>
                @foreach(App\Models\Enfant::GROUPE_COLORS as $key => $color)
                    <div style="width: 80px; height: 40px; background-color: {{$color}}; margin: 12px 0"></div>
                @endforeach                
            </div>

        </div>
    </div>
</div>



 
</div>


@endsection