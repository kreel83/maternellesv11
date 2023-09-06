



const choicePhrase = (quill) => {
    $(document).on('keyup', '.searchPhrase', function (e) {
        var text = $(this).val()
        var element = $(this).closest('.partieDroite')
        $('.badge_phrase_container li').removeClass('d-none')
        $(element).find('.badge_phrase_container li').each((index, el) => {
            var phrase = $(el).text()
            if (!phrase.includes(text)) {
                $(el).addClass('d-none')
            }
        })
    })

    $(document).on('click','.raz_search_phrase', function(e) {
        $('.searchPhrase').val('')
        var element = $(this).closest('.partieDroite')
        $(element).find('.badge_phrase_container li').removeClass('d-none') 

    })

    $(document).on('click', '.badge_phrase', function () {
        $('.searchPhrase').val('')
        var el = $(this).closest('.section_container')
        var phrase = $(this).data('value')
        var id = $(this).closest('.badge_phrase_container').data('id')
        $(this).remove()
        $.get('/app/enfants/'+id+'/add_phrase/'+phrase, function(data) {
            $(el).find('.cadre_commentaire_complementaire ul').append(data)
        })
    })

    $(document).on('click', '.badge_phrase_selected', function () {
        var el = $(this).closest('.section_container')
        var phrase = $(this).data('phrase')
        var id = $(this).closest('.cadre_commentaire_complementaire').data('enfant')
        $(this).remove()
        $.get('/app/enfants/'+id+'/remove_phrase/'+phrase, function(data) {
            $(el).find('.badge_phrase_container ul').append(data)
        })
    })
    //var debounce = null;
    // $(document).on('keydown', '#editor', function (e) {
    //     clearTimeout(debounce);
    //     debounce = setTimeout(function(){
    //         $('.saveTexte').trigger('click')
    //     }, 3000);
    // });

    // $(document).on('keydown', '#editor', function (e) {
    //     clearTimeout(debounce);
    //     debounce = setTimeout(function(){
    //         $('.saveTexte').trigger('click')
    //     }, 3000);
    // });


   
    // quill.on('text-change', function(delta, source) {
    //     clearTimeout(debounce);
    //     $('.saveTexte').addClass('saving').removeClass('saved')
    //     debounce = setTimeout(function(){
    //         $('.saveTexte').trigger('click')
    //         $('.saveTexte').addClass('saved').removeClass('saving')
    //     }, 500);
    //   });
}


    


const saveCommentaireDefinitif = (quill, quill2) => {

}

const saveTexte = (quill) => {
    $(document).on('click','.saveTexte', function() {
        var texte = quill.root.innerHTML
        var enfant = $(this).data('enfant')
        var section = $(this).data('section')
        $('.sectionCahier[data-section="'+section+'"]').attr('data-textes', texte)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: 'POST',
            url: '/app/enfants/'+enfant+"/cahier/save",
            data: {
                texte: texte,
                section: section
            },
            success: function(data) {
                $('.sectionCahier[data-section="'+section+'"]').attr('data-texte', texte)
                $('.saveTexte').addClass('saved').removeClass('saving')
            }
        })
    })
}

const saveTexteReussite = (quill) => {



}



const clickOnCahier = (quill, myModal) => {
    $(document).on('click','#reformuler', function() {
        var texte = quill.root.innerHTML
        var enfant = $(this).data('enfant')
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: 'POST',
            url: '/app/enfants/'+enfant+'/cahier/reformuler',
            data: {
                quill: texte,
            },
            success: function(data) {
                quill.root.innerHTML = data
            }
        })
    })
    $(document).on('click','#CommitGeneratePDF', function() {
        myModal.hide();
        $('#titreSection').text('Génération du cahier de réussite')
        $('.blocApercu').removeClass('d-none')     
        $('.blocSelectFiche').addClass('d-none')   
        var enfant = $('.degrade_card_enfant').attr('data-enfant')
        $.get('/app/cahiers/get_apercu/'+enfant, function(data) {
            var selection = quill.getSelection(true);
            quill.setText('');
            quill.root.innerHTML = data   

        })
     })

    $(document).on('mouseenter','.sectionApercu', function() {
        $('#SectionName').text('Génération du cahier de réussite')
     })
    $(document).on('click','.sectionApercu', function() { 
        
        myModal.show();

        // $('.blocApercu').removeClass('d-none')     
        // $('.blocSelectFiche').addClass('d-none')   
        // var enfant = $(this).closest('#cahierView').attr('data-enfant')
        // $.get('/app/cahiers/get_apercu/'+enfant, function(data) {
        //     var selection = quill.getSelection(true);
        //     quill.setText('');
        //     quill.root.innerHTML = data   

        // })
        // var phrase = $(this).attr('data-phrases')
        // var texte = $(this).attr('data-textes')
        // var section = $(this).attr('data-section')

        // $('.tab-pane').removeClass('show active')
        // $('.tab-pane[data-id="nav-'+section+'"]').addClass('show active')


        // $('#phraseContainer').html(phrase)  
        // var selection = quill.getSelection(true);
        // quill.setText('');
        // quill.root.innerHTML = texte        
        // $('.saveTexte').attr('data-section', section)
        
        // $.get('/app/get_liste_phrase/'+section+'/'+enfant, function(data) {
        //     $('.badge_phrase_container').html(data)
        // })
    })
}

const clickOnNav = () => {
    $(document).on('click','.sectionCahier', function() { 
        $('.searchPhrase').val('')  
        $('.blocApercu').addClass('d-none')     
        $('.blocSelectFiche').removeClass('d-none')     
        var titre = $(this).attr('data-titre')
        var section = $(this).attr('data-section')
        var enfant = $(this).closest('#cahierView').attr('data-enfant')

        $('.tab-pane').removeClass('show active')
        $('.tab-pane[data-id="nav-'+section+'"]').addClass('show active')

        $('.titreSection').text(titre)


        // $('#phraseContainer').html(phrase)
        // var selection = quill.getSelection(true);
        // quill.setText('');
        // quill.root.innerHTML = texte        
        // $('.saveTexte').attr('data-section', section)
        
        $.get('/app/get_liste_phrase/'+section+'/'+enfant, function(data) {
            $('.badge_phrase_container').html(data)
        })
    })


}

const phraseCommentaireGeneral = () => {
    $(document).on('change','#phraseCommentaireGeneral', function() {
        let texte = $(this).val();
        texte = texte + '\n';
        $('#commentaire_general').val(function(i, text) {
            return text + texte;
        });
        $('#phraseCommentaireGeneral').val('null')
    })
}

const saveCommentaireGeneral = (quill) => {
    $(document).on('click','#saveCommentaireGeneral', function() {
        // const definitif = $(this).prop('checked')
        var enfant = $(this).data('enfant')
        var reussite = quill.root.innerHTML
        var commentaireGeneral = $('#commentaire_general').val()

       
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')                    }
        });
        $.ajax({
            method: 'POST',
            url : '/app/enfants/' + enfant + '/cahier/saveCommentaireGeneral',
            data: {
                reussite: reussite,
                commentaireGeneral: commentaireGeneral
            },
            success: function(data) {
                location.reload(true);
            }
        })
    })
}


const clickOnDefinif = (quill) => {

    var debounce = null

    $(document).on('text-change focusout','#editorApercu', function() {

        clearTimeout(debounce);
        debounce = setTimeout(function(){
            var texte = quill.root.innerHTML
            var enfant = $('#editorApercu').data('enfant')
            console.log('done')
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: 'POST',
                url: '/app/enfants/'+enfant+"/cahier/save",
                data: {
                    texte: texte,                    
                },
                success: function(data) {
                    console.log(data)

                }
            })
        }, 5000);
    });

    

    $(document).on('click','#reactualiser', function() {
        var enfant = $(this).data('enfant')
        quill.setText('');

            
            $.get('/app/enfants/'+enfant+'/cahier/reactualiser', function(data) {
                var selection = quill.getSelection(true);
                quill.root.innerHTML = data               
                $('.progress-container').addClass('d-none')                          
            })
      


    })

    $(document).on('change','#definitif', function() {
        const definitif = $(this).prop('checked')
        $('.labelDefinitif').removeClass('active')
        if (definitif) {
            $('.labelDefinitifDroit').addClass('active')
        } else {
            $('.labelDefinitifGauche').addClass('active')
        }
        var enfant = $(this).data('enfant')
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: 'POST',
            url : '/app/enfants/' + enfant + '/cahier/definitif',
            data: {
                state: definitif,
                quill: quill.root.innerHTML
            },
            success: function(data) {
                if (definitif == true) {
                    quill.enable(false)
                    $('#reactualiser').addClass('d-none')
                    $('#pdf').removeClass('d-none')
                } else {
                    $('#reactualiser').removeClass('d-none')
                    $('#pdf').addClass('d-none')
                    quill.enable(true)
                }
            }
        })
    })
}



const apercu = (quill) => {
    $(document).on('click', '.nav-link', function() {
        if ($(this).attr('id') == 'apercu') {
            var enfant = $(this).data('enfant')
            var periode = $(this).data('periode')
            $.get('/app/enfants/'+enfant+'/cahier/'+periode+'/apercu', function(data) {
                $('#editor').css('height', '800px')
                quill.setText('');
                quill.root.innerHTML = data
                if ($('#definitif').prop('checked')) {
                    quill.enable(false)
                }
            })
        } else {
            $('#editor').css('height', '400px')
        }

    })
}

const onload = (quill) => {
    $(document).ready(function() {

        if ($('#motCle').length) {

            quill.setText("")
            quill.enable(false)
            $('#editor').css('height','200px')
        }
        if ($('#nav-apercu').length) {
            var reussite = $('#nav-apercu').data('reussite')
                    $('#editor').css('height','700px')
                    quill.setText('');
                    quill.root.innerHTML = reussite


        }
    })
}



export {choicePhrase, clickOnNav, saveTexte, onload, apercu, clickOnDefinif, saveTexteReussite, phraseCommentaireGeneral, saveCommentaireGeneral, clickOnCahier}
