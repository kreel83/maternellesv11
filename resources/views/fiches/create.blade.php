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
        <button type="submit" name="submit" value="save" class="btn btn-outline-dark">Sauvegarder la nouvelle fiche</button>
        <button type="submit" name="submit" value="save_and_select" class="btn btn-outline-info">Sauvegarder et sélectionner la nouvelle fiche</button>
    @endif
    <button type="button" class="btn btn-outline-danger">Annuler</button>



</form>

