@extends('layouts.mainMenu')

@section('content')
<h1>Mes items</h1>

<div class="accordion" id="page_items">

    @foreach ($sections as $key=>$section)
    <div class="accordion-item">
        <h2 class="accordion-header" id="panelsStayOpen-heading{{$key}}">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse{{$key}}" aria-expanded="true" aria-controls="panelsStayOpen-collapse{{$key}}">
                {{$section->name}}
            </button>
        </h2>
         <div id="panelsStayOpen-collapse{{$key}}" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-heading{{$key}}">
            <div class="accordion-body item">
                <div class="items_container">
                    @foreach ($section->items()->get() as $item)

                        @include('cards.item')
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
