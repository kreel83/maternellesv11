const mailFunction = (quill) => {

    $(document).on('click','#saveCustoMail', function() {
        var q = quill.root.innerHTML;
        $('#customMailStatus').html('')
        $.ajax({
            method: 'POST',
            url : '/app/saveCustomMail',
            data : {
                quill: q
            },
            success: function(data) {
                $('#customMailStatus').html('<div class="alert alert-success">Le mail a été sauvegardé avec succès.</div>')
            },
            error: function(data) {
                $('#customMailStatus').html('<div class="alert alert-danger">Une erreur est survenue pendant la sauvegarde du mail.</div>')
            }
        })
    })
    
}

export {mailFunction}