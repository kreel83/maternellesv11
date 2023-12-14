@extends('layouts.mainMenu2',['titre' => 'Ma classe', 'menu' => 'eleve'])

<style>
    .avatar_form {
        width: 60px;
        height: 60px;
        border: 3px solid transparent;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer
    }  
    .avatar.pink.selected {
        border-color: pink;
    }    
    .avatar.blue.selected {
        border-color: lightblue;
    }
    .avatar {
        font-size: 40px;
    }
    
    .avatar.pink {
        color: lightpink;
    }
    .avatar.blue {
        color: lightskyblue;
    }
</style>

@php
    // dd($resultats);
@endphp

@section('content')

@php
    $flag=false;
@endphp

<div class="mt-5" id="fiche_eleve">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('depart') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item"><a href="{{ route('maclasse') }}">Ma classe</a></li>
        <li class="breadcrumb-item active" aria-current="page">Mon élève</li>
    </ol>


    <div class="d-none d-xxl-block position-relative gx-0 navigateur" style="width: 100%; height: 100%">
        <img src="{{asset('img/deco/fond_1.jpg')}}" alt="" class="position-absolute" width="100%" style="top:0;bottom:0;left:0;right:0">

        <div class="position-absolute" style="top: 80px;left: 250px; width: 470px;padding: 16px;height: 660px; font-size: 40px; color: #6639AC; font-weight: bolder">
            @if ($eleve['id'] == 'new') 
                un nouvel élève
                @else
                La fiche de {{$eleve['prenom']}}
                @endif
        </div>
        <div class="position-absolute" style="top: 110px;left: 717px; width: 474px;padding: 16px;height: 677px; border: 1px solid var(--main-color); border-radius: 8px">
            <style>
                .croix {
                    right: 50px; top: 50px; cursor: pointer;
                    font-size: 30px; color: white;

                }
            </style>

            <div class="d-none fiche_modify_bloc position-relative">
                <div class="position-absolute croix" style="">
                    <i class="fas fa-times"></i>
                </div>
                <div class="fiche_modify w-100 h-100 d-flex justify-content-center align-items-center" style="background-color: #9978C9; border-radius: 15px">

                </div>
            </div>


            <div class="form_bloc">
                @include('eleves.include.eleve_form')
             
            </div>


        </div>



        @if ($eleve['id'] != 'new' && !$resultats->isEmpty())

            <div class="position-absolute" style="top: 44px; left: 56px;width: 620px;height: 800px; overflow-y: auto">


                <h4 class="text-center">Compétences acquises</h4>

                @php
                    $section_id = 0;
                @endphp

                <div class="liste_eleves ps-4" style="margin-top: 20px;">
                    <input type="hidden" id="enfant" value="{{$eleve['id']}}">

                        <ul class="list-group">
                        @foreach($resultats as $resultat)

                            @if($section_id != $resultat->section_id)
                                
                                </ul>

                                <div class="mb-2 mt-3">
                                    {{-- <img width="40" class="img-fluid" src="{{ asset('img/illustrations/'.$resultat->sectionLogo) }}"> --}}
                                    <img width="40" class="img-fluid" src="{{ asset('img/illustrations/'.$resultat->section_id.'.png') }}">
                                    <strong>{{ $resultat->sectionName }}</strong>
                                </div>
                            
                                <ul class="list-group">
                                @php
                                    $section_id = $resultat->section_id;
                                @endphp
                            @endif

                            <!--<div class="mb-2 ml-5">-->
                                <li class="list-group-item">

                                
                                    <div class="list-group-item-info" data-fiche="{{$resultat->id}}">
                               

                                {{--
                                 @if ($resultat->notation == 2 && $resultat->autonome == 1) 
                                <li class="list-group-item list-group-item-success">
                                @elseif ($resultat->notation == 2 && $resultat->autonome == 0)
                                <li class="list-group-item list-group-item-info">
                                @elseif ($resultat->notation == 1)
                                <li class="list-group-item list-group-item-warning">
                                @endif
                                --}}

                                @php
                                    if ($resultat->notation == 2 && $resultat->autonome == 1) {
                                        $resultat->notation = 3 ;
                                    }
                                @endphp

                                    <span class="me-2" style="color: var(--niveau_{{$resultat->notation}})"><i class="fa-solid fa-circle"></i></span>{{ $resultat->itemName }}
                                    {{-- @if($resultat->autonome == 0)
                                        (acquis avec aide)
                                    @endif --}}

                                    
                       

                                </li>

                                {{--
                                <div class="collapse" id="collapseExample{{$resultat->id}}">
                                    <div class="card card-body">
                                      Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
                                    </div>
                                </div>
                                --}}
                            <!--</div>-->
                            
                        @endforeach
                            </ul>

                </div>

            </div>            
        @endif

    </div>

    <div class="d-xs-block d-xxl-none phone">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="form_bloc">
                    @include('eleves.include.eleve_form')
                
                </div>
            </div>
            <div class="col-12 col-lg-6">
                @if ($eleve['id'] != 'new' && !$resultats->isEmpty())

                    <div>


                        <h4 class="text-center">Compétences acquises</h4>

                        @php
                            $section_id = 0;
                        @endphp

                        <div class="liste_eleves ps-4" style="margin-top: 20px;">
                            <input type="hidden" id="enfant" value="{{$eleve['id']}}">

                                <ul class="list-group">
                                @foreach($resultats as $resultat)

                                    @if($section_id != $resultat->section_id)
                                        
                                        </ul>

                                        <div class="mb-2 mt-3">
                                            <img width="40" class="img-fluid" src="{{ asset('img/illustrations/'.$resultat->sectionLogo) }}">
                                            <strong>{{ $resultat->sectionName }}</strong>
                                        </div>
                                    
                                        <ul class="list-group">
                                        @php
                                            $section_id = $resultat->section_id;
                                        @endphp
                                    @endif

                                    <!--<div class="mb-2 ml-5">-->
                                        <li class="list-group-item">

                                        
                                            <div class="list-group-item-info" data-fiche="{{$resultat->id}}">
                                    

                                        {{--
                                        @if ($resultat->notation == 2 && $resultat->autonome == 1) 
                                        <li class="list-group-item list-group-item-success">
                                        @elseif ($resultat->notation == 2 && $resultat->autonome == 0)
                                        <li class="list-group-item list-group-item-info">
                                        @elseif ($resultat->notation == 1)
                                        <li class="list-group-item list-group-item-warning">
                                        @endif
                                        --}}

                                        @php
                                            if ($resultat->notation == 2 && $resultat->autonome == 1) {
                                                $resultat->notation = 3 ;
                                            }
                                        @endphp

                                            <span class="me-2" style="color: var(--niveau_{{$resultat->notation}})"><i class="fa-solid fa-circle"></i></span>{{ $resultat->itemName }}
                                            {{-- @if($resultat->autonome == 0)
                                                (acquis avec aide)
                                            @endif --}}

                                            
                            

                                        </li>

                                        {{--
                                        <div class="collapse" id="collapseExample{{$resultat->id}}">
                                            <div class="card card-body">
                                            Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
                                            </div>
                                        </div>
                                        --}}
                                    <!--</div>-->
                                    
                                @endforeach
                                    </ul>

                        </div>

                    </div>     
                @else
                <div class="d-none d-lg-block">
                    <img src="{{asset('img/deco/enfants.png')}}" alt="">      

                </div>
                @endif            
            </div>            
        </div>

        
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="modifyFicheModal" tabindex="-1" aria-labelledby="modifyFicheModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="left: 50%; transform: translateX(-50%); width: 240px">
      <div class="modal-content justify-content-center fiche_modify" style="background-color: transparent !important; border: none !important" >



      </div>
    </div>
  </div>

@endsection
