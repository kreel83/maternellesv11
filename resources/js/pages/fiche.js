const selectSectionFiche = (quill) => {
    $(document).on('change','#selectSectionFiche', function() {
        var id = $(this).val()
        window.open('/fiches?section='+id,'_self')
    })
}

const selectFiche = () => {
    $(document).on('dblclick','.card_fiche', function() {
        var id = $(this).data('fiche')
        var type = $(this).data('type')
        var table = $(this).data('table')
        var that = $(this)

        var section = $('#nav-tabContent').data('section')
        $.get('/fiches/choix?fiche='+id+'&section='+section+'&type='+type+'&table='+table, function(data) {
            $(that).remove()
        })
    })
}

const choixTypeFiches = () => {
    $(document).on('click','#choixFiche button', function() {
        var type = $(this).data('type')
        var section = $("#choixFiche").data('section')
        window.open('/fiches?section='+section+'&type='+type,'_self')
    })
}

const initFiche = () => {
    $( function() {
        $( "#sortable" ).sortable({
            start: function() {

            },
            stop: function() {
                let pos = []
                $('.card_fiche[data-type="mesfiches"]').each((index, el) => {
                    console.log(el)
                    pos.push($(el).data('fiche'))
                })
                $.ajax({
                    method: 'POST',
                    url: '/fiches/order',
                    data : {
                        pos: pos,
                        secteur: $('#selectSectionFiche').val()
                    },
                    success: function() {
                        console.log('ok')
                    }
                })
            }
        });
    } );
}

const choixFiltre = () => {
    $(document).on('change','#filtre input', function() {
        var c = []
        $('#filtre input').each((index, el) => {
            c.push($(el).is(':checked') ? 1 : 0)
        })
        console.log(c)
         $('.card_fiche').each((index, that) => {
             $(that).attr('hidden', true)
            var lvl = $(that).data('level')
             var state = false
             if (!state && (lvl[0] == 1 && c[0] == 1)) {state = true}
             if (!state && (lvl[1] == 1 && c[1] == 1)) {state = true}
             if (!state && (lvl[2] == 1 && c[2] == 1)) {state = true}
             console.log(state)
             if (state) $(that).attr('hidden', false)
         })

    })
}

const jechoisislaselection = () => {
    $(document).on('click','#jechoisislaselection', function() {
        var section = $(this).data('section')
        var tab = [];
         $('.card_fiche:visible').each((index, that) => {
             var t = {}
             t['item'] = $(that).data('fiche')
             t['test'] = $(that).data('table')
            tab.push(t)
         })
        $.ajax({
            method: 'POST',
            url: '/fiches/choisirSelection',
            data: {
                section: section,
                tableau: JSON.stringify(tab)
            },
            success: function() {
                window.open('/fiches?section='+section+'&type=mesfiches','_self')
            }

        })
    })
}

const jemodifielafiche = () => {
    $(document).on('click','.modifyFiche', function() {
        var item = $(this).data('id')
        var section = $(this).data('section')
        window.open('/fiches?section='+section+'&type=createfiche&item='+item,'_self')

    })
}

const jeducpliquelafiche = () => {
    $(document).on('click','.duplicate_card', function() {
        var item = $(this).data('id')
        var section = $(this).data('section')
        var provenance = $(this).data('provenance')
        $.get('/fiches/duplicate?section='+section+'&item='+item+'&provenance='+provenance, function(data) {
            window.open('/fiches?section='+section+'&type=mesfiches&item='+item,'_self')
        })


    })
}

const editor2change = (quill) => {
    quill.on('text-change', function(delta, oldDelta, source) {
        var texte = quill.root.innerHTML
        $('#phraseForm').val(texte)
    })
}


const photoEnfantTrigger = () => {
    $(document).on('click','#photoEnfantImg', function() {
        $('#photoEnfantInput').trigger('click')
    })
}

const photoEnfant = () => {
    $(document).on("change",'#photoEnfantInput', function() {
        const file = $(this).get(0).files[0];
        if (file) {
            var reader = new FileReader();

            reader.onload = function(){
                $("#photoEnfantImg").attr("src", reader.result);
            }

            reader.readAsDataURL(file);
        }
    })
}

const setMotCleFiche= (quill) => {
    $('#motCleFiche td').on('click', function() {
        var data = $(this).data('reg')
        var selection = quill.getSelection(true);
        quill.insertText(selection.index, data);
    })
}

export {jeducpliquelafiche, jemodifielafiche, initFiche, selectSectionFiche, selectFiche, choixTypeFiches, choixFiltre, jechoisislaselection, photoEnfant, photoEnfantTrigger, editor2change, setMotCleFiche}
