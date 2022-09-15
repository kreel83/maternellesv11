

const chercheCommune = () => {
    $(document).on('click','#chercheCommuneBtn', function() {
        var query = $('#chercheCommune').val()
        $.get('/ecole/chercheCommune?commune='+query, function(data) {
            $('#communeContainer').html(data)
        })
    })
}

const chercheEcole = () => {
    $(document).on('click','.commune', function() {
        var code = $(this).data('codecom')
        $.get('/ecole/chercheEcoles?commune='+code, function(data) {
            $('#ecoleContainer').html(data)
        })
    })
}

const choixEcole = () => {
    $(document).on('click','.ecole', function() {
        var code = $(this).data('num')
        var academie = $(this).data('academie')
        $.get('/ecole/choixEcole?num='+code+'&academie='+academie, function(data) {

            location.reload()

        })
    })
}


export {chercheCommune, chercheEcole, choixEcole}
