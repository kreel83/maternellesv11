@extends('layouts.mainMenu', ['titre' => 'Mon calendrier', 'menu' => 'calendrier'])
@php
    use Carbon\Carbon;



@endphp

@section('content')

<div id="calendrier_view" class="p-0 m-0 position-relative">



    <div class="row gx-0">
        <div class="col-md-1">
            <div class="d-flex justify-item-end">
                <button type="button" class="btn btn-primary position-fixed"  style="bottom: 30px; right: 30px" data-bs-toggle="modal" data-bs-target="#EventModal">
                  <i class="fa-solid fa-plus"></i>
                </button>
            </div>
            <div class="bloc_event">
                @include('calendrier.include.event')
                
            </div>
        </div>
        <div class="col-md-11 d-flex flex-wrap " id="calendrier_scolaire" style="height: 800px; overflow-y: auto">
           
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
<div class="modal fade" id="delete_event_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
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
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Calendrier</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{route('event')}}" method="POST" >
            <div class="modal-body">
                @csrf
                <input type="hidden" name="user_id" value="{{Auth::id()}}" >
                <input type="hidden" name="id" value="new" >
                <div class="form-floating">
                    <input type="text" class="form-control" name="name">
                        <label for="">Nom de l'evenement</label>

                </div>
                <div class="form-floating mt-3">
                    <input type="date" class="form-control" name="date" id="date_event">
                    <label for="">Date de l'evenement</label>
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
