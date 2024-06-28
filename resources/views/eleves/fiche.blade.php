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

    <div class="gx-0 navigateur">
        {{-- <img src="{{asset('img/deco/fond_1.jpg')}}" alt="" class="position-absolute" width="100%" style="top:0;bottom:0;left:0;right:0"> --}}

     <div class="row justify-content-center">
            <div class="col-12 col-xl-6 mb-5 eleveContainerModif gx-0" >
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


                <div class="form_bloc p-3">
                    @include('eleves.include.eleve_form')
                
                </div>


            </div>



            @if ($eleve['id'] != 'new' && !$resultats->isEmpty())

                <div class="col-12 col-xl-6 mb-5" style="">


                    <h4 class="text-center">Compétences acquises</h4>

                    <div style="font-size: 12px; background-color: var(--main-color); color: white; padding: 4px 8px; border-radius: 8px"  class="text-center">
                        @if (session('classe_active')->desactive_acquis_aide == 1)
                        Les activités acquises avec aide <span class="mx-1" style="color: var(--niveau_2)"><i class="fa-solid fa-circle"></i></span> apparaissent dans le cahier de réussite
                        @else
                        Les activités acquises avec aide <span class="mx-1" style="color: var(--niveau_2)"><i class="fa-solid fa-circle"></i>'</span> n'apparaissent pas  dans le cahier de réussite
                        @endif

                    </div>

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


                                    <li class="list-group-item" data-id="{{$resultat->id}}"> 
                                        @if ($resultat->autonome)   
                                            <div class="">
                                        @else
                                            <div  data-do_action="upgradeResultat" data-fiche="{{$resultat->id}}" data-color="var(--niveau_3)" data-autonome="{{$resultat->autonome}}"  class="{{$resultat->autonome == 0 ? "confirmation" : null}}" data-action="Modifier" data-title="Modification de notation" data-texte='Voulez-vous passer cette activité à "Acquis avec autonomie"  ?' data-href="{{route('upgradeResultat',['id' => $resultat->id])}}" data-bs-toggle="modal" data-bs-target="#confirmationModal">
                                        @endif                                
                                        @php
                                            if ($resultat->notation == 2 && $resultat->autonome == 1) {
                                                $resultat->notation = 3 ;
                                            }
                                        @endphp
                                        <span class="me-2" style="color: var(--niveau_{{$resultat->autonome == 1 ? "3" : "2" }})"><i class="fa-solid fa-circle"></i></span>{{ $resultat->itemName }}
                                        </div>
                                    </li>
                              
                            @endforeach
                                </ul>

                    </div>

                </div>            
            @endif        
     </div>



    </div>

    {{-- <div class="d-xs-block d-xxl-none phone">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="form_bloc">
                    @include('eleves.include.eleve_form')
                
                </div>
            </div>
            <div class="col-12 col-lg-6 mt-5">
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
                                                <img width="40" class="img-fluid" src="{{ asset('img/illustrations/'.$resultat->section_id.'.png') }}">
                                                <strong>{{ $resultat->sectionName }}</strong>
                                            </div>
                                        
                                            <ul class="list-group">
                                            @php
                                                $section_id = $resultat->section_id;
                                            @endphp
                                        @endif
                                        @php
                                        if ($resultat->notation == 2 && $resultat->autonome == 1) {
                                            $resultat->notation = 3 ;
                                        }                                  
                                        @endphp

                                            <li class="list-group-item" id="{{$resultat->autonome}}">                                        
                                                <div class="list-group-item-info" data-fiche="{{$resultat->id}}">  
                                                <span class="me-2" style="color: var(--niveau_{{$resultat->notation}})"><i class="fa-solid fa-circle"></i></span>
                                                {{ $resultat->itemName }}
                                                </div>
                                            </li>                                      
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

        
    </div> --}}

</div>



<!-- Modal -->
<div class="modal fade" id="modifyFicheModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content" style="width: 300px">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Nouvelle notation</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-footer">

            <button type="button" class="btnAction" data-bs-dismiss="modal">Passer cette activité à acquis en autonomie</button>
          </div>


      </div>
    </div>
  </div>

<!-- Modal -->
{{-- <div class="modal fade" id="modifyFicheModal" tabindex="-1" aria-labelledby="modifyFicheModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" >
      <div class="modal-content justify-content-center fiche_modify" style="background-color: transparent !important; border: none !important" >



      </div>
    </div>
  </div> --}}

@endsection
