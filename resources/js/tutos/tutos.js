const tutos = (modal) => {
    
    var h = 0
    
    var addtop = 0;
    var addleft = 0;

    const np = new Promise((resolve, reject) => {
        $('#tutoModal').on('shown.bs.modal', function () {
            var h = $('#tutoModal .modal-content').height();
            resolve(h);

        });        
    })

    const positionModal = (position, h) => {
        if (position.left > 600 & position.top > 400) {
            console.log('cadre1')
            addtop = position.top-220-h;
            addleft = -600
            $('#arrowTuto').addClass('right_bottom') 
            $('#arrowTuto').css('transform','rotateY(180deg)')

        } 
        if (position.left > 600 & position.top <= 400) {
            console.log('cadre2')
            h = $('.tuto_cadre').height()
            addtop = position.top+200+h;
            addleft = -600
            $('#arrowTuto').addClass('right_top') 
            $('#arrowTuto').css('transform','rotateX(180deg) rotateY(180deg)')
            

        } 
        if (position.left <= 600 & position.top >= 400) {
            console.log('cadre3', h)
            addtop = position.top-220-h;
            addleft = -100
            $('#arrowTuto').addClass('left_bottom') 
            

        } 
        if (position.left <= 600 & position.top < 400) {
            h = $('.tuto_cadre').height()
            console.log('hhhhhhhhhhhhh', h)
            addtop = position.top+220+h;
            addleft = -168
            $('#arrowTuto').addClass('left_top') 
            $('#arrowTuto').css('transform','rotateX(180deg)')        
            console.log('cadre4', position.top, h, addtop)
        

        } 
    }

    $(document).on('click','.fleche', function() {

        var sens = $(this).hasClass('left') ? 'left' : 'right';
        var type = $('#type').val()
        var pos = $('#tutoModal').find('.modal-header #title').attr('position')
        $.get('/app/tutos/ajax?sens='+sens+'&type='+type+'&position='+pos, function(data) {
            console.log(data)
            $('#arrowTuto').removeClass('left_top left_bottom right_top right_bottom')
            $('.tuto_cadre').removeClass('tuto_cadre')
            console.log('.tuto_'+data.keyword)
            $('.tuto_'+data.keyword).addClass('tuto_cadre')
            $('#tutoModal').find('.modal-header #title').attr('position', data.id)
            $('#tutoModal').find('.modal-header #title').text('etape 15')
            $('#tutoModal').find('.modal-body').html(data.texte)
            h = $('#tutoModal .modal-content').height();
            var position = $('.tuto_cadre').position()
            positionModal(position, h)
            $('#tutoModal').find('.modal-dialog').css('top', addtop+'px')
            $('#tutoModal').find('.modal-dialog').css('left',(position.left + addleft)+'px')


        })

    })


    if ($("#tuto").val() == 1) {
        var type = $('#type').val()
        console.log('type',type)
        $('.tuto_'+type).addClass('tuto_cadre')



        $.get('/app/tutos?type='+type , function(data) {
            $('#tutoModal').find('.modal-body').html(data[1]) 
            modal.show()  
            np.then(function(h) {
                console.log(h)
                var position = $('.tuto_cadre').position()

                positionModal(position, h)
                // var h = 120
                

                $('#tutoModal').find('.modal-header #title').html('Etape '+data[0]) 
                $('#tutoModal').find('.modal-header #title').attr('position',data[2]) 
                 
                $('.dashboard-nav-list .active').css('z-index','10000')
                $('#tutoModal').find('.modal-dialog').css('top', addtop+'px')
                $('#tutoModal').find('.modal-dialog').css('left',(position.left + addleft)+'px')
            })
            
                         
        })
        


    }

}

export {tutos};