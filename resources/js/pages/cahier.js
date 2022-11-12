
window.Quill = require('Quill');
export default Quill;



const choicePhrase = (quill) => {
    $(document).on('change', '.phrase', function () {
        var ph = $(this).find(':selected').text()
        var section  = $(this).data('section')
        var enfant = $(this).data('enfant')
        var that = $(this)
        var phrase = $(this).find(':selected').text()
        console.log(phrase)
        var selection = quill.getSelection(true);
        quill.insertText(selection.index, phrase+'\n')
        $(that).val('null')

        /*$.ajax({
            method: 'POST',
            url: "/enfants/"+enfant+"/translate",
            data: {
                phrase: ph,
                enfant: enfant
            },
            success: function (data) {
                console.log(data)
                var selection = quill.getSelection(true);
                quill.insertText(selection.index, data+'\n')
                $(that).val('null')
            }
        })*/
    })
}



const saveTexte = (quill) => {
    $(document).on('click','.saveTexte', function() {
        var texte = quill.getText()
        var enfant = $(this).data('enfant')
        var section = $(this).data('section')
        $.ajax({
            method: 'POST',
            url: '/enfants/'+enfant+"/cahier/save",
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
        console.log(window.section_active)
/*        if (window.section_active && window.active != 'null') {
            $('.saveTexte[data-section="'+window.section_active+'"]').trigger('click')
        }*/
        window.section_active = $(this).data('section')
        var texte = $(this).attr('data-texte')
        var selection = quill.getSelection(true);
        quill.setText('');
        quill.root.innerHTML = texte
    })
}

const clickOnDefinif = (quill) => {
    $(document).on('change','#definitif', function() {
        const definitif = $(this).prop('checked')
        var enfant = $(this).data('enfant')
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
            $.get('/enfants/'+enfant+'/cahier/'+periode+'/apercu', function(data) {
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



export {choicePhrase, clickOnNav, saveTexte, onload, apercu, clickOnDefinif, saveTexteReussite}
