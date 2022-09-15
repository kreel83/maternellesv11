


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
        $('#saveNouvellePhrase').attr('data-id', 'new')
        quill.setText('');
        quill.enable(true)
    })
}

const cancelNouvellePhrase = (quill) => {
    $('#cancelNouvellePhrase').on('click', function() {
        $('#controleNouvellePhrase').toggleClass('hide')
        $('#nouvellePhrase').toggleClass('hide')
        quill.setText('');
        quill.enable(false)
    })
}

const saveNouvellePhrase = (quill) => {
    $('#saveNouvellePhrase').on('click', function() {

        var data = quill.root.innerHTML
        var section = $(this).data('section')
        var id = $(this).data('id')
        $.ajax({
            method: 'POST',
            url: '/parametres/phrases/save',
            data: {
                id: id,
                section: section,
                quill: data
            },
            success: function(data) {
                $('#tableCommentaireContainer').html(data)
                deletePhrase(quill)
                editPhrase(quill)
            }
        })

        $('#controleNouvellePhrase').toggleClass('hide')
        $('#nouvellePhrase').toggleClass('hide')
        quill.setText('');
        quill.enable(false)
    })
}

const editPhrase = (quill) => {
    $('.editPhrase').on('click', function() {
        var data = $(this).closest('tr').find('td:first').html()
        var id = $(this).closest('td').data('id')
        $('#saveNouvellePhrase').attr('data-id', id)
        quill.setText('');
        quill.enable(true)
        quill.root.innerHTML = data
        $('#controleNouvellePhrase').toggleClass('hide')
        $('#nouvellePhrase').toggleClass('hide')

    })
}

const setMotCle = (quill) => {
    $('#motCle td').on('click', function() {
        var data = $(this).data('reg')
        var selection = quill.getSelection(true);
        quill.insertText(selection.index, data);
    })
}


export {selectPhrase, editPhrase, deletePhrase, nouvellePhrase, cancelNouvellePhrase, setMotCle, saveNouvellePhrase}
