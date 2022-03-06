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
        <div class="tab-pane fade {{$type == "createfiche" ? 'show active' : 'null' }}" id="nav-2" role="tabpanel" aria-labelledby="nav-profile-tab">

            @if ($itemactuel)

                <h2>modification de la fiche {{$itemactuel->name}}</h2>
            @else
                <h2>creation de fiche</h2>
            @endif
            <form action="{{route('saveFiche')}}" method="post" enctype="multipart/form-data">
                @csrf


                <input type="hidden" name="section_id" value="{{$section->id}}">
                <input type="hidden" name="personnel_id" value="{{$itemactuel ? $itemactuel->id : null}}">
{{--                <input type="hidden" name="provenance" value="{{$provenance}}">--}}

                <div class="d-flex justify-content-between my-2" id="filtre">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="true" name="ps" {{($itemactuel  && substr($itemactuel->lvl,0,1) == '1') ? 'checked' : null}}>
                        <label class="form-check-label" for="flexCheckChecked">
                            petite section
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="true" name="ms"{{($itemactuel  && substr($itemactuel->lvl,1,1) == '1') ? 'checked' : null}} >
                        <label class="form-check-label" for="flexCheckChecked">
                            Moyenne section
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="true" name="gs" {{($itemactuel  && substr($itemactuel->lvl,2,1) == '1') ? 'checked' : null}}>
                        <label class="form-check-label" for="flexCheckChecked">
                            Grande section
                        </label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-8">
                        {{--@php--}}
                        {{--dd($fiche);--}}
                        {{--@endphp--}}

                        <div class="form-group">
                            <label for="">Titre</label>
                            <input type="text" name="name" class="form-control" value="{{$itemactuel ? $itemactuel->name : null}}">
                        </div>
                        <div class="form-group">
                            <label for="">Sous-titre</label>
                            <input type="text" name="st" class="form-control" value="{{$itemactuel ? $itemactuel->st : null}}">
                        </div>
                    </div>
                    <div class="col-md-4">

                        <input accept="image/*" name="file" type='file' id="photoEnfantInput" hidden />
                        @if ($itemactuel)

                        <img id="photoEnfantImg" alt="your image" src="{{asset($itemactuel->image)}}" width="200px" style="cursor: pointer" />
                            @else
                        <img id="photoEnfantImg" alt="your image" src="{{asset('img/avatar/add.png')}}" width="200px" style="cursor: pointer" />

                        @endif
                    </div>
                </div>
                <div id="editor3" data-section="" style="height: 100px"></div>
                <textarea name="phrase" id="phraseForm" cols="30" rows="10" hidden> {{($itemactuel) ? $itemactuel->phrase : null}}</textarea>
                <div style="margin-top: 20px">
                    <table class="table table-bordered table-hover" id="motCleFiche" style="cursor: pointer;">
                        <tr style="text-align: center">
                            <td data-reg="@name@">prénom</td>
                            <td data-reg="@ilelle@">pronom personnel</td>
                            <td data-reg="*e*">feminin / masculin</td>
                        </tr>

                    </table>
                </div>

                @if ($itemactuel)
                    <button type="submit" class="btn btn-outline-dark">Modifier la fiche</button>
                @else
                    <button type="submit" class="btn btn-outline-dark">Sauvegarder la nouvelle fiche</button>
                @endif
                <button type="button" class="btn btn-outline-danger">Annuler</button>



            </form>
        </div>

    </div>







@endsection
