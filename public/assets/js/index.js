$(document).on('click','.boutonSearchSchool', function() {
    var search = $('#searchSchool').val();
    // defaultsDeep(search)
    if(search != '') {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: 'POST',
            url: '/search-school',
            data: {
                search: search,
            },
            success: function(data) {
                var json = JSON.parse(data)
                $('#afficheLaListeDesEtablissements').html(json.liste)
                //$('#afficheLaListeDesEtablissementsHomepage').show()
            }
        })
    }
    else {
        $('#afficheLaListeDesEtablissements').html('')
    }
    
})

// $(document).on('change','#register_listeDesEcoles', function() {
//     $('#ecole_id').val($(this).val())
// })

// $(document).on('change','.codeIdentifiantEtablissement', function() {
//     $('#register_afficheLaListeDesEtablissements').hide()
// })