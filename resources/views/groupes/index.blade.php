@extends('layouts.mainMenu2', ['titre' => "Les groupes d'élèves", 'menu' => 'groupe'])

@section('content')

<style>

    .apercu-groupe {
        align-items: center;
        text-align: center;
        height: 37px;
        border-radius: 40px;
        width: 200px;
        border:1px solid grey;
        font-size: 16px;
        padding: 5px 16px;
    }

</style>

<div class="mt-5">


    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb position-relative">
            <li class="breadcrumb-item"><a href="{{route('depart')}}">Tableau de bord</a></li>        
            <li class="breadcrumb-item active" aria-current="page">Gestion des groupes</li>
            <span class="help position-absolute" data-location="eleve.groupes.manage"><i class="fa-light fa-message-question"></i></span>
        </ol>
    </nav>

    <h4 class="mb-3" style="color: var(--main-color)">Gestion des groupes</h4>

    @include('include.display_msg_error')


 
        <div class="alert alert-info" role="alert" style="background-color: var(--second-color); color: white; border: none">
            @if (4 - $nbGroupe == 0)
                Vous pouvez ne pouvez plus créer de groupe (4 maximum)
            @else
                Vous pouvez encore créer {{ 4 - $nbGroupe}} groupe{{ 4 - $nbGroupe == 1 ? null : 's'}}.
            @endif
        </div>   
    

    <style>
        .groupe_container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            padding: 0 10rem;

        }
        .groupe_card {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 300px;
            height: 200px;
            border-radius: 24px;
            background-color: white;
            padding: 16px;
            margin: 16px;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
        }
        .groupe_titre {
            position: absolute;
            width: 35px;
            height: 35px;
            display: flex;
            justify-content: center;
            align-items: center;
            top: -16px;
            left: 30px;
            font-weight: 400;
            font-size: 16px;
            padding: 4px 16px;
            background-color: white;
            color: var(--main-color);
            font-weight: bold;
            border-radius: 50%;
            box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;
        }
        .groupe_controle {
            position: absolute;
            color: var(--second-color);
            top: -16px;
            right: 30px;
            font-weight: 400;
            font-size: 16px;
            padding: 4px 16px;
            background-color: white;
            border-radius: 14px;
            box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;
        }
      
    </style>
    
    @if($nbGroupe == 0)
        <div class="alert alert-info" role="alert">
            Vous n'avez encore aucun groupe de défini.
        </div>
    @else

        <div class="groupe_container mt-5">
            @foreach ($groupes as $key=>$groupe)
                @php
                    $token = md5(Auth::id().$loop->index.env('HASH_SECRET'));
                @endphp
                <div class="d-flex mb-3 groupe_card position-relative">
                    <div class="groupe_titre">{{$key +1 }}</div>
                    <div class="groupe_controle d-flex w-25 justify-content-center">
                        <a  style="color: var(--main-color)" href="{{ route('editerUnGroupe', ['id' => $loop->index, 'token' => $token]) }}"><i class="fa-solid fa-edit"></i></a>
                        @if ($key == sizeof($groupes) -1)
                        <div data-bs-toggle="modal" data-bs-target="#ModalSupprimerGroupe" class="ms-3" style="color: var(--second-color)" ><span style="cursor: pointer"><i class="fa-solid fa-trash"></i></div>
                        @endif
                    </div>
                    
                        <div class="apercu-groupe mb-3" style="background-color: {{ $groupes[$loop->index]['backgroundColor'] }}; color: {{ $groupes[$loop->index]['textColor'] }}">{{ $groupes[$loop->index]['name'] ?? null }}</div>
                    {{-- <div class="d-flex justify-content-between w-100">
                        <a class="btnAction" href="{{ route('editerUnGroupe', ['id' => $loop->index, 'token' => $token]) }}">Modifier</a>
                        <a class="btnAction inverse red" href="{{ route('editerUnGroupe', ['id' => $loop->index, 'token' => $token]) }}">Supprimer</a>
                    </div> --}}
                    {{-- <div class="me-3">
                        <a href="{{ route('supprimerUnGroupe', ['id' => $loop->index, 'token' => $token]) }}">Supprimer</a>
                    </div> --}}
                </div>
            @endforeach  
        @endif
            @if (sizeof($groupes) < 4) 
               <div class="groupe_card d-flex justify-content-center align-items-center">
                    @php
                    $token = md5(Auth::id().'new'.env('HASH_SECRET'));
                    @endphp
                    <a href="{{ route('editerUnGroupe', ['id' => 'new', 'token' => $token]) }}" style="font-size: 60px"><i class="fa-solid fa-plus"></i></a> 
                </div>      
            @endif
        </div>
        
</div>

<!-- Modal -->
<div class="modal fade" id="ModalSupprimerGroupe" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="top: 120px">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Confirmation de suppression</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div>Voulez-vous supprimer ce groupe? </div>
            <br>
            <small>Si oui, vous deverez réaffecter les enfants de ce groupe</small>
            
        </div>
        <div class="modal-footer">
            @php
                $token = md5(Auth::id().sizeof($groupes).env('HASH_SECRET'));
            @endphp
            <a class="btnAction" href="{{ route('supprimerUnGroupe', ['id' => sizeof($groupes), 'token' => $token]) }}" >Supprimer</a>
        </div>
      </div>
    </div>
  </div>
@endsection
    