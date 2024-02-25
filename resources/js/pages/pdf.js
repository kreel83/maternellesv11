
const envoiCahierIndividuel = (Modal) => {

    // Bouton envoi tous les cahiers en 2 étapes
    $(document).on('click','.manageBulkEnvoiButton', function(e) {
        e.preventDefault();
        $('#manageBulkEnvoiGroupButton').hide();
        $('#manageBulkEnvoiProcessing').show();
        var form = $("#manageBulkEnvoiForm");
        var url = form.attr('action');
        $.ajax({ 
            type: "POST", 
            url: url, 
            data: form.serialize(),
            success: function(data) {
                $('#manageBulkEnvoiProcessing').hide();
                var json = JSON.parse(data)
                if(json.success) {
                    $('#manageBulkEnvoiSuccess').show();
                } else {
                    $('#manageBulkEnvoiWarning').show();
                    $('#manageBulkEnvoiErrorMsg').html(json.error);
                    $('#manageBulkEnvoiError').show();
                }
                $('#manageBulkEnvoiBackBtn').show();
            }, 
            error: function(data) { 
            } 
        });
    })

    // Bouton envoi tous les cahiers
    $(document).on('click','.bulk', function(e) {
        e.preventDefault();
        $('#periode').val($(this).val());
        var myModal = new Modal(document.getElementById('envoiTousLesCahiersModal'))
        myModal.show()
        //var periode = $(this).val();
        //$('#periodeBulkEnvoi').val(periode);
        //$('#periode').val(periode);
        // $("#envoiTousLesCahiersModal").modal('show');
    })

    $(document).on('click','#confirmationEnvoiTousLesCahiers', function() {
        var form = $("#bulkForm");
        var url = form.attr('action');
        $.ajax({ 
            type: "POST", 
            url: url, 
            //data: form.serialize() + '&periode=' + $('#periodeBulkEnvoi').val(), 
            data: form.serialize(),
            success: function(data) {
                window.location.reload();
            }, 
            error: function(data) { 
            } 
        });
        // $("#envoiTousLesCahiersModal").modal('hide');
    })
    // Fin bouton envoi tous les cahiers

    // Renvoi d'un cahier
    $(document).on('click','.renvoicahier', function(e) {
        e.preventDefault();
        var id = $(this).attr('id');
        $('#confirmationRenvoiMailId').val(id);
        var myModal = new Modal(document.getElementById('renvoiModal'))
        myModal.show()
    })
    $(document).on('click','#confirmationRenvoiMail', function(e) {
        e.preventDefault();
        var id = $('#confirmationRenvoiMailId').val();
        envoiLeLien(id);
      
    })
    // Fin renvoi d'un cahier

    // Envoi d'un cahier
    $(document).on('click','.envoicahier', function(e) {
        e.preventDefault();
        var id = $(this).attr('id');
        envoiLeLien(id);
    })
    // Fin envoi d'un cahier

    // Commun a envoi / renvoi
    function envoiLeLien(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: 'POST',
            url : '/app/enfants/cahier/envoi/individuel',
            data: {
                id: id,
            },
            success: function(data) {
                var json = JSON.parse(data)
                $(json.idtag).html(json.msg)
            },
            error: function(data) {
                $('#result').html(data)
            }
        })
    }

}

export {envoiCahierIndividuel}