@foreach ($events as $event)
<div class="event_container position-relative" data-id="{{$event->id}}" data-date_js="{{$event->date}}" style="width: 100% !important">
    <div class="position-absolute d-flex" style="right: 20px; bottom: 10px; font-size: 20px">
        <div type="button" data-bs-toggle="modal" data-bs-target="#EventModal" class="me-3 editEvent" style="cursor: pointer"  data-comment="{{$event->comment}}" data-name="{{$event->name}}" data-date_js="{{$event->date}}" data-id="{{$event->id}}"><i class="fa-regular fa-pen-to-square"></i></div>
        <div type="button" data-bs-toggle="modal" data-bs-target="#delete_event_modal"  style="color: var(--rouge);cursor: pointer" class="delete_event"  data-date_js="{{$event->date}}" data-id="{{$event->id}}"><i class="fa-solid fa-trash"></i></div>
    </div>
    <div>{{Carbon\Carbon::parse($event->date)->format('d/m/Y')}}</div>
    <div>{{$event->name}}</div>
    <div>{{$event->comment}}</div>
</div>
@endforeach