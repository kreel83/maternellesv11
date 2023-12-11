const creationCompte = () => {

    // Utilisé dans step1.blade
    $(document).on('click','.switchSansIdentifiantEtablissement', function() {
        var status = $(this).is(':checked')
        if(status) {
            $('.codeIdentifiantEtablissement').val("")
            $('.codeIdentifiantEtablissement').attr("disabled", "disabled")
            $('#register_afficheLaListeDesEtablissements').hide()
            $('#register_search').val('')
            $('#register_search').attr("disabled", "disabled")
        } else {
            $('.codeIdentifiantEtablissement').removeAttr("disabled")
            $('#register_search').removeAttr("disabled")
        }
    })

    $(document).on('click','.boutonRechercheEtablissementParCP', function() {
        var statusSwitch = $('.switchSansIdentifiantEtablissement').is(':checked')
        if(!statusSwitch) {
            var search = $('#register_search').val();
            if(search != '') {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    method: 'POST',
                    url: '/app/register/search/etablissement',
                    data: {
                        search: search,
                    },
                    success: function(data) {
                        var json = JSON.parse(data)
                        $('#register_listeDesEcoles').html(json.option)
                        $('#register_afficheLaListeDesEtablissements').show()
                    }
                })
            }
        }
    })

    $(document).on('change','#register_listeDesEcoles', function() {
        $('#ecole_id').val($(this).val())
    })

    $(document).on('change','.codeIdentifiantEtablissement', function() {
        $('#register_afficheLaListeDesEtablissements').hide()
    })
    
}

export {creationCompte}