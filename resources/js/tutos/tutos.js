const tutos = () => {
    
    var h = 0
    
    var addtop = 0;
    var addleft = 0;
    var position = {};
    var w_menu = $('.dashboard-nav').width()
    var hauteur_window = $(window).height()
    var largeur_window = $(window).width()
    var mi_hauteur_window =$(window).height() / 2 - 100
    var mi_largeur_window = $(window).width() / 2
    
    
    function getPosition() {
        var rightPos = $(".tuto_cadre")[0].getBoundingClientRect().right  + $(window)['scrollLeft']();
        var topPos   = $(".tuto_cadre")[0].getBoundingClientRect().top    + $(window)['scrollTop']();
        var bottomPos= $(".tuto_cadre")[0].getBoundingClientRect().bottom + $(window)['scrollTop']();                            
        var leftPos  = $(".tuto_cadre")[0].getBoundingClientRect().left   + $(window)['scrollLeft']();
        position = {top: topPos, right: rightPos, bottom: bottomPos, left: leftPos};
    }    

    
    const positionModal = (h) => {
        console.log('objet', position)
        console.log(position.left, mi_largeur_window, position.top, mi_hauteur_window, $(window).height())
        console.log(position.left > mi_largeur_window, position.top > mi_hauteur_window)
        var w_menu = $('.dashboard-nav').width()
        $('#arrowTuto').removeClass('right_bottom right_top left_bottom left_top middle_left')

        if (position.left > mi_largeur_window && position.top > mi_hauteur_window) {
            console.log('cadre1 - droit - bas')
            var hh = $(window).height()
            var h_arrow_tuto = $('#arrowTuto').height()
            var w_cible = $('.tuto_cadre').width() / 2
            
            console.log(h_arrow_tuto, hh)
            addtop = hh-position.top+h_arrow_tuto;
            addleft = position.left -200 ;
            $('#arrowTuto').addClass('right_bottom') 
            

        } 
        if (position.left > mi_largeur_window && position.top < mi_hauteur_window) {
            h = $('.tuto_cadre').height()
            var hh = $(window).height()
            var ww = $(window).width()
            var h_arrow_tuto = $('#arrowTuto').height()
            var w_cible = $('.tuto_cadre').width() /2
            var h_cible = $('.tuto_cadre').height()        
            addtop = position.bottom + h_arrow_tuto
            addleft = position.left - 400 ;
            $('#arrowTuto').addClass('right_top')                   
            console.log('cadre2 - droit / haut', position.top, h, addtop)
            if (h_cible > mi_hauteur_window) {
                addtop -= h_cible / 2
                addleft -= 40
            }
        }


        
        
        if (position.left < mi_largeur_window && position.top > mi_hauteur_window) {
            console.log('cadre3 - gauche / bas', h)
            
            var h_arrow_tuto = $('#arrowTuto').height()
            var w_cible = $('.tuto_cadre').width()            
            var h =  $('#tuto_window').height()
            addtop = position.top - h_arrow_tuto - h - 25;
            addleft = position.right;
            $('#arrowTuto').addClass('left_bottom') 
            if (w_cible > mi_largeur_window) {
                addtop -= 45;
                addleft -= w_cible / 2
            }
            

        }



        


        if (position.left < mi_largeur_window && position.top < mi_hauteur_window) {
            $('#arrowTuto').addClass('left_top')                  
            var h_tuto_window = $('#tuto_window').height()
            var h_arrow_tuto = $('#arrowTuto').height()
            var w_cible = $('.tuto_cadre').width() / 2
            var h_cible = $('.tuto_cadre').height()
            var h = $('.tuto_cadre').height()
            console.log('hhhhhhhhhhhhh', h_arrow_tuto)
            addtop = position.bottom + h_arrow_tuto;
            addleft = position.left + w_cible;
            console.log('cadre4 - gauche / haut')      
        } 
    }

    $(document).on('click','.fleche', function() {
        var champ = $(this).data('champ')

        
        if ($(this).data('action')) {
            console.log('click')
            $('.tuto_cadre')[0].click()
        }
        $('#tuto_window .left').addClass('invisible')
        $('#tuto_window .right').removeClass('invisible')

        var page = $('#page').val()          
        var etape = $(this).attr('data-etape')
        $.get('/app/tutos/ajax?page='+page+'&etape='+etape, function(data) {

            console.log(data)
            if (data.etape == 1) {
                $('#tuto_window .left').addClass('invisible')
            }
            
            if (data.etape == parseInt($('#tuto_window').attr('data-total'))) {
                $('#tuto_window .right').addClass('invisible')
            }

            $('#arrowTuto').removeClass('left_top left_bottom right_top right_bottom')
            $('.tuto_cadre').removeClass('tuto_cadre')
            $('input').attr('disable','true')
            $('.'+data.champ).addClass('tuto_cadre')
            $('#tuto_window .title').text(data.titre)
            $('#tuto_window .texte').html(data.texte)
            h = $('#tuto_window').height();
            
            getPosition()
            positionModal(h)
            $('#tuto_window').css('top', addtop+'px')
            $('#tuto_window').css('left',addleft+'px')
            $('#tuto_window .left').attr('data-etape', data.etape -1)
            $('#tuto_window .right').attr('data-etape', data.etape + 1)
            $('#tuto_window .right').attr('data-action', data.action)


        })

    })


    if ($("#tuto").val() == 1) {
        
        var type = $('#page').val()   

                
        $.get('/app/tutos?page='+type , function(data) {
            console.log('data', data)
            console.log(data)
            if (data == 'none') return false;
            $('#tuto_window').removeClass('d-none')
            console.log(data, data[4])
            $('#tuto_window').remove('d-none')
            $('.'+data[4]).addClass('tuto_cadre')
            $('#tuto_window .texte').html(data[1]) 
            
             
            h = $('#tuto_window').height()
                getPosition()
                positionModal(h)               

                $('#tuto_window .title').html(data[0]) 
                $('#tuto_window').attr('data-etape',data[2])
                $('#tuto_window').attr('data-total',data[3]) 
                 

                $('#tuto_window').css('top', addtop+'px')
                $('#tuto_window').css('left',addleft+'px')

                $('#tuto_window .left').attr('data-etape', data[2] - 1)
                $('#tuto_window .right').attr('data-champ', data[5])
                $('#tuto_window .right').attr('data-action', data[6])
                $('#tuto_window .right').attr('data-etape', data[2] + 1)
                if (data[2] == 1) {
                    $('#tuto_window .left').addClass('invisible')
                }
                if (data[2] == data[3]) {
                    $('#tuto_window .right').addClass('invisible')
                }
            
            
                         
        })
        


    }

}

export {tutos};