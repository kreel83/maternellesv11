const selectSectionFiche = (quill) => {
    $(document).on('click','.selectSectionFiche', function() {
        $('.selectSectionFiche').removeClass('selected')
        $(this).addClass('selected')
        var id = $(this).data('value')
        $('.card_fiche').addClass('d-none')
        $('.card_fiche[data-section="'+id+'"]').removeClass('d-none')
        var color = $(this).css('background-color')
        $('.triangle-code').css('border-top-color', color)
        $('.btnSelection').css('background-color', color)
    })
}

const selectFiche = () => {
    $(document).on('click','.selectionner', function() {
        console.log('coucou')
        
        var that = $(this).closest('.card_fiche')
        var id = $(that).data('fiche')
        var type = $(that).data('type')
        var table = $(that).data('table')
        var section = $('#nav-tabContent').data('section')

        $.get('/fiches/choix?fiche='+id+'&section='+section+'&type='+type+'&table='+table, function(data) {
            $(that).detach().appendTo('#mesfiches ul')
            $(that).find('.selectionner').addClass('d-none')
            $(that).find('.retirer').removeClass('d-none')
        })
    })

    $(document).on('click','.retirer', function() {
        
        var that = $(this).closest('.card_fiche')
        var id = $(that).data('fiche')
        var type = $(that).data('type')
        var table = $(that).data('table')
        var section = $('#nav-tabContent').data('section')

        $.get('/fiches/choix?fiche='+id+'&section='+section+'&type='+type+'&table='+table, function(data) {
            $(that).detach().appendTo('#autresfiches ul')
            $(that).find('.selectionner').removeClass('d-none')
            $(that).find('.retirer').addClass('d-none')
        })
    })
}

const choixTypeFiches = () => {
    $(document).on('click','.btnSelection', function() {
        var type = $(this).data('type')
        $('.listFiches').addClass('d-none')
        var section = $("#"+type).removeClass('d-none')
        $('.triangle-code').removeClass('deploy')
        var position = $(this).data('position')
        $('.triangle-code.'+position).addClass('deploy')

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
    $(document).on('change','.filtre_input', function() {
        var c = []
        $('.filtre_input').each((index, el) => {
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
        var texte = quill.getText()
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

const choixSection = () => {

    $('.card-section').on('click', function() {
        var id = $(this).data('id')
        console.log(id)
        $('#liste .card').addClass('d-none')
        $('#liste .card[data-section="'+id+'"]').removeClass('d-none')
    })
}

export {choixSection ,jeducpliquelafiche, jemodifielafiche, initFiche, selectSectionFiche, selectFiche, choixTypeFiches, choixFiltre, jechoisislaselection, photoEnfant, photoEnfantTrigger, editor2change, setMotCleFiche}
