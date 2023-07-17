<div class="d-flex justify-content-between align-items-center " id="filtre">
    <div class="pt-3 d-flex me-2" >
            <div class="form-check me-2">
                <input class="form-check-input filtre_input" type="checkbox" value="" id="ps_filter" checked>
                <label class="form-check-label" for="flexCheckChecked">
                    PS
                </label>
            </div>
            <div class="form-check me-2">
                <input class="form-check-input filtre_input" type="checkbox" value="" id="ms_filter" checked>
                <label class="form-check-label" for="flexCheckChecked">
                    MS
                </label>
            </div>
            <div class="form-check me-2">
                <input class="form-check-input filtre_input" type="checkbox" value="" id="gs_filter" checked>
                <label class="form-check-label" for="flexCheckChecked">
                    GS
                </label>
            </div>        
    </div>

    <button class="btnSelection violet" id="jechoisislaselection" data-section="{{$section->id}}">Choisir les fiches de la sélection</button>
</div>
