<div class="d-flex justify-content-between my-2" id="filtre">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="ps_filter" checked>
        <label class="form-check-label" for="flexCheckChecked">
            petite section
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="ms_filter" checked>
        <label class="form-check-label" for="flexCheckChecked">
            Moyenne section
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="gs_filter" checked>
        <label class="form-check-label" for="flexCheckChecked">
            Grande section
        </label>
    </div>
    <button class="btn btn-primary btn-sm" id="jechoisislaselection" data-section="{{$section->id}}">Choisir les fiches de la sélection</button>
</div>
