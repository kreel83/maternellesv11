
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
        var texte = quill.root.innerHTML
        var enfant = $(this).data('enfant')
        var section = $(this).data('section')
        var periode = $(this).data('periode')
        $.ajax({
            method: 'POST',
            url: '/enfants/'+enfant+"/cahier/"+periode+"/save",
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
        var periode = $(this).data('periode')
        $.ajax({
            method: 'POST',
            url: '/enfants/'+enfant+"/cahier/"+periode+"/saveTexteReussite",
            data: {
                quill: quill.root.innerHTML,
                state: definitif
            },
            success: function(data) {

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
        var periode = $(this).data('periode')
        $.ajax({
            method: 'POST',
            url : '/enfants/' + enfant + '/cahier/' + periode + '/definitif',
            data: {
                state: definitif,
                quill: quill.root.innerHTML
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
        if ($(this).attr('id') == 'apercu') {
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
        if ($('#apercu').length) {

                var enfant = $('#apercu').data('enfant')
                var periode = $('#apercu').data('periode')
                $.get('/enfants/'+enfant+'/cahier/'+periode+'/apercu', function(data) {
                    quill.setText('');
                    quill.root.innerHTML = data
                })

        }
    })
}

export {choicePhrase, clickOnNav, saveTexte, onload, apercu, clickOnDefinif, saveTexteReussite}
