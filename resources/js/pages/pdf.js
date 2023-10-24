
const envoiCahierIndividuel = () => {

    $(document).on('click','.envoicahier', function(e) {
        e.preventDefault();
        var id = $(this).attr('id');
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
    })

}

export {envoiCahierIndividuel}