@extends('layouts.mainMenu', ['titre' => "les résultats de $enfant->prenom"])

@section('content')


<div class="accordion row p-2" id="page_items">
    <div class="col-md-3">

    </div>
    <div class="col-md-7">
    @foreach ($sections as $key=>$section)
        @php
            $color = "var(--section".$key.")";
        @endphp
    <div class="accordion-item" style="margin: 16px 0">
        <h2 class="accordion-header" id="panelsStayOpen-heading{{$key}}" >
            <button style="background-color: {{$color}}; color: white" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse{{$key}}" aria-expanded="true" aria-controls="panelsStayOpen-collapse{{$key}}">
                {{$section->name}}
            </button>
        </h2>
         <div id="panelsStayOpen-collapse{{$key}}" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-heading{{$key}}">
            <div class="accordion-body item">
                <div class="items_container">
                    @if(isset($fiches[$section->id]))
                        @foreach ($fiches[$section->id] as $fiche)

                            @include('cards.item')
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </div>
    @endforeach
    </div>
    <div class="col-md-2"></div>

   
</div>
@endsection
