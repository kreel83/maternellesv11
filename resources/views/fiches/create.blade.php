@extends('layouts.mainMenu2', ['titre' => 'Mes fiches', 'menu' => $menu])

@section('content')





<div class="container-fluid row h-100">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">

        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('depart')}}">Tableau de bord</a></li>        
            <li class="breadcrumb-item active" aria-current="page">Création des fiches d'activité</li>
          </ol>
        </nav>
    <div class="col-md-6" style="padding: 0 5rem">


        @if ($new)
            <div class="label_create_fiche">Création de fiche</div>
        @else
            <h2>modification de la fiche {{$itemactuel->name}}</h2>
        @endif

        <form action="{{route('saveFiche')}}" method="post" id="form1" enctype="multipart/form-data">
        @csrf
            
            @if($duplicate)
                <input type="hidden" name="section_id" value="{{$section->id}}">
                <input type="hidden" name="categorie_id" value="{{$itemactuel->categorie_id}}">
                <input type="hidden" name="classification_id" value="{{$classification->id}}">
            @endif
            <input type="hidden" name="fiche_id" value="{{$new ? null : $itemactuel->id}}">
            <input type="hidden" name="duplicate" value="{{$duplicate}}">
            {{--<input type="hidden" name="provenance" value="{{$provenance}}">--}}
        
            <div>
                <select class="form-select my-4 form_section" onchange="populateCategorie(this.value);populateClassification(this.value)" id="section_id" name="section_id" {{ $duplicate ? 'disabled' : null }}>
                    <option value="" selected>Choisissez une section...</option>
                    @foreach ($sections as $sec)
                        <option value="{{$sec->id}}" {{isset($section->id) ? $sec->id == $section->id ? 'selected' : null : null}}>{{$sec->name}}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <select class="form-select my-4 form_section" id="categorie_id" name="categorie_id" {{ $duplicate ? 'disabled' : null }}>
                
                @if(!$new)
                    <option value="" selected>Choisissez une activité...</option>
                    @php
                        $x = '';
                    @endphp
                    @foreach ($categories as $cla)
                        @if($x != $cla->section1)
                            <option class="disabledtitle" disabled>{{$cla->section1}}</option>
                            @php
                                $x = $cla->section1;
                            @endphp
                        @endif
                        <option value="{{$cla->id}}" {{isset($itemactuel->categorie_id) ? $cla->id == $itemactuel->categorie_id ? 'selected' : null : null}}>{{$cla->section2}}</option>
                    @endforeach
                @endif
                
                </select>
            </div>
            <script>
                function populateCategorie(value) {
                    $.ajax({
                        data: {
                            '_token': $("input[name='_token']").val(),
                            'section_id': value
                        },
                        url: "{{route('populateCategorie')}}",
                        dataType:"html",
                        type: "post",
                        dataType: 'json',
                        success: function(data) {                         
                            var s = '<option value="">Sélectionnez une discipline</option>';
                            var x = '';
                            for (var i = 0; i < data.length; i++) {
                                if(x != data[i]['section1']) {
                                    s += '<option class="disabledtitle" disabled>' + data[i]['section1'] + '</option>';
                                    x = data[i]['section1'];
                                }
                                s += '<option value="' + data[i]['id'] + '"> - ' + data[i]['section2'] + '</option>';  
                            }  
                            $("#categorie_id").html(s);
                        }
                    });
                }
            </script>

            {{--
            <div>
                <select class="form-select my-4 form_section" id="classification_id" name="classification_id" {{ $duplicate ? 'disabled' : null }}>
                
                @if(!$new)
                    <option value="" selected>Choisissez une activité...</option>
                    @php
                        $x = '';
                    @endphp
                    @foreach ($classifications as $cla)
                        @if($x != $cla->section2)
                            <option class="disabledtitle" disabled>{{$cla->section2}}</option>
                            @php
                                $x = $cla->section2;
                            @endphp
                        @endif
                        <option value="{{$cla->id}}" {{isset($itemactuel->classification_id) ? $cla->id == $itemactuel->classification_id ? 'selected' : null : null}}>{{$cla->description}}</option>
                    @endforeach
                @endif
                
                </select>
            </div>
            <script>
                function populateClassification(value) {
                    $.ajax({
                        data: {
                            '_token': $("input[name='_token']").val(),
                            'section_id': value
                        },
                        url: "{{route('populateClassification')}}",
                        dataType:"html",
                        type: "post",
                        dataType: 'json',
                        success: function(data) {                         
                            var s = '<option value="">Sélectionnez une activité</option>';
                            var x = '';
                            for (var i = 0; i < data.length; i++) {
                                if(x != data[i]['section2']) {
                                    s += '<option class="disabledtitle" disabled>' + data[i]['section2'] + '</option>';
                                    x = data[i]['section2'];
                                }
                                //s += '<option value="' + data[i]['id'] + '">' + data[i]['section2'] + '</option>';  
                                s += '<option value="' + data[i]['id'] + '"> - ' + data[i]['description'] + '</option>';  
                            }  
                            $("#classification_id").html(s);
                        }
                    });
                }
            </script>
            --}}

            <style>

                .disabledtitle {
                    font-weight:bold;
                }
            </style>
            

            <div class="d-flex justify-content-between my-2 form_maternelle" id="filtre">
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
                        <div class="field field_v1 mt-3 form_titre">
                            <label for="titre" class="ha-screen-reader">Titre</label>
                            <input id="titre" class="field__input" placeholder="" name="name" value="{{$itemactuel ? $itemactuel->name : null}}">
                            <span class="field__label-wrap" aria-hidden="true">
                            <span class="field__label">Titre</span>
                            </span>
                        </div>
                        <div class="field field_v1 mt-3 form_sous_titre">
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
                <div class="col-md-4 mt-3 form_image">
        
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
            Phrase qui apparaitra dans le cahier de réussites. 
            <strong>Il convient de la rédiger au masculin</strong>.<br>
            Exemple générale : Il sait compter jusqu'à 5.
            <div id="editor3" class="mt-2 form_editeur" data-phrase="{{$itemactuel->phrase_masculin}}" data-section="" style="height: 100px; ">{!! ($itemactuel && !$new) ? $itemactuel->phrase : null !!}</div>
            <textarea class="d-none" name="phrase" id="phraseForm" style="width: 100%" rows="3">{!! ($itemactuel && !$new) ? $itemactuel->phrase : null !!}</textarea>

            <div class="alert alert-info mt-2 mb-2" role="alert">
                La phrase équivalente au féminin va être générée. Toutefois, si vous préférez la saisir 
                vous-même, <a href="#" onclick="$('.pf').show();$('.pf').focus();" class="alert-link">cliquez ici</a>.
            </div>

            <div class="pf" style="display:none">
                <textarea name="phrase_feminin" style="width: 100%" rows="3" placeholder="Ecrivez ici la même phrase au féminin...">{!! ($itemactuel && !$new) ? $itemactuel->phrase_feminin : null !!}</textarea>
            </div>


            <style>
                .item {
                    flex: 1 1 0;
                    width: 0;
                    margin: 4px
                    }
            </style>
            <!--
            <div class="d-flex mb-5 motCleFiche form_mot_cle">
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
            -->

            <div class="d-flex justify-content-between">
                @if ($new || $duplicate)
                    <button type="submit" name="submit" value="save" class="btnAction form_save">Sauvegarder</button>
                    <button type="submit" name="submit" value="save_and_select" class="btnAction form_save_select">Sauvegarder et sélectionner</button>
                @else
                    <button type="submit" name="submit" value="modif" class="btnAction">Sauvegarder</button>
                @endif
                <!--<button type="button" class="btnAction">Annuler</button>-->
            </div>
              
        </form>
            
        </div>

        <div class="col-md-6 h-100">
            <div class="d-flex flex-wrap" style="overflow-y: auto; background-color: #7769FE;">
                @foreach ($images as $image)
                    <div class="selectImage" data-id="{{$image->id}}" data-image="{{$image->name}}" >
                        <img src="{{asset('img/items/'.$image->name)}}" class="img-fluid" > <!-- width="100%" -->
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</div>


@endsection

