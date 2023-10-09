



class Periode {
    constructor (color, periode, start = null, datestart = null, end = null, dateend = null, complete = false) {
        this.color = color
        this.start = start
        this.datestart = datestart
        this.end = end
        this.dateend = dateend
        this.complete = complete
        this.periode = periode
    }
}

var p1 = new Periode('red', 'p1')
var p2 = new Periode('blue', 'p2' )
var p3 = new Periode('green', 'p3')


var periodeActive = null



const choosePeriode = (confirmation_modal) => {
    $('.btnPeriode').on('click', function() {

        var confirmation_modal = new bootstrap.Modal(document.getElementById('confirmation_modal'), {
            keyboard: false
        })


        confirmation_modal.show()
        var active = $(this).data('periode')
        switch (active) {
            case 'p1' : periodeActive = p1;break;
            case 'p2' : periodeActive = p2;break;
            case 'p3' : periodeActive = p3;break;
        }
console.log(periodeActive)
    })
}


const initCalendrier = () => {
    if ($('#calendrier_scolaire').length ) {
        var conges = $('#conges').val()
        conges = JSON.parse(conges)
        conges.forEach(function (element) {
            console.log(element)
            $('.day[data-all="' + element.start + '"]').addClass('conges start')
            $('.day[data-all="' + element.start + '"]').prop('title', element.libele)
            $('.day[data-all="' + element.end + '"]').addClass('conges end')
            $('.day[data-all="' + element.end + '"]').prop('title', element.libele)
            for (var i = element.start + 1; i < element.end; i++) {
                $('.day[data-all="' + i + '"]').addClass('between conges')
                $('.day[data-all="'+i+'"]').prop('title', element.libele)
            }
        })
        var anniversaires = $('#anniversaires').val()
        anniversaires = JSON.parse(anniversaires)
        anniversaires.forEach(function (element) {
            console.log(element)
            $('.day[data-all="' + element.ddn + '"]').addClass('anniversaire '+element.genre)
            $('.day[data-all="'+element.ddn+'"]').prop('title', element.nom)
        })
        $('.day[data-all="' + $('#ddj').val() + '"]').addClass('ddj')
        if ( !$('.day[data-all="' + $('#ddj').val() + '"]').hasClass('anniversaire')) {
            $('.day[data-all="' + $('#ddj').val() + '"]').css('color','white')
        }
        var evenements = $('#evenements').val()
        console.log(evenements)
        evenements = JSON.parse(evenements)
        evenements.forEach(function (element) {
            console.log(element)
            var s = '.'.repeat(element.nombre)
            console.log(s)
            $('.day_event[data-js_date="' + element.date + '"]').text(s)
            $('.day_event[data-js_date="' + element.date + '"]').removeClass('d-none')
            
        })

    }
}

const initCalendrierPeriodes = () => {
    if ($('#calendrier_periodes').length ) {
        var conges = $('#conges').val()
        var start = $('#start').val()
        var end = $('#end').val()
        var periodes = $('#periodes').val()
        periodes = JSON.parse(periodes);
        conges = JSON.parse(conges)
        conges.forEach(function (element) {
            $('.day[data-all="' + element.start + '"]').addClass('conges')
            $('.day[data-all="' + element.start + '"]').prop('title', element.libele)
            $('.day[data-all="' + element.end + '"]').addClass('conges')
            $('.day[data-all="' + element.end + '"]').prop('title', element.libele)
            for (var i = element.start + 1; i < element.end; i++) {
                $('.day[data-all="' + i + '"]').addClass('between conges')
                $('.day[data-all="'+i+'"]').prop('title', element.libele)
            }
        })
        $('.day[data-js_date="'+start+'"]').addClass('selected').addClass('limite')
        $('.day[data-js_date="'+end+'"]').addClass('selected').addClass('limite')

        for (var i =0; i < periodes.length; i++ ) {
            var now = new Date(periodes[i]['fin']);
            var s = new Date(now).getFullYear()+'-'+('0' +(new Date(now).getMonth()+1)).slice(-2)+'-'+('0' + new Date(now).getDate()).slice(-2); 
            $('.day[data-js_date="'+s+'"]').addClass('selected')
            for (var d = new Date(periodes[i]['debut']); d <= now; d.setDate(d.getDate() + 1)) {
                var select = new Date(d).getFullYear()+'-'+('0' +(new Date(d).getMonth()+1)).slice(-2)+'-'+('0' + new Date(d).getDate()).slice(-2);
                $('.day[data-js_date="'+select+'"]').addClass(periodes[i]['classe'])
            }            
        }



    }
}

const initCalendar = () => {
    if ($('#savePeriode').length) {

        var annee = $('#savePeriode').data('annee')
        $.get('/app/calendar/periodes/init?annee='+annee, function(data) {
            data.forEach(function(element) {console.log(element)
                $('.day[data-all="'+element.start+'"]').addClass('start p'+element.periode)
                $('.day[data-all="'+element.end+'"]').addClass('end p'+element.periode)
                for (var i=element.start +1; i < element.end; i++)  $('.day[data-all="'+i+'"]').addClass('between p'+element.periode)
                    switch (element.periode) {
                        case 1: p1 = new Periode('red', 'p1', element.start, element.date_start, element.end, element.date_end, true );break;
                        case 2: p2 = new Periode('blue', 'p2', element.start, element.date_start, element.end, element.date_end, true );break;
                        case 3: p3 = new Periode('green', 'p3', element.start, element.date_start, element.end, element.date_end, true );break;
                    }
                }
            )
            $('#alerte').addClass('alert alert-success')
            $('#alerte').text('les périodes ont bien été récupérées')
            setTimeout(function() {
                $('#alerte').fadeOut()


            }, 1000, function() {
                $('#alerte').removeAttr('class')
                $('#alerte').empty()
            })

        })
    }

}

const selection = () => {
    
    $(document).on('click','.delete_event', function() {
        var id = $(this).attr('data-id')
        var date = $(this).attr('data-date_js')
        console.log('id', id, date)
        $('#do_delete_event').attr('data-id', id)
        $('#do_delete_event').attr('data-date', date)
    })

    $(document).on('click','.editEvent', function() {
        var id = $(this).attr('data-id')
        var date = $(this).attr('data-date_js')
        var name = $(this).attr('data-name')
        var comment = $(this).attr('data-comment')
        console.log(name, comment)
        $('input[name="id"]').val(id)
        $('input[name="name"]').val(name)
        $('textarea[name="comment"]').val(comment)
        $('input[name="date"]').val(date)
    })


 

    $(document).on('click','#do_delete_event', function() {
        var id = $(this).attr('data-id')
        var date = $(this).attr('data-date')
        var points = $('.day[data-js_date="'+date+'"]').find('.day_event').text()
        console.log(points)
        var newPoints = '.'.repeat(points.length - 1)
        $.get('/app/calendar/event/delete/'+id, function() {
            $('.event_container[data-id="'+id+'"]').remove()
            $('.day[data-js_date="'+date+'"]').find('.day_event').text(newPoints)
        })
    })


    $('#calendrier_scolaire .day').on('click', function() {
        console.log('coucou')
        $('.day').removeClass('selected')
        $(this).addClass('selected')
        var date = $(this).data('js_date')
        console.log(date)
        $('.bloc_event').empty()
        $.get('/app/calendar/getEvent/'+date, function(data) {
            $('.bloc_event').html(data)
        })

        $('#date_event').val(date)
 
    })

    $('#calendrier_periodes .day').on('click', function() {
        
        
        if ($('.day.selected').length == 4 && !$(this).hasClass('selected')) return false;
        $(this).toggleClass('selected')
        var date = $(this).data('js_date')
        console.log(date)
        var date = [];
        $('.day.selected').each((index, el) => {
            date.push($(el).data('js_date'))
        })
        console.log(date)
        
        $.get('/app/calendar/getPeriodes/?dates='+JSON.stringify(date), function(data) {
            $('#formulaire_periodes').html(data)
            var periodes = $('#periodes').val()
            $('.day').removeClass('periode1 periode2 periode3')
            periodes = JSON.parse(periodes);
            console.log('new periodes : '+periodes.length)
            for (var i =0; i < periodes.length; i++ ) {
                var now = new Date(periodes[i]['fin']); 
                for (var d = new Date(periodes[i]['debut']); d <= now; d.setDate(d.getDate() + 1)) {
                    var select = new Date(d).getFullYear()+'-'+('0' +(new Date(d).getMonth()+1)).slice(-2)+'-'+('0' + new Date(d).getDate()).slice(-2);
                    
                    $('.day[data-js_date="'+select+'"]').addClass(periodes[i]['classe'])
                    if (d == new Date(periodes[i]['debut'])) {
                        $('.day[data-js_date="'+select+'"]').addClass('start')
                    }
                    if (d == now) {
                        $('.day[data-js_date="'+select+'"]').addClass('end')
                    }
                }            
            }
        })

        
 
    })

    $('.day.actif').on('click', function() {
        if (periodeActive) {
            console.log(periodeActive)
            if (periodeActive.complete) {
                periodeActive.start = null
                periodeActive.datestart = null
                periodeActive.end = null
                periodeActive.dateend = null
                periodeActive.complete = false
                $('.day.' + periodeActive.periode).removeClass('start between end select ' + periodeActive.periode)
            }
            if (!periodeActive.start) {
                $(this).addClass('start '+periodeActive.periode)
                periodeActive.start = parseInt($(this).data('all'))
                periodeActive.datestart = $(this).data('date')
            }
            if ($(this).hasClass('end')) {
                periodeActive.complete = true
            }
        }
    })

}


const savePeriode = () => {
    $('#savePeriode').on('click', function() {
        $.ajax({
            url: 'calendar/periodes/save',
            method:'POST',
            data: {
                annee: $(this).data('annee'),
                periode: {
                    p1: p1.complete ? JSON.stringify(p1) : null,
                    p2: p2.complete ? JSON.stringify(p2) : null,
                    p3: p3.complete ? JSON.stringify(p3) : null,
                }

            },
            success: function() {

            }

        })
    })
}

const hover = () => {

    $('.day.actif').on('mouseenter', function() {
        if ($(this).find('.day_event').is(':visible')) {
            $('.cadre_cal').removeClass('d-none')
            var position = $(this).position()
            $('.cadre_cal').css('top',position.top+'px')
            $('.cadre_cal').css('left',position.left +40+'px')            
        }

    })

    $('.day.actif').on('mouseleave', function() {
        $('.cadre_cal').addClass('d-none')
    })



        // $('.day.actif').on('mouseover', function() {
        //     if (periodeActive) {
        //         if (periodeActive.start && !periodeActive.complete) {
        //             console.log('cc')

        //             periodeActive.end = parseInt($(this).data('all'))
        //             periodeActive.dateend = $(this).data('date')

        //             $('.day.'+periodeActive.periode).removeClass('between end select '+periodeActive.periode)
        //             if (periodeActive.start == periodeActive.end) {
        //                 $(this).addClass('select '+periodeActive.periode)

        //             }
        //             if (periodeActive.start < periodeActive.end) {
        //                 $('.day[data-all="'+periodeActive.start+'"]').removeClass('select')
        //                 $('.day[data-all="'+periodeActive.start+'"]').addClass('start '+periodeActive.periode)
        //                 for(var i = periodeActive.start+1; i < periodeActive.end; i++ ) {
        //                     $('.day[data-all="'+i+'"]').addClass('between '+periodeActive.periode)
        //                 }
        //                 $(this).addClass('end '+periodeActive.periode)
        //             }


        //         }
        //     }


        // })


}

export {selection, hover, choosePeriode, savePeriode, initCalendar, initCalendrier, initCalendrierPeriodes}
