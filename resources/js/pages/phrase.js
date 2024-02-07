


const selectPhrase = () => {
    $('#selectPhrase').on('change', function() {
        var id = $(this).val()
        window.open('/app/parametres/phrases?section='+id,'_self')
    })

    $(document).on('click','.sectionPhrase', function() {   
        var id = $(this).data('section')
        window.open('/app/parametres/phrases?section='+id,'_self')
    })





}

const deletePhrase = () => {
    $('.deletePhrase').on('click', function() {
        var id = $(this).closest('.phrase_bloc').attr('data-id')
        var el = $(this).closest('.phrase_bloc')
        $.get('/app/parametres/phrases/'+id+'/delete', function(data) {
            console.log('data', data)
            if (data == 'ok') {
                $(el).remove()
            } 
        })
    })
}

const nouvellePhrase = (quill) => {
    // quill.on('text-change', function() {
    //     alert('cc')
    // })

    $('#editor2').on('keyup',function(e) {
        console.log(e.key, e.ctrlKey, e.altKey)
        if (e.key == 'p' && e.altKey ) {
            var data = "L'élève ";
            var selection = quill.getSelection(true);
            quill.insertText(selection.index, data);
            

            
        }
    })

    $('.seePhrase').on('click', function() {
        $('#controleNouvellePhrase').toggleClass('d-none d-flex')
        $('#bloc_editor').toggleClass('d-none d-flex')
        $(this).toggleClass('d-none')
        $('#saveNouvellePhrase').attr('data-id', 'new')
        quill.setText('');
        quill.enable(true)
    })

    $('#nouvellePhrase').on('click', function() {
        $('#controleNouvellePhrase').toggleClass('d-none d-flex')
        $('#bloc_editor').toggleClass('d-none d-flex')
        $(this).toggleClass('d-none')
        $('#bloc_2phrases').addClass('d-none').removeClass('d-flex')
        $('#saveNouvellePhrase').attr('data-id', 'new')
        quill.setText('');
        quill.enable(true)
    })
}

const cancelNouvellePhrase = (quill) => {
    $('#cancelNouvellePhrase').on('click', function() {
        $('#controleNouvellePhrase').toggleClass('d-none d-flex')
        $('#nouvellePhrase').toggleClass('d-none')
        $('#bloc_editor').toggleClass("d-none d-flex")
        quill.setText('');
        quill.enable(false)
    })
}

const saveNouvellePhrase = (quill) => {
    $('#saveNouvellePhrase').on('click', function() {

        var data = quill.getText()
        var section = $(this).data('section')
        var id = $(this).data('id')
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')                    }
        });
        $.ajax({
            method: 'POST',
            url: '/app/parametres/phrases/save',
            data: {
                id: id,
                section: section,
                quill: data
            },
            success: function(data) {
                console.log(data)
                $('#tableauDesPhrases').html(data)
                $('#controleNouvellePhrase').addClass("d-none d-flex")
                $('#nouvellePhrase').removeClass("d-none")
                $('#bloc_editor').toggleClass("d-none d-flex")
                deletePhrase(quill)
                editPhrase(quill)
                quill.enable(false)
                quill.setText('');
            }
        })

       
    })
}

const editPhrase = (quill) => {

    $(document).on('keyup', '.searchPhraseCreation', function (e) {
        var text = $(this).val()
        console.log(text,'tttt')
        $('.phrase_bloc').addClass('d-none').removeClass('d-flex')
        $('.phrase_bloc').each((index, el) => {
            var phrase = $(el).find('.texte').text()
            console.log(phrase)
            if (phrase.includes(text)) {
                $(el).addClass('d-flex').removeClass('d-none')
            }
        })
    })


    $('.seeExemple').on('click', function() {
        var el = $(this).closest('.phrase_bloc')
        $('#bloc_2phrases').addClass('d-flex').removeClass('d-none')
        $('#controleNouvellePhrase').addClass('d-none').removeClass('d-flex')
        $('#bloc_editor').addClass('d-none').removeClass('d-flex')
        $('#controle_editor').removeClass('d-none').addClass('d-flex')

            $('.masculin').text($(el).attr('data-masculin'))
            $('.feminin').text($(el).attr('data-feminin'))
    
    })

    $('.editPhrase').on('click', function() {

            var data = $(this).closest('.phrase_bloc').attr('data-masculin')
            var id = $(this).closest('.controlePhrase').data('id')
            console.log('iddd', id)
            $('#bloc_editor').removeClass('d-none')
            $('#bloc_2phrases').addClass('d-none')
            $('#nouvellePhrase').addClass('d-none')
            $('#saveNouvellePhrase').attr('data-id', id)
            quill.setText('');
            quill.enable(true)
            quill.root.innerHTML = data
            $('#controleNouvellePhrase').addClass('d-flex').removeClass('d-none')
                      
  


    })
}

const setMotCle = (quill) => {
    $('#motCle').on('click', function() {
        var data = $(this).data('reg')
        var selection = quill.getSelection(true);
        quill.insertText(selection.index, data);
    })
}


export {selectPhrase, editPhrase, deletePhrase, nouvellePhrase, cancelNouvellePhrase, setMotCle, saveNouvellePhrase}
