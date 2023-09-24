<style>
    #filtre label {
        display: block;
        width: 34px;
        height: 34px;
        background-color: #E5E3FF;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #7769FE;
        font-weight: 500;
        font-size: 14px;
        border-radius: 50%;
        cursor: pointer;
    }
    #filtre label.selected {
        font-weight: 700;

        background-color: #7769FE;
        color: #E5E3FF;
        border-radius: 1px solid #7769FE;
    }
</style>

<div class="d-flex justify-content-between align-items-center " id="filtre">
    <div class="pt-3 d-flex me-4 selection_classe" >
            <div class="form-check">
                <input class="form-check-input filtre_input invisible" type="checkbox" value="" id="ps_filter" checked>
                <label class="form-check-label selected" for="ps_filter">
                    PS
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input filtre_input invisible" type="checkbox" value="" id="ms_filter" checked>
                <label class="form-check-label selected" for="ms_filter">
                    MS
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input filtre_input invisible" type="checkbox" value="" id="gs_filter" checked>
                <label class="form-check-label selected" for="gs_filter">
                    GS
                </label>
            </div>        
    </div>

    <button class="btnSelection violet me-5" id="jechoisislaselection" data-section="{{$section->id}}">Choisir les fiches de la sélection</button>
</div>
