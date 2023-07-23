



const choicePhrase = (quill) => {
    $(document).on('click', '.badge_phrase', function () {
        var phrase = $(this).text()
        console.log(phrase)
        var selection = quill.getSelection(true);
        quill.insertText(selection.index, phrase+'\n')
        $(this).remove()

    })
}

const saveCommentaireDefinitif = (quill, quill2) => {

}

const saveTexte = (quill) => {
    $(document).on('click','.saveTexte', function() {
        var texte = quill.getText()
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
            }
        })
    })
}

const saveTexteReussite = (quill) => {
    $(document).on('click','.saveTexteReussite', function() {

        var enfant = $(this).data('enfant')
        var definitif = $('#definitif').prop('checked')
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: 'POST',
            url: '/enfants/'+enfant+"/cahier/saveTexteReussite",
            data: {
                quill: quill.root.innerHTML,
                state: definitif
            },
            success: function(data) {
                location.reload()
            }
        })
    })
}



const clickOnNav = (quill) => {
    $(document).on('click','.sectionCahier', function() {        
        var phrase = $(this).attr('data-phrases')
        var texte = $(this).attr('data-textes')
        var section = $(this).attr('data-section')
        var enfant = $(this).closest('#cahierView').attr('data-enfant')
        $('#phraseContainer').html(phrase)
        console.log(phrase)
        var selection = quill.getSelection(true);
        quill.setText('');
        quill.root.innerHTML = texte        
        $('.saveTexte').attr('data-section', section)
        
        $.get('/app/get_liste_phrase/'+section+'/'+enfant, function(data) {
            $('.badge_phrase_container').html(data)
        })
    })
}

const phraseCommentaireGeneral = () => {
    $(document).on('change','#phraseCommentaireGeneral', function() {
        let texte = $(this).val();
        texte = texte + '\n';
        console.log(texte);
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
    $(document).on('change','#definitif', function() {
        const definitif = $(this).prop('checked')
        var enfant = $(this).data('enfant')
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: 'POST',
            url : '/enfants/' + enfant + '/cahier/definitif',
            data: {
                state: definitif,
                quill: quill.getText()
            },
            success: function(data) {
                console.log(definitif)
                if (definitif == true) {
                    quill.enable(false)
                } else {
                    quill.enable(true)
                }
            }
        })
    })
}



const apercu = (quill) => {
    $(document).on('click', '.nav-link', function() {
        console.log('coucou')
        if ($(this).attr('id') == 'apercu') {
            console.log('caca')
            var enfant = $(this).data('enfant')
            var periode = $(this).data('periode')
            $.get('/app/enfants/'+enfant+'/cahier/'+periode+'/apercu', function(data) {
                $('#editor').css('height', '800px')
                quill.setText('');
                console.log(data)
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
            console.log(reussite)
                    $('#editor').css('height','700px')
                    quill.setText('');
                    quill.root.innerHTML = reussite


        }
    })
}



export {choicePhrase, clickOnNav, saveTexte, onload, apercu, clickOnDefinif, saveTexteReussite, phraseCommentaireGeneral, saveCommentaireGeneral}
