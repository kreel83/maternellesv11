@extends('layouts.mainMenu',['titre' => 'Les mots de passe', 'menu' => 'mdp'])



@section('content')
<div class="row">
    <div class="col-md-6">
        <select class="form-select w-50 " id="choix_enfant_select" style="margin: 0 auto">
            <option value="null">Selectionnez un élève</option>
            @foreach($eleves as $key => $eleve)
                <option value="{{$eleve->id}}"class="eleve prenom" data-enfant="{{$eleve->id}}" data-prenom="{{$eleve->prenom}}">{{$eleve->prenom}} {{substr(ucfirst($eleve->nom),0,1)}}.</option>
            @endforeach
        </select>
        <div style="height: 65vh;" class="d-flex mt-3  flex-column justify-content-center align-items-center">
            <div data-degrade="b1" class="choixEnfant position-relative border-gradient border-gradient-green" style="background-image: {{$degrades['b1']}}">
                <div class="curved-text position-absolute" ></div>
                <div class="imageAnimaux position-absolute" style="top:0;left:0;right:0;bottom:0; z-index:5000"></div>

            </div>
            <div id="eleve_choisi" class="mt-3" style="color: {{$degrades['b1']}}">

            </div>
        </div>
    </div>
    <div class="col-md-6">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="animaux-tab" data-bs-toggle="tab" data-bs-target="#animaux-tab-pane" type="button" role="tab" aria-controls="animaux-tab-pane" aria-selected="true">Figurines</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="fonds-tab" data-bs-toggle="tab" data-bs-target="#fonds-tab-pane" type="button" role="tab" aria-controls="fonds-tab-pane" aria-selected="false">Fonds</button>
            </li>

          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="animaux-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

                <div style="height: calc(100vh - 250px);overflow-y: auto" class="d-flex flex-wrap">
        
                    @foreach ($files as $file)
                        <div class="m-2 degrade animaux"  data-animaux="{{$file}}" style="background-image: {{$degrades['b1']}}">
                            <img src="{{asset('/img/animaux/'.$file)}}" alt="" width="80">
                        
                        </div>
                    @endforeach
                </div>  
            </div>
            <div class="tab-pane fade" id="fonds-tab-pane" role="tabpanel" aria-labelledby="fonds-tab" tabindex="0">

                <div style="height: auto;overflow-y: auto" class="d-flex flex-wrap">
        
                    @foreach ($degrades as $key=>$degrade)
                        <div class="degrade choixDegrade m-2" data-id="{{$key}}" style="background-image: {{$degrade}}"></div>
                    @endforeach
                </div>  
    
            </div>

          </div>
    </div>


</div>


<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div role="alert" aria-live="assertive" aria-atomic="true" class="toast" data-bs-autohide="false" id="myToast">
        <div class="toast-header">

            <strong class="me-auto">Yes !</strong>

            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Un elève a un nouveau profil
        </div>
    </div>
</div>
@endsection
