<div class="d-flex flex-column">
    @foreach ($events as $event)
    <div class="card">
        <div class="card-header">
            {{Carbon\Carbon::parse($event->date)->format('d/m/Y')}}
        </div>
        <div class="card-header">
            {{$event->name}}
        </div>
        <div class="card-body">
            {{$event->comment}}
        </div>
        <div class="d-flex justify-content-end mt-3" style="right: 20px; bottom: 10px; font-size: 20px">
            <div type="button" data-bs-toggle="modal" data-bs-target="#EventModal" class="me-3 editEvent" style="cursor: pointer"  data-comment="{{$event->comment}}" data-name="{{$event->name}}" data-date_js="{{$event->date}}" data-id="{{$event->id}}"><i class="fa-regular fa-pen-to-square"></i></div>
            <div type="button" data-bs-toggle="modal" data-bs-target="#delete_event_modal"  style="color: var(--rouge);cursor: pointer" class="delete_event"  data-date_js="{{$event->date}}" data-id="{{$event->id}}"><i class="fa-solid fa-trash"></i></div>
        </div>
    </div>    
    @endforeach
</div>

