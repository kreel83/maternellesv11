

const selectItem = (Modal, quill) => {

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



    $(document).on('click','#CommitSaveReussite', function() {
        var id = $(this).attr('data-reussite')
        var texte = quill.root.innerHTML;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: 'POST',
            url: '/app/cahier/CommitSaveReussite',
            data: {
                texte: texte,
                id: id
            },
            success: function(data) {
            console.log(data)
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
