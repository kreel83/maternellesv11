@extends('layouts.mainMenu2',['titre' => 'Les mots de passe', 'menu' => 'avatar_page'])



@section('content')
<div class="row gx-0 mt-5" id="photos">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('depart')}}">Tableau de bord</a></li>
          <li class="breadcrumb-item"><a href="{{route('enfants',['type' => $type])}}">Liste des enfants</a></li>
          <li class="breadcrumb-item active" aria-current="page">Choix des avatars</li>
        </ol>
      </nav>
    <div class="col-md-6">

        <div style="height: 65vh;" class="d-flex mt-3  flex-column justify-content-center align-items-center">
            {{-- <div data-degrade="b1" class="choixEnfant position-relative border-gradient border-gradient-green" style="background-image: {{$degrades['b1']}}">
                <div class="curved-text position-absolute" ></div>
                <div class="imageAnimaux position-absolute" style="top:0;left:0;right:0;bottom:0; z-index:5000"></div>

            </div> --}}

            <div id="eleveCard" style="" data-enfant="{{$enfant->id}}" class="position-relative">
                <span class="help position-absolute" data-id="6"><i class="fa-light fa-message-question"></i></span>
                @include('cards.enfant',['type' => 'none'])

            </div>
          
            {{-- <div id="eleve_choisi" class="mt-3" style="color: {{$degrades['b1']}}">

            </div> --}}
        </div>
    </div>
    <div class="col-md-6">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item " role="presentation">
              <button class="nav-link active" id="animaux-tab" data-bs-toggle="tab" data-bs-target="#animaux-tab-pane" type="button" role="tab" aria-controls="animaux-tab-pane" aria-selected="true">Figurines</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link btn_fond" id="fonds-tab" data-bs-toggle="tab" data-bs-target="#fonds-tab-pane" type="button" role="tab" aria-controls="fonds-tab-pane" aria-selected="false">Fonds</button>
            </li>

          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active choix_figurine" id="animaux-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

                <div style="height: calc(100vh - 250px);overflow-y: auto" class="d-flex flex-wrap">
        
                    @foreach ($files as $file)
                        <div class="m-2 degrade animaux"  data-animaux="{{$file}}" style="background-image: {{$degrades['b1']}}">
                            <img src="{{asset('/img/animaux/'.$file)}}" alt="" width="80">
                        
                        </div>
                    @endforeach
                </div>  
            </div>
            <div class="tab-pane fade choix_fond" id="fonds-tab-pane" role="tabpanel" aria-labelledby="fonds-tab" tabindex="0">

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
