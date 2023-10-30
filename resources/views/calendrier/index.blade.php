@extends('layouts.mainMenu2', ['titre' => 'Mon calendrier', 'menu' => 'calendrier'])
@php
    use Carbon\Carbon;



@endphp


<style>
  .btnEvent {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 35px;
    height: 35px;
    font-size: 20px;
    color: white;
    background-color: var(--main-color);
    border-radius: 50%;
    top: 0px;
    right: 110px;
    position: absolute;
    border: none;
    outline: none;
  }


</style>

@section('content')

<div id="calendrier_view" class="position-relative mt-5">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('depart')}}">Tableau de bord</a></li>        
        <li class="breadcrumb-item active" aria-current="page">Calendrier</li>
      </ol>
 
  <div class="d-flex justify-item-end">
    <button type="button" class="btnEvent"  data-bs-toggle="modal" data-bs-target="#EventModal">
      <i class="fa-solid fa-plus"></i>
    </button>
  </div>


    <div class="row gx-0 position-relative">
      <div class="cadre_cal d-none"></div>
        {{-- <div class="offset-md-2 col-md-2 position-relative">

            <div class="bloc_event">
                @include('calendrier.include.event')
                
            </div>
        </div> --}}
        <div class="col-md-12 d-flex flex-wrap " id="calendrier_scolaire">
           
                <input type="hidden" value="{{$conges}}" id="conges">
                <input type="hidden" value="{{$anniversaires}}" id="anniversaires">
                <input type="hidden" value="{{$evenements}}" id="evenements">
                <input type="hidden" value="{{$ddj}}" id="ddj">
                @for ($j=1; $j<=12;$j++)



                    @include('calendrier.include.month',['month', $month])



                @endfor
             
        </div>
    </div>


</div>


<!-- Modal -->
<div class="modal fade" id="view_event_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="top:200px">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            coucou
        </div>
        <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fermer</button>
        </div>
      </div>
    </div>
  </div>

<!-- Modal -->
<div class="modal fade" id="delete_event_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="top: 120px">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Voulez-vous supprimer cet événement ?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
          <button type="button" class="btn btn-primary" id="do_delete_event" data-bs-dismiss="modal">Oui</button>
        </div>
      </div>
    </div>
  </div>

<!-- Modal -->
<div class="modal fade" id="EventModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="top: 120px">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Evenement</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{route('event')}}" method="POST" >
            <div class="modal-body">
                @csrf
                <input type="hidden" name="user_id" value="{{Auth::id()}}" >
                <input type="hidden" name="id" value="new" >
                <div class="form-floating mt-3">
                    <input type="date" class="form-control" name="date" id="date_event">
                    <label for="">Date de l'evenement</label>
                </div>
                <div class="form-floating">
                    <input type="text" class="form-control" name="name">
                        <label for="">Nom de l'evenement</label>

                </div>
                <div class="form-floating mt-3">
                    <textarea class="form-control" name="comment" style="height: 100px"></textarea>
                    <label for="floatingTextarea2">commentaire</label>
                </div>

                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-primary" id="saveEvent">Sauvegarder</button>
            </div>
        </form>
    </div>
  </div>
</div>

@endsection
