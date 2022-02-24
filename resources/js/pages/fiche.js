const selectSectionFiche = (quill) => {
    $(document).on('change','#selectSectionFiche', function() {
        var id = $(this).val()
        window.open('/fiches?id='+id,'_self')
    })
}

const selectFiche = () => {
    $(document).on('dblclick','.card_fiche', function() {
        var id = $(this).data('fiche')
        var that = $(this)
        $.get('/fiches/choix?fiche='+id, function(data) {
            $(that).remove()
        })
    })
}

const choixTypeFiches = () => {
    $(document).on('click','#choixFiche td', function() {
        var type = $(this).data('type')
        var id = $("#choixFiche").data('section')
        window.open('/fiches?id='+id+'&type='+type,'_self')
    })
}

export {selectSectionFiche, selectFiche, choixTypeFiches}
