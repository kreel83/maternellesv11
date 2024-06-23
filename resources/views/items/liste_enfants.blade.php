@extends('layouts.mainMenu2', ['titre' => 'Mes fiches','menu' => 'maclasse'])

@section('content')

<style>
    .liste_line {
        width: 100%;
        height: 170px;
        overflow: hidden;
        border: 1px solid grey;
        margin-bottom: 5px;
        padding: 0 50px;
        background-color: wheat;
        cursor: pointer;
        padding-top: 25px;
    }

    .liste_line .card__image {
        background-color: white;
        border-radius: 8px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .liste_line .card__image img {
        width: 140px;
        height: 120px;
        object-fit: cover;
    }
    .liste_line:hover {
        background-color: purple;
    }
</style>

<div id="page_activite" class="mt-5">




@php
    $degrades = App\Models\Enfant::DEGRADE;
    $lesgroupes = json_decode(Auth::user()->groupes(), true);

@endphp

@if (!isset($is_dashboard))
    <nav class="my5" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
    aria-label="breadcrumb">
    
    
    <ol class="breadcrumb position-relative">
        <li class="breadcrumb-item"><a href="{{ route('depart') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item"><a href="{{ route('activites') }}">Mes activités</a></li>
        <li class="breadcrumb-item active" aria-current="page">Ma classe</li>
        <span class="help position-absolute" data-location="classe.liste.main"><i class="fa-light fa-message-question"></i></span>
    </ol>
    
    </nav>
@endif

<style>
    .fiche_name {
        font-size: 20px;
        color: #FB8064;
        font-weight: bold;
    }
    .item_name {
        font-size: 20px;
    }
</style>

<div class="row">
    <input type="hidden" id="fiche_selected" value="{{$fiche->id}}">
    <div class="col-md-1">
        <div class='selectSectionFiche selectSectionItem '
            style="width: 80px;background-color: {{ $section->color }}; border-radius: 8px" title="{{$section->name}}"            
            
            >
            <img src="{{ asset('img/illustrations/' . $section->logo) }}" alt="" width="75px"
                height="75px">
        </div>
    </div>
    <div class="col-md-7">

        <div class="item_name" style="color: {{ $section->color }}">{{ $section->name}}</div>
       <div class="fiche_name">{{ $fiche->name}}</div>
    </div>
    <div class="col-md-4">

        <button class="btnActionSpecial mt-1 w-100" id="btnActiviteEleves">Définir cette activité comme acquise  </br>pour  <span id="nb_eleves_activite">{{$listeDesEleves->count()}}</span> éleves de la classe</button>
    </div>
  

</div>
<div class="row my-5">
    <div class="col-md-12 bloc_check_enfant d-flex">
        <div class="form-check me-3" style="padding-left: 28px; border: 1px solid grey; border-radius: 8px">
            <input class="form-check-input mx-1 " type="checkbox" value="classe" data-groupe="classe" checked>
            <label class="form-check-label mx-3" for="inlineCheckbox1">Toute la classe</label>
          </div>
              
              
              @foreach ($mesgroupes as $groupe)
          {{-- @php
              dd($groupe);
              @endphp --}}
            <div class="form-check me-3" style="border-radius:8px; background-color: {{$groupe['backgroundColor']}}; color: {{$groupe['textColor']}}">
                <input class="form-check-input mx-1" type="checkbox" id="inlineCheckbox2" value="g{{$groupe['id']}}" data-groupe="groupe" checked>
                <label class="form-check-label mx-3" for="inlineCheckbox2">{{$groupe['name']}}</label>
            </div>
          @endforeach
          
    </div>   
</div>

@if (!isset($is_dashboard) || $listeDesEleves->isEmpty())

     

@endif

<div class="row mt-3">
    <div class="col-md-6">
        <table class="table table-sm classe_dashboard white">
            <tbody>
                @foreach ($listeDesEleves->take($middle) as $eleve)
                    @php
                        $groupe = null;
                        if (!is_null($eleve->groupe) && !is_null($lesgroupes)){ 
                            $groupe = $lesgroupes[$eleve->groupe];
                        }
                    @endphp
                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input mt-3" type="checkbox" value="" data-groupe="g{{$eleve->groupe}}" data-enfant="{{$eleve->id}}" checked>
   
                              </div>
                        </td>
                        <td>
                            <div class="m-2 degrade_card_enfant animaux"
                                style="background-image: {{ $degrades[$eleve->background] ?? $degrades['b1'] }}; width: 27px; height: 27px"
                                data-degrade="{{ $eleve->background }}" data-animaux="{{ $eleve->photo }}">
                                <img src="{{ asset('/img/animaux/' . $eleve->photo) }}" alt="" width="30">
                            </div>
                        </td>
                        <td class="name {{ $eleve->genre }}">
                            <div>

                                @if (config('app.custom.app_demo') && Auth::id() == config('app.custom.app_demo_user'))
                                <a href="{{ route('voirEleve', ['enfant_id' => $eleve->id]) }}">                                   
                                    {{$eleve->prenom. ' ' }}
                                    <span >{{$eleve->nom}}</span>
                                </a>
                                @else
                                <a href="{{ route('voirEleve', ['enfant_id' => $eleve->id]) }}">
                                    {{$eleve->prenom . ' ' . $eleve->nom}}
                                </a>
                                @endif

                            </div>
                            <div style="color: lightgrey;">
                                {{ Carbon\Carbon::parse($eleve->ddn)->format('d/m/Y') }}
                                <small>({{ $eleve->age }})</small>
                            </div>
                        </td>


                        <td>
                            <div class="groupe-terme mt-3 {{ isset($groupe) ? null : 'd-none' }}"
                                style="background-color: {{ $groupe['backgroundColor'] ?? '' }}; color:{{ $groupe['textColor'] ?? '' }};border: 1px solid {{$groupe["textColor"] ?? 'transparent'}}">
                                {{ $groupe['name'] ?? '' }}</div>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>




    </div>
    <div class="col-md-6">



        <table class="table table-sm classe_dashboard white">
            <tbody>
                @foreach ($listeDesEleves->skip($middle) as $eleve)
                    @php
                        $groupe = null;
                        if (!is_null($eleve->groupe) && (!is_null($lesgroupes))) {
                            $groupe = $lesgroupes[$eleve->groupe];
                        }
                    @endphp
                    <tr class="">
                        <td>
                            <div class="form-check">
                                <input class="form-check-input mt-3" type="checkbox" value="" data-groupe="g{{$eleve->groupe}}" data-enfant="{{$eleve->id}}" checked>
                            </div>
                        </td>
                        <td>
                            <div class="m-2 degrade_card_enfant animaux"
                                style="background-image: {{ $degrades[$eleve->background] }}; width: 27px; height: 27px"
                                data-degrade="{{ $eleve->background }}" data-animaux="{{ $eleve->photo }}">
                                <img src="{{ asset('/img/animaux/' . $eleve->photo) }}" alt="" width="30">
                            </div>
                        </td>
                        <td class="name {{ $eleve->genre }}">
                            <div>

                                @if (config('app.custom.app_demo') && Auth::id() == config('app.custom.app_demo_user'))
                                <a href="{{ route('voirEleve', ['enfant_id' => $eleve->id]) }}">                                   
                                    {{$eleve->prenom. ' ' }}
                                    <span class="">{{$eleve->nom}}</span>
                                </a>
                                @else
                                <a href="{{ route('voirEleve', ['enfant_id' => $eleve->id]) }}">
                                    {{$eleve->prenom . ' ' . $eleve->nom}}
                                </a>
                                @endif

                            </div>
                            <div style="color: lightgrey;">
                                {{ Carbon\Carbon::parse($eleve->ddn)->format('d/m/Y') }}
                                <small>({{ $eleve->age }})</small>
                            </div>
                        </td>

                        <td>
                            <div class="groupe-terme mt-3 {{ isset($groupe) ? null : 'd-none' }}"
                                style="background-color: {{ $groupe['backgroundColor'] ?? '' }}; color:{{ $groupe['textColor'] ?? '' }} ; border: 1px solid {{$groupe["textColor"] ?? 'transparent'}}" >
                                {{ $groupe['name'] ?? '' }}</div>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
