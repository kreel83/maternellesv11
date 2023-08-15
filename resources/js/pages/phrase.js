


const selectPhrase = () => {
    $('#selectPhrase').on('change', function() {
        var id = $(this).val()
        window.open('/app/parametres/phrases?section='+id,'_self')
    })

    $(document).on('click','.sectionPhrase', function() {   
        var id = $(this).data('section')
        window.open('/app/parametres/phrases?section='+id,'_self')
    })




    $('#record').on('click', function() {
        window.SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition

        const recognition = new window.SpeechRecognition();
        recognition.lang = 'fr-FR';
        recognition.continuous = true;
        recognition.maxAlternatives = 1;
        recognition.start()
        $(this).find('i').toggleClass('fa-microphone-slash fa-microphone')
        if ($(this).find('i').hasClass('fa-microphone-slash')) {
            recognition.stop()
            
        } else {
            $('#commentaire_general').trigger('focus')
            var content = ''
            if ($('#commentaire_general').val().trim().length > 0) content = $('#commentaire_general').val();
            var instruction = $('#instruction')
    
            recognition.onstart = function() {
                instruction.text('La dictée vocale est active')
            }
    
            recognition.onspeechend = function() {
                instruction.text('Aucune activité - Désactivation de la dictée vocale')
                recognition.stop()
                $('#record').find('i').removeClass('fa-microphone').addClass('fa-microphone-slash')
            }
    
            recognition.onerror = function() {
                instruction.text("Ooups ! j'ai pas compris ! Veuillez répéter s'il vous plait ")
            }
    
            recognition.onresult = function(event) {
                if (event.results.length > 0) {
                    var sonuc = event.results[event.results.length -1];
                    var nv = true;
                    var first = true;
                    if (sonuc.isFinal) {
                      var transcript = sonuc[0].transcript;
    
                      if (transcript.includes('à la ligne')) transcript = transcript.replace(' à la ligne','\r\n')
                      if (transcript.includes('nouveau paragraphe')) transcript = transcript.replace(' nouveau paragraphe','\r\n\r\n')
                      if (transcript.includes('deux points')) transcript = transcript.replace(' deux points',':')
                      if (transcript.includes('Point Virgule')) transcript = transcript.replace(' Point Virgule',';')
                      if (transcript.includes('virgule')) transcript = transcript.replace(' virgule',', ')
                      if (transcript.includes('ouvre la parenthèse')) transcript = transcript.replace(' ouvre la parenthèse',' (')
                      if (transcript.includes('ferme la parenthèse')) transcript = transcript.replace(' ferme la parenthèse',') ')
                      if (transcript.includes('ouvre les guillemets')) transcript = transcript.replace(' ouvre les guillemets',' "')
                      if (transcript.includes('ferme les guillemets')) transcript = transcript.replace(' ferme les guillemets','" ')
                      if (transcript.includes(' point')) {
                        nv = true;
                      }  else {
                        nv = false;
                      }
                      transcript = transcript.replace(' point','. ')
                      
                      
                      if (nv || first) transcript = transcript.charAt(0).toUpperCase() + transcript.slice(1);
                        content += transcript;    
                        nv = true;        
                        $('#commentaire_general').val(content); 
                        console.log(sonuc[0])
                    }
                  }
    
    
    
            }
        }
       





    })
}

const deletePhrase = () => {
    $('.deletePhrase').on('click', function() {
        var id = $(this).closest('.controle').data('id')
        var el = $(this).closest('tr')
        $.get('/app/parametres/phrases/'+id+'/delete', function(data) {
            $(el).remove()
        })
    })
}

const nouvellePhrase = (quill) => {
    $('#nouvellePhrase').on('click', function() {
        $('#controleNouvellePhrase').toggleClass('d-none')
        $(this).toggleClass('d-none')
        $('#saveNouvellePhrase').attr('data-id', 'new')
        quill.setText('');
        quill.enable(true)
    })
}

const cancelNouvellePhrase = (quill) => {
    $('#cancelNouvellePhrase').on('click', function() {
        $('#controleNouvellePhrase').toggleClass('d-none')
        $('#nouvellePhrase').toggleClass('d-none')
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
                $('#tableCommentaireContainer').html(data)
                $('#controleNouvellePhrase').addClass("d-none")
                deletePhrase(quill)
                editPhrase(quill)
                quill.setText('');
            }
        })

       
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
        $('#controleNouvellePhrase').toggleClass('d-none')
        $('#nouvellePhrase').toggleClass('d-none')

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
