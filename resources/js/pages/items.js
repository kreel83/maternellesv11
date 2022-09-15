

const selectItem = () => {

    $('.note').on('click', function() {
        const card = $(this).closest('.card')
        const color = $(this).data('color')
        const enfant = $(card).data('enfant')
        const item = $(card).data('item')
        const note = $(this).data('note')
        $(card).find('.noteChoisie').css('background-color', color)
        $.get('/item/saveResultat?enfant='+enfant+'&item='+item+'&note='+note, function(data) {

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
