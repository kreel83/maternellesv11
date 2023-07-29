const contactform = () => {

    $(document).on('click','#submit-btn', function() {

        if($('#subject').val() == '') {
            $('#result').html('<div class="alert alert-warning" role="alert">Veuillez indiquer l\'objet du message</div>')
            return false
        }

        if($('#message').val() == '') {
            $('#result').html('<div class="alert alert-warning" role="alert">Veuillez indiquer votre message</div>')
            return false
        }

        var formData = {
            _token: $("[name='_token']").val(),
            subject: $('#subject').val(),
            message: $('#message').val(),            
        }

        $.ajax({
            method: 'POST',
            url: '/app/contact/store',
            data: formData,
            success: function(data) {
                if(data == 'success') {
                    $('#result').html('<div class="alert alert-success" role="alert">Message envoyé avec succès. Nous allons y répondre dans les plus brefs délais.</div>')
                    $('#subject').val('')
                    $('#message').val('')
                }
                if(data == 'failed') {
                    $('#result').html('<div class="alert alert-danger" role="alert">Erreur : le message ne peut pas être envoyé.</div>')
                }                
            },
            error: function(data) {
                $('#result').html('<div class="alert alert-danger" role="alert">'+data+'</div>')
            }
        })
        
    })

}

export {contactform}