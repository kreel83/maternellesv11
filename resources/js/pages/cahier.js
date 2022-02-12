
window.Quill = require('Quill');
export default Quill;



const choicePhrase = (quill) => {
    $(document).on('change', '.phrase', function () {
        var ph = $(this).find(':selected').text()
        var section  = $(this).data('section')
        var enfant = $(this).data('enfant')
        var that = $(this)

        $.ajax({
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
        })
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

const apercu = (quill) => {
    $(document).on('click', '#apercu', function() {
        var enfant = $(this).data('enfant')
        var periode = $(this).data('periode')
        $.get('/enfants/'+enfant+'/cahier/'+periode+'/apercu', function(data) {
            quill.setText('');
            quill.root.innerHTML = data
        })
    })
}

const onload = (quill) => {
    $(document).ready(function() {
        var enfant = $('#apercu').data('enfant')
        var periode = $('#apercu').data('periode')
        $.get('/enfants/'+enfant+'/cahier/'+periode+'/apercu', function(data) {
            quill.setText('');
            quill.root.innerHTML = data
        })
    })

}

export {choicePhrase, clickOnNav, saveTexte, onload, apercu}
