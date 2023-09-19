const tutos = (modal) => {
    
    if ($("#tuto").val() == 1) {
        var type = $('#type').val()
        console.log('type',type)
        $('.tuto_'+type).addClass('tuto_cadre')
        var position = $('.tuto_cadre').position()
        var addtop = 0;
        var addleft = 0;




        $.get('/app/tutos?type='+type , function(data) {
            $('#tutoModal').find('.modal-body').html(data[1]) 
            var h = $('#tutoModal').find('.modal-content').height()
            // var h = 120
            if (position.left > 600 & position.top > 400) {
                console.log('cadre1')
                addtop = -400
                addleft = -600
                $('#arrowTuto').addClass('right_bottom') 
                $('#arrowTuto').css('transform','rotateY(180deg)')
    
            } 
            if (position.left > 600 & position.top <= 400) {
                console.log('cadre2')
                addleft = 600
                $('#arrowTuto').addClass('right_top') 
                
    
            } 
            if (position.left <= 600 & position.top >= 400) {
                console.log('cadre3')
                addtop = -400
                addleft = -100
                $('#arrowTuto').addClass('left_bottom') 
             
    
            } 
            if (position.left <= 600 & position.top < 400) {
                addtop = position.top + h + 400
                addleft = -168
                $('#arrowTuto').addClass('left_top') 
                $('#arrowTuto').css('transform','rotateX(180deg)')        
                console.log('cadre4', position.top, h, addtop)
             
    
            } 

            $('#tutoModal').find('.modal-header').html('Etape '+data[0]) 
            $('.dashboard-nav-list .active').css('z-index','10000')
            $('#tutoModal').find('.modal-dialog').css('top', addtop+'px')
            $('#tutoModal').find('.modal-dialog').css('left',(position.left + addleft)+'px')
            modal.show()               
        })
        


    }

}

export {tutos};