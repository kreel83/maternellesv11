@extends('layouts.mainMenu')

@section('content')

<style>
    .card-section {
        border: 1px solid black;min-height: 60px; width: 300px;
        margin: 4px 0;;
        cursor: pointer;
        color: white;
    }

</style>
<div class="row position-relative" >
    <div class="col-md-3 position-fixed">
        @foreach ($sections as $section)
        <div class="card-section" style="background-color: {{$section->color}}" data-id="{{$section->id}}">
            <div class="card-body">
                {{$section->name}}
            </div>
        </div>
        @endforeach
    </div>
    <div class="col-md-9">
        <div id="liste" class="d-flex flex-wrap position-absolute" style="left: 350px;top: 0px">
            @foreach ($items as $item)
                <div class="card" style="width: 280px;" data-section="{{$item->section_id}}">
                    <div class="card-header" style="background-color: {{$item->section()->color}};">
                        {{$item->name}}
                    </div>
                    <div class="card-body">
                        <img src="{{asset($item->image)}}" width="100">                    
                    </div>
                </div>
            @endforeach        
        </div>        
    </div>


</div>
@endsection