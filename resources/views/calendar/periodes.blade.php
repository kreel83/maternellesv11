@extends('layouts.mainMenu')
@php
    use Carbon\Carbon;


@endphp

@section('content')
<h1>coucou</h1>

<div class="selector">
    <div class="price-slider">
        <div id="slider-range" class="ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content">
            <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
            <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
        </div>
        <span id="min-price" data-currency="€" class="slider-price">0</span> <span class="seperator">-</span> <span id="max-price" data-currency="€" data-max="3500"  class="slider-price">3500 +</span>
    </div> 
</div>
@endsection