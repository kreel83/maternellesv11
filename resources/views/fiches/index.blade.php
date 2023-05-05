@extends('layouts.mainMenu', ['titre' => 'Mes fiches'])

@section('content')




    <div class="form-group" style="margin-top: 40px">
        <label for="">Choisir une section</label>
        <select name="" id="selectSectionFiche" class="form-control" >
            @foreach($sections as $sec)
                <option value="{{$sec->id}}" {{$sec->id == $section->id ? "selected" : null}}>{{$sec->name}}</option>
            @endforeach
        </select>
    </div>
{{--    <div style="margin: 12px 0">
        <table class="table table-bordered" id="choixFiche" data-section="{{$section->id}}">
            <tr>
                <td data-type="mesfiches">Mes fiches</td>
                <td data-type="autresfiches">fiches non choisies</td>
            </tr>
        </table>
    </div>--}}
    <nav style="margin-top: 30px">
        <div class="nav nav-tabs" id="choixFiche" role="tablist"  data-section="{{$section->id}}">
            <button data-type="mesfiches" class="nav-link {{$type == "mesfiches" ? 'active' : 'null' }}" id="nav-1-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-1" aria-selected="true">Mes fiches</button>
            <button data-type="autresfiches" class="nav-link {{$type == "autresfiches" ? 'active' : 'null' }}" id="nav-2-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-2" aria-selected="false">Fiches non choisies</button>
            {{--<button data-type="duplicatefiches" class="nav-link {{$type == "duplicatefiches" ? 'active' : 'null' }}" id="nav-2-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-2" aria-selected="false">Duplication de fiche</button>--}}
            @if ($itemactuel)
            <button data-type="createfiche" class="nav-link {{$type == "createfiche" ? 'active' : 'null' }}" id="nav-2-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-3" aria-selected="false">Modification de fiche</button>
            @else
            <button data-type="createfiche" class="nav-link {{$type == "createfiche" ? 'active' : 'null' }}" id="nav-2-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-3" aria-selected="false">Création de fiche</button>
            @endif
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent" data-section="{{ $section->id }}">
        <div class="tab-pane fade {{$type == "mesfiches" ? 'show active' : 'null' }}" id="nav-1" role="tabpanel" aria-labelledby="nav-home-tab">
            <ul class="fiche_container fiche mesfiches" id="sortable">

            @foreach ($fiches as $fiche)

                @include('cards.fiche',['type' => 'mesfiches'])
            @endforeach
            </ul>
        </div>
        <div class="tab-pane fade {{$type == "autresfiches" ? 'show active' : 'null' }}" id="nav-2" role="tabpanel" aria-labelledby="nav-profile-tab">
        @include('fiches.filtre')
        <ul class="fiche_container fiche autresfiches" id="sortable">

            @foreach ($universelles as $fiche)
{{--@php--}}
{{--dd($fiche);--}}
{{--@endphp--}}
                @include('cards.universelle',['type' => 'autresfiches'])
            @endforeach
        </ul>
        </div>
        <div class="tab-pane fade {{$type == "duplicatefiches" ? 'show active' : 'null' }}" id="nav-2" role="tabpanel" aria-labelledby="nav-profile-tab">

        <ul class="fiche_container fiche duplicatefiches" id="sortable">

            @foreach ($fiches as $fiche)
                @include('cards.fiche',['type' => 'duplicatefiches'])
            @endforeach
            @foreach ($universelles as $fiche)
                @include('cards.universelle',['type' => 'duplicatefiches'])
            @endforeach
        </ul>
        </div>
        <div class="tab-pane fade {{$type == "createfiche" ? 'show active' : 'null' }}" id="nav-2" role="tabpanel" aria-labelledby="nav-profile-tab">

            @include('fiches.create')
        </div>

    </div>







@endsection
