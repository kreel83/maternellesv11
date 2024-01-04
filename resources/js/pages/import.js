


const importation = () => {
    $(document).on('keyup','.searchChoix', function(e) {
        var texte = $(this).val().toUpperCase()
        console.log(texte)       
        var prof = $(".prof.selected").data('prof')
        $('.enfant').each((index, el) => {
            var t = $(el).data('texte').toUpperCase()
            console.log(t, texte)
            if (t.includes(texte)) {
                if ($(el).data('prof') == prof || prof == 'tous') $(el).removeClass('d-none')
            } else {
                if ($(el).data('prof') == prof || prof == 'tous') $(el).addClass('d-none')
                
            } 
        })
    })

    

    $(document).on('click','.classe', function() {
        var classe = $(this).data('classe')
        if (classe == "tous") {
            $('.enfant').removeClass('d-none')
        } else {
            $('.enfant').addClass('d-none')
            $('.enfant[data-classe="'+classe+'"]').removeClass('d-none')            
        }
        $('.classe').removeClass('selected')
        $(this).addClass('selected')
        $('.searchChoix').val('')
        $('.choix').prop('checked', false)
        $('#importer').addClass('d-none')


    })



    $(document).on('change','.choix', function() {
        var enfant = $(this).data('id')
        if ($(this).hasClass('choix_tous')) {
            if ($(this).is(':checked')) {
                $('.choix').prop('checked', true)
            } else {
                $('.choix').prop('checked', false)

            }

        } else {
            if ($('.choix:checked').length == 0) {
                $('.choix_tous').prop('checked', false)

            } else {
                if ($('.choix_liste:checked').length == $('.choix_liste').length ) {
                    $('.choix_tous').prop('checked', true) 
                } else {
                    $('.choix_tous').prop('checked', false)

                }
            }
        }

        console.log($('.choix_liste:checked').length)
        if ($('.choix_liste:checked').length > 0) {
            $('#importer').removeClass('d-none')
        } else {
            $('#importer').addClass('d-none')
        }




    })
}

export {importation}