import { Modal } from 'bootstrap'

const selectSectionFiche = (ficheSelect) => {

    $(document).on('click','.caseLvl', function() {
        var id =$(this).closest('.card-footer2').data('id')
        var lvl = $(this).text()
        var that = $(this)
        $.get('/app/fiches/'+id+'/setLvl?lvl='+lvl, function(data) {
            $(that).toggleClass('active')
        })
    })

    $(document).on('click','.biblioModal', function() {
        var id = $('#section_id').val()
        $.get('/app/get_images/'+id+'?source=create', function(data) {

            $('#biblioModal .modal-body').html(data)
        })

    })

    $(document).on('click','.selectImage', function() {
        var image  = $(this).data('image')
        if ($(this).hasClass('create')) {
            $('#photoEnfantImg .dlImage').attr('src','/storage/items/'+image);
            $('#photoEnfantImg .dlImage').removeClass('d-none');
            $('#photoEnfantImg .logoImage').addClass('d-none');
            $('#imageName').val(image);           
        } else {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            console.log(image, ficheSelect)
            $.ajax({
                url: '/app/set_image',
                method:'POST',
                data: {
                    image: image,
                    fiche: ficheSelect
                },
                success: function(data) {
                    console.log(data)
                    $('.card_fiche[data-fiche="'+ficheSelect+'"]').find('.card__image img').attr('src', '/storage/items/'+image)

                }

            })

        }


        var myModalEl = document.getElementById('biblioModal');
        var modal = Modal.getInstance(myModalEl)
        modal.hide();
    })

    $(document).on('click','.biblioModalFiche', function() {
        var id = $(this).closest('.card_fiche').data('section')
        ficheSelect = $(this).closest('.card_fiche').data('fiche')
        $.get('/app/get_images/'+id+'?source=modif', function(data) {

            $('#biblioModal .modal-body').html(data)
        })

    })

    $(document).on('click','.biblioModalCategories', function() {
        var liste = $(this).data('categories')
        ficheSelect = $(this).closest('.card_fiche').data('fiche')
        $('#newCategorie').html(liste)
    })

    $(document).on('change','#newCategorie', function() {
        var id = $(this).val()
        var texte = $(this).find(':selected').text()
        console.log(texte)
        $.get('/app/setNewCategories?cat='+id+'&fiche='+ficheSelect, function() {
            $('.card_fiche[data-fiche="'+ficheSelect+'"]').find('.st').text(texte)
        })
        var myModalEl = document.getElementById('biblioModalCategories');
        var modal = Modal.getInstance(myModalEl)
        modal.hide();

        
    })


    $(document).on('click','.selectSectionFiche', function() {
        $('.selectSectionFiche').removeClass('selected')
        $(this).addClass('selected')
        var id = $(this).data('value')
        $('.tiret_selection').addClass('d-none')
        $('.tiret_selection[data-id="'+id+'"]').removeClass('d-none')
        $('.card_fiche').addClass('d-none')
        $('.card_fiche[data-section="'+id+'"]').removeClass('d-none')
        $('#SectionName').addClass('big')
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')                    }
        });
        $.ajax({
            data: {
                'section_id': id
            },
            url: "/app/fiches/populate/categorie",
                dataType:"html",
            type: "post",
           
            success: function(data) {   
                console.log(data)                      
                data = '<option value="null">Toutes les fiches</option>'+data;
                $("#categories").html(data);
            }
        })  

    })
    $(document).on('mouseenter','.selectSectionFiche', function() {
        var titre = $(this).data('titre')
        $('#SectionName').html(titre)
        $('#SectionName').removeClass('big')

    })
}

const selectFiche = (Modal) => {
    $(document).on('click','.selectionner', function() {
        console.log('coucou')
        
        var that = $(this).closest('.card_fiche')
        var id = $(that).data('fiche')
        var type = $(that).data('type')
        var table = $(that).data('table')
        var categorie = $(that).data('categorie')
        var section = $('.selectSectionFiche.selected').attr('data-value')

        var p = $('#mesfiches li[data-categorie="'+categorie+'"]').first()
        if (p.length) {

            $(that).detach().insertBefore(p)
        } else {
            $(that).detach().appendTo('#mesfiches ul')

        }
        
        var order = [];
        $('#mesfiches ul li').each((index, el) => {
            order[index] = $(el).data('fiche')
        })
        console.log('index', order)
        
        $.get('/app/fiches/choix?fiche='+id+'&section='+section+'&type='+type+'&table='+table+'&order='+order, function(data) {
            console.log('data', data, that, categorie)
            $(that).find('.selectionner').addClass('d-none')
            $(that).find('.retirer').removeClass('d-none')
            $(that).attr('data-selection', data)
        })
    })

    $(document).on('click','#biblio', function() {
        
        $('#biblio_container').toggleClass('d-none')
    })


    $(document).on('click','.deselectionneFiche', function() {
        var id =$(this).data('fiche')
        var that = $('.card_fiche[data-selection="'+id+'"]')
        $.get('/app/fiches/retirerChoix?fiche='+id+'&state=confirmation', function(data) {
            console.log(data)
            
                $(that).detach().appendTo('#autresfiches ul')
                $(that).find('.selectionner').removeClass('d-none')
                $(that).find('.retirer').addClass('d-none')   
        })
    })


    $(document).on('click','.retirer', function() {
        
        var that = $(this).closest('.card_fiche')
        var id = $(that).attr('data-selection')


        $.get('/app/fiches/retirerChoix?fiche='+id, function(data) {
            console.log(data)
            if (data == 'ok') {
                $(that).detach().appendTo('#autresfiches ul')
                $(that).find('.selectionner').removeClass('d-none')
                $(that).find('.retirer').addClass('d-none')                
            } else {
                var liste = '';
                for (var i = 0; i < data.length; i++) {
                    liste = liste + '<li>'+data[i]+'</li>';
                }
                console.log(liste)

                var myModalEl = document.getElementById('modalRetirerFiche');
                var modal = new Modal(myModalEl,{
                    backdrop: 'static', keyboard: false
                })
                $('#enfant_liste').html(liste)
                $('.deselectionneFiche').attr('data-fiche', id)
                modal.show() 
            }

        })
    })
}

const choixTypeFiches = (Modal) => {
    


    if ($('#form1[data-message="1"]').length) {
        var myModalEl = document.getElementById('successCreate');
        var modal = new Modal(myModalEl,{
            backdrop: 'static', keyboard: false
        })
        modal.show() 
    }
    
    $(document).on('click','.btnSelectionType', function() {
        if ($(this).hasClass('les_fiches')) {
            $('#categories').removeClass('d-none')
            $('.deletefiches').addClass('d-none')

        } else {
            $('#categories').addClass('d-none')
            $('.deletefiches').removeClass('d-none')
        }

        var section = $('.selectSectionFiche.selected').data('value') 
        $('.btnSelectionType').removeClass('selected')
        $(this).addClass('selected')
        var type = $(this).data('type')
        $('.listFiches').addClass('d-none')
        $("#"+type).removeClass('d-none')
        $('.triangle-code').removeClass('deploy')
        var position = $(this).data('position')
        $('.triangle-code.'+position).addClass('deploy')
        $('#categories').val("null")
        $('.card_fiche[data-section="'+section+'"]').removeClass('d-none')

    })

}

const initFiche = () => {
    $( function() {
        $( "#sortable" ).disableSelection();
        $( "#sortable" ).sortable({
            start: function() {
                $('#sortable').css('background-color', 'lightgray')
                $(this).find('.action').addClass('d-none')

            },
            top: function() {
                $('#sortable').css('background-color', 'transparent')
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
                    url: '/app/fiches/order',
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

const choixFiltre = (Modal) => {

    $(document).on('click','.croix', function() {
        location.reload()
    })


    $(document).on('click', '.phone .list-group-item-info', function() {
        var myModalEl = document.getElementById('modifyFicheModal');
        var modal = new Modal(myModalEl,{
           
        })
        var resultat = $(this).data('fiche')
        var enfant = $('#enfant').val()
        $.get('/app/getFiche?resultat='+resultat+'&enfant='+enfant, function(data) {

            $('#modifyFicheModal .modal-content').html(data)
            modal.show()

            
        }) 
        
    })

    $(document).on('click','.navigateur .list-group-item-info', function() {
        var resultat = $(this).data('fiche')
        var enfant = $('#enfant').val()
        $('.form_bloc').slideToggle()
        setTimeout(() => {
            $.get('/app/getFiche?resultat='+resultat+'&enfant='+enfant, function(data) {

                $('.fiche_modify').html(data)
                $('.card_item').removeClass('d-none')
                $('.fiche_modify_bloc').removeClass('d-none').slideDown()
                
            })            
        }, 400);

    })

    $(document).on('click','.ordreArray', function() {
        var ordre = $(this).data('ordre')
        $.get('/app/set_ordre?ordre='+ordre, function() {
            window.open('/app/enfants/cahier/manage', '_self')
        })
    })

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

    $(document).on('click','.deletefiches', function() {        
        $.get('/app/fiches/deselectionne', function(data) {
            window.location.reload()
        })

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
  


    $(document).on('change','#categories', function() {
        var id = $(this).val()
        var section = $('.selectSectionFiche.selected').data('value')
        if (id == 'null') {

            $('.card_fiche[data-section="'+section+'"]').removeClass('d-none')
        } else {

            $('.card_fiche[data-section="'+section+'"]').addClass('d-none')
            $('.card_fiche[data-categorie="'+id+'"][data-section="'+section+'"]').removeClass('d-none')
     
        }
    })

    $(document).on('change','#section_id', function() {
            var section = $(this).val()
            console.log(section)
            $.ajax({
                data: {
                    '_token': $("input[name='_token']").val(),
                    'section_id': section
                },
                url: "/app/fiches/populate/categorie",
                    dataType:"html",
                type: "post",
               
                success: function(data) {   
                    console.log(data)                      
 
                    $("#categorie_id").html(data);

                }
            })    
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
