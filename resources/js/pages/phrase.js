
const selectPhrase = () => {
    $('#selectPhrase').on('change', function() {
        var id = $(this).val()
        window.open('/parametres/phrases?section='+id,'_self')
    })
}

const deletePhrase = () => {
    $('.deletePhrase').on('click', function() {
        var id = $(this).closest('.controle').data('id')
        var el = $(this).closest('tr')
        $.get('/parametres/phrases/'+id+'/delete', function(data) {
            $(el).remove()
        })
    })
}

const nouvellePhrase = (quill) => {
    $('#nouvellePhrase').on('click', function() {
        $('#controleNouvellePhrase').toggleClass('hide')
        $(this).toggleClass('hide')
        quill.setText('');
    })
}

const cancelNouvellePhrase = (quill) => {
    $('#cancelNouvellePhrase').on('click', function() {
        $('#controleNouvellePhrase').toggleClass('hide')
        $('#nouvellePhrase').toggleClass('hide')
        quill.setText('');
    })
}

const saveNouvellePhrase = (quill) => {
    $('#saveNouvellePhrase').on('click', function() {
        var quill = quill.root.innerHTML
        var section = $(this).data('section')
        $.ajax({
            method: 'POST',
            url: '/paramestres/phrases/new',
            data: {
                section: section,
                quill: quill
            },
            success: function(data) {
                $('#tableauDesPhrases').html(data)
            }
        })

        $('#controleNouvellePhrase').toggleClass('hide')
        $('#nouvellePhrase').toggleClass('hide')
        quill.setText('');
    })
}

const editPhrase = (quill) => {
    $('.editPhrase').on('click', function() {
        var data = $(this).closest('tr').find('td:first').html()
        quill.setText('');
        quill.root.innerHTML = data

    })
}


export {selectPhrase, editPhrase, deletePhrase, nouvellePhrase, cancelNouvellePhrase}
