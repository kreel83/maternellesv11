

const selectItem = (Modal) => {

    $('.note').on('click', function() {
        const card = $(this).closest('.card_item')
        const enfant = $('#Enfant').val()
        const item = $(card).data('item')
        const note = $(this).data('notation')
        $(card).find('.noteChoisie').css('background-color', color)
        $.get('/App/item/saveResultat?enfant='+enfant+'&item='+item+'&note='+note, function(data) {

        })
    })

    $('.selectSectionItem').on('click', function() {
        $('.noFiche').addClass('d-none') 
        const section = $(this).data('value');
        $('.card_item').addClass('d-none')
        $('.card_item[data-section="'+section+'"]').removeClass('d-none')
        if ($('.card_item:visible').length == 0) {
           $('.noFiche').removeClass('d-none') 
           $('.linkNoFiche').attr('href','/app/fiches?section='+section) 

        }
        
    })

    $(document).on('click','.notation', function() {
        const notation = $(this).data('notation')
        const text = $(this).text()
        const el = $(this).closest('.card_item')
        const item = $(el).data('item')
        const enfant = $('#enfant').val()
        $(el).find('.lanote').text(text)
        $(el).find('.card-footer2').removeClass('niveau_0 niveau_3 niveau_2 niveau_1')
        switch (notation) {
            case 0 : $(el).find('.autonome').addClass('d-none')
                     $(el).find('.lanote').text('')
                     $(el).find('.card-footer2').addClass('niveau_0')
                     break;   
            case 1 : $(el).find('.autonome').addClass('d-none')
                     $(el).find('.lanote').text(text)
                     $(el).find('.card-footer2').addClass('niveau_1')
                     break;   
            case 2 : $(el).find('.autonome').removeClass('d-none').addClass('autonome_0').removeClass('autonome_1')
                     $(el).find('.lanote').text(text)
                     $(el).find('.card-footer2').addClass('niveau_2')
                     break;   
            case 3 : $(el).find('.autonome').removeClass('d-none').addClass('autonome_1').removeClass('autonome_0')
                     $(el).find('.lanote').text(text)
                     $(el).find('.card-footer2').addClass('niveau_3')
                     break;   

        }
        $.get('/app/item/saveResultat?enfant='+enfant+'&item='+item+'&note='+notation, function(data) {
            console.log(data)
            if (data == 'demo') {
                var myModalEl = document.getElementById('InfoDemo');
                var modal = new Modal(myModalEl,{
                    backdrop: 'static', keyboard: false
                })
                modal.show()
            }
            if ($(el).parent().hasClass('fiche_modify')) {
                location.reload()
            }
        })
    })
}

const hamburger = () => {
    $('.hamburger').on('click', function() {
        $(this).css('display', 'none')
        $(this).closest('.card').find('.menu').attr('hidden', false)
    })
}

export {selectItem, hamburger}
