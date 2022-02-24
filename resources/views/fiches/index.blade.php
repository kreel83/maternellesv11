@extends('layouts.mainMenu')

@section('content')



    <div class="form-group" style="margin-top: 40px">
        <label for="">Choisir une section</label>
        <select name="" id="selectSectionFiche" class="form-control" >
            @foreach($sections as $sec)
                <option value="{{$sec->id}}" {{$sec->id == $section->id ? "selected" : null}}>{{$sec->name}}</option>
            @endforeach
        </select>
    </div>
    <div style="margin: 12px 0">
        <table class="table table-bordered" id="choixFiche" data-section="{{$section->id}}">
            <tr>
                <td data-type="mesfiches">Mes fiches</td>
                <td data-type="autresfiches">fiches non choisies</td>
            </tr>
        </table>
    </div>
    <ul class="fiche_container fiche" id="sortable">
        @foreach ($fiches as $fiche)

            @include('cards.fiche')
        @endforeach
    </ul>




@endsection
