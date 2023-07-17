@extends('layouts.mainMenu', ['titre' => "Les groupes d'élèves",'menu' => 'groupe'])

@section('content')

<style>
    .rond_couleur {
        width: 80px; height: 80px; 
        border-radius: 50%;
        margin: 4px;
        cursor: pointer;
        display: flex;
        justify-content: center;
        align-items: center;
        color: grey;
        font-size: 60px

    }
    .rond_couleur:hover, .rond_couleur.active {
        outline: 3px solid gray;
    }
</style>
<div class="container">
    <div id="page_groupes" class="row p-2 ">
        <div class="container">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="couleur-tab" data-bs-toggle="tab" data-bs-target="#couleur-tab-pane" type="button" role="tab" aria-controls="couleur-tab-pane" aria-selected="true">Par couleurs</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="termes-tab" data-bs-toggle="tab" data-bs-target="#termes-tab-pane" type="button" role="tab" aria-controls="termes-tab-pane" aria-selected="false">Par termes</button>
                </li>
    
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="couleur-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                    <div class="d-flex flex-wrap w-100 pt-5">
                        @foreach(App\Models\Enfant::GROUPE_COLORS as $key => $color)
                            <div class="rond_couleur" style="background-color: {{$color}}">
                                <span class="order"></span>
                            </div>
                        @endforeach                
                    </div>
                    <div>
                        <button class="btn btn-primary mt-5" id="saveColor">Sauvegarder</button>
                    </div>
                    
                    
                </div>
                <div class="tab-pane fade mt-5" id="termes-tab-pane" role="tabpanel" aria-labelledby="termes-tab" tabindex="0">
                    <textarea  class="form-control" name="" id="termes" cols="10" rows="5">
                        
                    </textarea>
                    <div>
                        <button class="btn btn-primary mt-5" id="saveTermes">Sauvegarder</button>
                    </div>

        
                </div>
    
              </div>


 

    
        </div>
            




    
    </div>    
</div>



@endsection