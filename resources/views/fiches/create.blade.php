@extends('layouts.mainMenu', ['titre' => 'Mes fiches', 'menu' => 'item'])

@section('content')





<div class="container-fluid row">
    <div class="col-md-6" style="padding: 0 5rem">
        @if ($new)
        
        <div class="label_create_fiche">Création de fiche</div>
        @else
        <h2>modification de la fiche {{$itemactuel->name}}</h2>
        @endif
        <form action="{{route('saveFiche')}}" method="post" enctype="multipart/form-data">
                @csrf
            
            
                <input type="hidden" name="section_id" value="{{$section->id}}">
                <input type="hidden" name="fiche_id" value="{{$new ? null : $itemactuel->id}}">
                <input type="hidden" name="duplicate" value="{{$duplicate}}">
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
            
                        <div class="d-flex flex-column">
                            <div class="field field_v1 mt-3">
                                <label for="titre" class="ha-screen-reader">Titre</label>
                                <input id="titre" class="field__input" placeholder="" name="name" value="{{$itemactuel ? $itemactuel->name : null}}">
                                <span class="field__label-wrap" aria-hidden="true">
                                <span class="field__label">Titre</span>
                                </span>
                            </div>
                            <div class="field field_v1 mt-3">
                                <label for="st" class="ha-screen-reader">Sous-titre</label>
                                <input id="st" class="field__input" placeholder="" name="st" value="{{$itemactuel ? $itemactuel->st : null}}">
                                <span class="field__label-wrap" aria-hidden="true">
                                <span class="field__label">Sous-titre</span>
                                </span>
                            </div>                            
                        </div>

                        {{-- <div class="form-group">
                            <label for="">Titre</label>
                            <input type="text" name="name" class="form-control" value="{{$itemactuel ? $itemactuel->name : null}}">
                        </div> --}}
                        {{-- <div class="form-group">
                            <label for="">Sous-titre</label>
                            <input type="text" name="st" class="form-control" value="{{$itemactuel ? $itemactuel->st : null}}">
                        </div> --}}
                    </div>
                    <style>
                        .photoEnfantImg {
                            width: 250px;
                            height: 150px;
                            border: 2px solid lightblue;
                            border-radius: 25px;
                            overflow: hidden;
                        }
                    </style>
                    @php
                        // dd($itemactuel);
                    @endphp
                    <div class="col-md-4 mt-3">
            
                        <input accept="image/*" name="file" type='file' id="photoEnfantInput" hidden />
                        
                        <div id="photoEnfantImg">
                            <input type="hidden" name="imageName" id="imageName">
                            <i style="cursor: pointer;font-size: 200px; z-index: 4000; color: lightgray" class="fa-light fa-image logoImage {{$new ? null : 'd-none'}}"></i>
                            <img class="dlImage {{$new ? 'd-none' : null}}"  alt="your image" src="{{asset($itemactuel->image_name)}}" width="250px" height="150" style="cursor: pointer; z-index: 6000" />
                        </div>

                    </div>
                </div>
                {{-- @php
                if($itemactuel) dd($itemactuel->phrase);
                @endphp --}}
                <div id="editor3" class="mt-3" data-phrase="{{$itemactuel->phrase_masculin}}" data-section="" style="height: 100px; ">{!! ($itemactuel && !$new) ? $itemactuel->phrase : null !!}</div>
                <textarea class="mt-3 d-none" name="phrase" id="phraseForm" style="width: 100%" rows="5" > {!! ($itemactuel && !$new) ? $itemactuel->phrase : null !!}</textarea>

                <style>
                    .item {
                        flex: 1 1 0;
                        width: 0;
                        margin: 4px
                        }
                </style>
                <div class="d-flex mb-5 motCleFiche">
                    <div data-reg="L'élève " class="item btnCommun me-2">prénom</div>
                    {{-- <div data-reg="@ilelle@" class="item btnCommun me-2">pronom personnel</div>
                    <div data-reg="*e*" class="item btnCommun">feminin / masculin</div> --}}
                    {{-- <table class="table table-bordered table-hover" id="motCleFiche" style="cursor: pointer;">
                        <tr style="text-align: center">
                            <td data-reg="@name@">prénom</td>
                            <td data-reg="@ilelle@">pronom personnel</td>
                            <td data-reg="*e*">feminin / masculin</td>
                        </tr>
            
                    </table> --}}
                </div>
                <div class="d-flex justify-content-between">
                    @if ($new || $duplicate)
                        <button type="submit" name="submit" value="save" class="btnAction">Sauvegarder</button>
                        <button type="submit" name="submit" value="save_and_select" class="btnAction">Sauvegarder et sélectionner</button>
                    @else

                        <button type="submit" name="submit" value="modif" class="btnAction">Modifier</button>

                    @endif
                    <button type="button" class="btnAction">Annuler</button>                    
                </div>
            

            
            
            
            </form>
            
        </div>
        <div class="col-md-6">
            <div class="d-flex flex-wrap" style="height: 80vh; overflow-y: auto; background-color: #7769FE;">
                @foreach ($images as $image)
                <div class="selectImage" data-id="{{$image->id}}" data-image="{{$image->name}}" >
                    <img src="{{asset('img/items/'.$image->name)}}" alt="" width="100%">

                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>


@endsection

