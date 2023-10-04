@extends('layouts.mainMenu2', ['title' => 'Mon cahier de réussite','menu' => 'classe'])

@section('content')


    @php
    $degrades = App\Models\Enfant::DEGRADE;
@endphp

<div id="pdfView" class="row px-5" data-enfant="{{$enfant->id}}">
    <div  data-section="{{ $section->id }}" class="liste_section mb-5">
        <div class="section_container">
            @if ($enfant->background)
            <div class="m-2 degrade_card_enfant animaux little"  style="background-image: {{$degrades[$enfant->background]}}">
                <img src="{{asset('/img/animaux/'.$enfant->photo)}}" alt="" width="60">
            
            </div>
            @else
              <img src="{{asset($enfant->photoEleve)}}" alt="rover"  width="60" />
            @endif
            <div class="ms-1 me-5 pt-2" style="font-size: 14px">
                <div>{{$enfant->prenom}} {{substr($enfant->nom,0,1)}}</div>
                <div>Cahier de réussite</div>
                <div> {{$title}}</div>
            </div> 
            @foreach($sections as $sec)
            <div class="d-flex flex-column align-items-center">
                    <div class='sectionCahier selectSectionFiche {{$sec->id == $section->id ? "selected" : null}}' data-value="{{$sec->id}}" data-section="{{$sec->id}}" data-textes="{{(isset($textes[$sec->id])) ? $textes[$sec->id] : null}}"  data-value="{{$sec->id}}"  style="background-color: {{$sec->color}}">
                        <img src="{{asset('img/illustrations/'.$sec->logo)}}" alt="" width="45px" height="45px">
                    </div>
                    <div class="tiret_selection {{$sec->id == $section->id ? null : "d-none"}}" data-id="{{$sec->id}}" style="background-color: {{$sec->color}}"></div>            
            </div>
            
            @endforeach           
            <div class="d-flex flex-column align-items-center">
                    <div class='sectionCahier selectSectionFiche' data-value="carnet"  style="background-color: red">
                        <img src="{{asset('img/illustrations/carnet.png')}}" alt="" width="45px" height="45px">
                    </div>
                    <div class="tiret_selection_carnet" data-id="carnet" style="background-color: red"></div>            
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-8">
            <iframe src="" frameborder="0"></iframe>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
@endsection