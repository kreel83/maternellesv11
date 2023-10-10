const selectSectionFiche = (quill) => {
    $(document).on('click','.selectSectionFiche', function() {
        $('.selectSectionFiche').removeClass('selected')
        $(this).addClass('selected')
        var id = $(this).data('value')
        $('.tiret_selection').addClass('d-none')
        $('.tiret_selection[data-id="'+id+'"]').removeClass('d-none')
        $('.card_fiche').addClass('d-none')
        $('.card_fiche[data-section="'+id+'"]').removeClass('d-none')
        $('#SectionName').addClass('big')

    })
    $(document).on('mouseenter','.selectSectionFiche', function() {
        var titre = $(this).data('titre')
        $('#SectionName').html(titre)
        $('#SectionName').removeClass('big')

    })
}

const selectFiche = () => {
    $(document).on('click','.selectionner', function() {
        console.log('coucou')
        
        var that = $(this).closest('.card_fiche')
        var id = $(that).data('fiche')
        var type = $(that).data('type')
        var table = $(that).data('table')
        var section = $('.selectSectionFiche.selected').attr('data-value')

        $.get('/app/fiches/choix?fiche='+id+'&section='+section+'&type='+type+'&table='+table, function(data) {
            console.log('data', data, that)
            $(that).detach().appendTo('#mesfiches ul')
            $(that).find('.selectionner').addClass('d-none')
            $(that).find('.retirer').removeClass('d-none')
            $(that).attr('data-selection', data)
        })
    })

    $(document).on('click','.retirer', function() {
        
        var that = $(this).closest('.card_fiche')
        var id = $(that).attr('data-selection')


        $.get('/app/fiches/retirerChoix?fiche='+id, function(data) {
            $(that).detach().appendTo('#autresfiches ul')
            $(that).find('.selectionner').removeClass('d-none')
            $(that).find('.retirer').addClass('d-none')
        })
    })
}

const choixTypeFiches = () => {
    $(document).on('click','.btnSelectionType', function() {
        $('.btnSelectionType').removeClass('selected')
        $(this).addClass('selected')
        var type = $(this).data('type')
        $('.listFiches').addClass('d-none')
        var section = $("#"+type).removeClass('d-none')
        $('.triangle-code').removeClass('deploy')
        var position = $(this).data('position')
        $('.triangle-code.'+position).addClass('deploy')

    })
    $(document).on('click','.selectImage', function() {
        var image  = $(this).data('image')
        $('#photoEnfantImg .dlImage').attr('src','/img/items/'+image);
        $('#photoEnfantImg .dlImage').removeClass('d-none');
        $('#photoEnfantImg .logoImage').addClass('d-none');
        $('#imageName').val($(this).data('id'));
    })
}

const initFiche = () => {
    $( function() {
        $( "#sortable" ).disableSelection();
        $( "#sortable" ).sortable({
            start: function() {
                $('#sortable').css('background-color', 'red')
                $(this).find('.action').addClass('d-none')

            },
            stop: function() {
                $(this).find('.action').removeClass('d-none')
                let pos = []
                let section = $('.selectSectionFiche.selected').data('value');
                console.log(section)
                $('.card_fiche[data-type="mesfiches"][data-section="'+section+'"]').each((index, el) => {
                    console.log(el)
                    pos.push($(el).attr('data-selection'))
                })
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')                    }
                });
                $.ajax({
                    method: 'POST',
                    url: '/fiches/order',
                    data : {
                        pos: pos,
                        section: section
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

    $(document).on('click','.coder', function() {
        console.log('coucou')
        var el = $(this).closest('.actiontemp')
        $(el).find('.coder').removeClass('active')
        $(this).addClass('active')
        var classe = $(this).data('id')
        var item = $(this).data('fiche')
        $.get('/app/fiches/setClassification?item='+item+'&classe='+classe, function(data) {
            console.log(data)
        })

    })
    $(document).on('change','.filtre_input', function() {
        $(this).next().toggleClass('selected')
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
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: 'POST',
            url: '/app/fiches/choisirSelection',
            data: {
                section: section,
                tableau: JSON.stringify(tab)
            },
            success: function() {
                window.open('/app/fiches?section='+section+'&type=mesfiches','_self')
            }

        })
    })
}

const jemodifielafiche = () => {
    $(document).on('click','.modifyFiche', function() {
        var item = $(this).data('id')
        var section = $(this).data('section')
        window.open('/app/fiches?section='+section+'&type=createfiche&item='+item,'_self')

    })

    $(document).on('click','.createfiche, .modifier, .dupliquer', function() {        
        var duplicate = ($(this).hasClass('dupliquer')) ? true : false;
        var section = $('.selectSectionFiche.selected').data('value') 
        if ($(this).hasClass('modifier') || $(this).hasClass('dupliquer')) {
            var item = $(this).data('id')
        } else {
            var item = "new";
        }
        window.open('/app/fiches/create?section='+section+'&item='+item+'&duplicate='+duplicate,'_self')

    })
}

const jeducpliquelafiche = () => {
    $(document).on('click','.duplicate_card', function() {
        var item = $(this).data('id')
        var section = $(this).data('section')
        var provenance = $(this).data('provenance')
        $.get('/app/fiches/duplicate?section='+section+'&item='+item+'&provenance='+provenance, function(data) {
            window.open('/app/fiches?section='+section+'&type=mesfiches&item='+item,'_self')
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
                $('.logoImage').addClass('d-none')
                $('.dlImage').removeClass('d-none')
                $("#photoEnfantImg img").attr("src", reader.result);
            }

            reader.readAsDataURL(file);
        }
    })
}

const setMotCleFiche= (quill) => {
    if ($('#editor3').length) {
        quill.setText($('#editor3').data('phrase'));
    }

    $('.motCleFiche .item').on('click', function() {
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
